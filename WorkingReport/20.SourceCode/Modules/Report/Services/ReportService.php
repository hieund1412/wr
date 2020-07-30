<?php
namespace Modules\Report\Services;
use App\Mail\ReportMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Modules\Blocks\Repositories\BlockInterface;
use Modules\Jobs\Repositories\JobsInterface;
use Modules\Projects\Repositories\ProjectInterface;
use Modules\Report\Repositories\ReportInterface;
use Modules\Users\Repositories\UsersInterface;

class ReportService {
    private $MAX_RECORD_DEFAULT = 5;
    private $block;
    private $job;
    private $project;
    private $user;
    private $report;

    public function __construct(
         BlockInterface $block,
         JobsInterface $jobs,
         ProjectInterface $project,
         UsersInterface $users,
         ReportInterface $report
    )
    {
        $this->block = $block;
        $this->job = $jobs;
        $this->project = $project;
        $this->user = $users;
        $this->report = $report;
    }

    public function getReport() {
        return  $this->report->getAll();
    }

    public function unCompleteWork() {
        $user_login = Auth::user()->user_login;
        return $this->report->unComplete($user_login);
    }

    public function reportLatest() {
        $user_login = Auth::user()->user_login;
        return $this->report->reportLatest($user_login);
    }

    private function validateRequi($data) {
        $missing_data_array = array();
        foreach ($data as $key => $ary) {
            if (!((empty($ary['relate_block']) && empty($ary['project_id']) && empty($ary['work_content'])
                    && empty($ary['work_type']) && empty($ary['execute_time']) && empty($ary['progress'])  )
                || (!empty($ary['relate_block']) && !empty($ary['project_id']) && !empty($ary['work_content'])
                    && !empty($ary['work_type']) && !empty($ary['execute_time']) && !empty($ary['progress'])))
                || (isset($ary['target']) && ((int)$ary['target'] == 0)) || (isset($ary['result']) && ((int)$ary['result'] == 0))) {
                array_push($missing_data_array, $key + 1);
            }
        }
        return $missing_data_array;
    }

    /**
     * @param $data :data insert
     * @param $workDate : date for work
     * @return array list data for redirect
     */
    public function insert($input, $data, $workDate) {
        // validate row có data lõi
        $validate_fail_array = $this->validateRequi($data);
        $listId = "";
        // không có lỗi data
        if (count($validate_fail_array) == 0) {
            // lấy list report đã tạo trùng ngày
            $listId = $this->report->getListIdWorkingReportByDate($workDate);
            if (!empty($listId)) {
                $listId = implode("|", $listId);
            } else {
                $listId = "";
                // không có lõi data, chưa tồn tại báo cáo thì insert
                if (!$this->insertByDate($input, $data, $workDate, "")) {
                    array_push($validate_fail_array, 1);
                }
            }
        }
        return [$data, $validate_fail_array, $listId];
    }

    /**
     * @param $data : data for insert
     * @param $workDate : date for work
     * @return mixed
     */
    public function insertByDate($input, $data, $workDate, $listIdWorkingReport) {
        $data = $this->_removeEmptyRow($data);
        if (!empty($data)) {
            if (!empty($listIdWorkingReport)) {
                $this->report->deleteExistReport((explode("|", $listIdWorkingReport)));
            }
            $this->_sendMailReport($input);
            $this->report->insert($data, $workDate);
            return true;
        }
        return false;
    }

    /**
     * remove empty data row
     */
    private function _removeEmptyRow($data) {
        foreach ($data as $key => $value) {
            if (empty($value['relate_block']) && empty($value['work_content']) && empty($value['project_id'])
                && empty($value['work_type']) && empty($value['execute_time']) && empty($value['progress'])) {
                unset($data[$key]);
            }
        }
        return $data;
    }

    /**
     * 
     */
    public function updateList($data) {
        $add_rows = $this->MAX_RECORD_DEFAULT - count($data);
        for ($i = 0; $i < $add_rows; $i++) {
            $obj = [
                "relate_block" => "",
                "project_id" => "",
                "project_name" => "",
                "work_content" => "",
                "work_type" => "",
                "execute_time" => "",
                "progress" => "",
                "target" => "",
                "result" => "",
                "late" => "",
            ];
            array_push($data, $obj);
        }
        return $data;
    }

    /**
     * @return mixed
     */
    public function getBlock() {
        return $this->block->getBlock();
    }

    public function getProject() {
        return $this->report->getProject();
    }

    public function getJob() {
        return $this->report->getJob();
    }

    public function getUser() {
        return $this->user->getUser();
    }

    public function createDataArray($input) {
        $data = [];
        foreach($input['relate_block'] as $key => $value){
            $obj = [
                "relate_block" => $value,
                "project_id" => $input['project_id'][$key],
                "work_date" => $input['work_date'],
                "work_content" => $input['work_content'][$key],
                "work_type" => $input['work_type'][$key],
                "execute_time" => $input['execute_time'][$key],
                "progress" => $input['progress'][$key],
                "target" => $input['target'][$key],
                "result" => $input['result'][$key],
                "late" => isset($input['late'][$key]) ? 1 : 0,
                "note" => $input['note']
            ];
            array_push($data, $obj);
        }
        return $data;
    }

    /**
     * lay lai du lieu de gui mail
     * @param $input
     * @access public
     * @author minh
     */
    private function _sendMailReport($input) {
        $userLogin = Auth::user()->user_login;
        $blockIdByUser = Auth::user()->block_id;
        $userEmail = Auth::user()->email;
        $emailReceive = $this->report->getBlockEmailByUser($userLogin, $blockIdByUser);
        $workDate = Carbon::createFromFormat('d/m/Y',$input['work_date'])->format('Y-m-d');
        $data = array();
        foreach ($input['relate_block'] as $index => $value) {
            if ($value == null) continue;
            $data[] = [
                'block_name' => $this->block->findOneById($value)->block_name,
                'project_name' => $this->project->findOneById($input['project_id'][$index])->project_name,
                'job_type' => $this->report->getJobTypeById($input['work_type'][$index]),
                'work_content' => $input['work_content'][$index],
                'execute_time' => $input['execute_time'][$index],
                'progress' => $input['progress'][$index],
                'target' => $input['target'][$index],
                'result' => $input['result'][$index],
                'late' => (!empty($input['late'][$index]) ? 'yes' : 'no'),
                'note' => $input['note']
            ];
        }
        Mail::to($emailReceive)->cc($userEmail)->send((new ReportMail($userLogin, $workDate, $data)));
    }
}