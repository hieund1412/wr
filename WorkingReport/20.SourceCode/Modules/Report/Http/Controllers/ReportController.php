<?php
namespace Modules\Report\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Report\Services\ReportService;

/**
 * @AnnotatedDescription(allow=true,desc="Báo Cáo")
 */
class ReportController extends Controller {
    private $reportService;

    public function __construct(ReportService $reportService) {
        $this->reportService = $reportService;
    }

    /**
     * @author HieuBee
     * @AnnotatedDescription(allow=true,desc="Tạo mới báo cáo")
     */
    public function index() {
        $validate_fail_array = array();
        $data = $this->reportService->updateList([]);
        list($project, $user, $block, $job, $sql, $query, $listIdWorkingReport) = $this->getDataForIndex();
        return view('report::index',compact('data', 'project', 'query', 'user', 'block', 'job',
                'sql', 'validate_fail_array', 'listIdWorkingReport'));
    }

    /**
     * @author HieuBee
     * @AnnotatedDescription(allow=true,desc="Lấy lại báo cáo cũ")
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDataReportLatest() {
        $data = $this->reportService->reportLatest();
        if (!empty($data)) {
            $note = $data[0]->note;
        }
        $data = $this->reportService->updateList($data);
        list($project, $user, $block, $job, $sql, $query, $listIdWorkingReport) = $this->getDataForIndex();
        $validate_fail_array  = array();
        return view('report::index', compact('data', 'project', 'note', 'query', 'user', 'block', 'job', 'sql', 'validate_fail_array', 'listIdWorkingReport'));
    }

    /**
     * @author HieuBee
     * @AnnotatedDescription(allow=true,desc="Thêm mới báo cáo")
     */

    public function store(Request $request) {
        $input = $request->all();
        $data = $this->reportService->createDataArray($input);
        $workDate = date('Y-m-d', strtotime(str_replace('/', '-', $input['work_date'])));
        $note = $input['note'];
        list($project, $user, $block, $job, $sql, $query, $listIdWorkingReport) = $this->getDataForIndex();
        list($data, $validate_fail_array, $listIdWorkingReport) = $this->reportService->insert($input, $data, $workDate);

       
        if (count($validate_fail_array) > 0 || !empty($listIdWorkingReport)) {
            return view('report::index', compact('data', 'project', 'note', 'query', 'user', 'block', 'job', 'sql', 'validate_fail_array', 'listIdWorkingReport'));
        } else {
            return redirect()->route('report.index')->with('success', 'Thành công');
        }
    }

    /**
     * process insert data into database
     */
    public function insertWorkingReport(Request $request) {
        $input = $request->all();
        $data = $this->reportService->createDataArray($input);
        $workDate = date('Y-m-d', strtotime(str_replace('/', '-', $input['work_date'])));
        $insert = $this->reportService->insertByDate($input, $data, $workDate, $input['listIdWorkingReport']);
        if ($insert) {
            return redirect()->route('report.index')->with('success', 'Thành công');
        } else {
            return redirect()->route('report.index')->with('error', 'Thất bại');
        }
    }

    /**
     * getdata for view default
     * @return array
     */
    private function getDataForIndex() {
        $listIdWorkingReport = "";
        $project = $this->reportService->getProject();
        $user = $this->reportService->getUser();
        $block = $this->reportService->getBlock();
        $job = $this->reportService->getJob();
        $sql = $this->reportService->reportLatest();
        $query = $this->reportService->unCompleteWork();
        return [$project, $user, $block, $job, $sql, $query, $listIdWorkingReport];
    }
}
