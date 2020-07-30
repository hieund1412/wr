<?php

namespace Modules\Report\Repositories;

use Carbon\Carbon;
use Core\AbstractBaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Report\Entities\Report;
use Modules\Statistic\Model\Statistic;

class ReportRepository extends AbstractBaseRepository implements ReportInterface {
    public function __construct(Report $model) {
        parent::__construct($model);
    }

    public function getAll() {
        $sql_string = 'SELECT wk.id
              , wk.project_id
              , wk.relate_block
              , wk.work_content
              , wk.work_type
              , wk.note
              , wk.user_login
              , wk.execute_time
              , wk.progress
              , wk.target
              , wk.result
              , wk.late
              , pj.project_name
              , users.fullname
              , wk.work_date
              , Perform.block_name perform_block
              , Perform.id per_id
			  , Relate.block_name relation_block
			  , Relate.id re_id
              , departments.department_name
              , jobs.job_type
              FROM working_report wk
              INNER JOIN `projects` pj ON wk.project_id = pj.id
              INNER JOIN users ON wk.user_login = users.user_login 
              INNER JOIN blocks Perform ON users.block_id = Perform.id  
			  INNER JOIN blocks Relate ON wk.relate_block = Relate.id  
              INNER JOIN jobs ON wk.work_type = jobs.id  
              INNER JOIN departments ON users.department_id = departments.id ';
        return $sql_string;
    }

    public function  getReport() {
        $aryData = Report::all();
        return $aryData;
    }

    public function unComplete($user_login) {
        $query_string = $this->getAll();
        $query_string .= 'WHERE DATE(work_date) BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND DATE_SUB(CURDATE(), INTERVAL 1 DAY) 
                AND wk.user_login = "'.$user_login.'"
                AND progress < 100
                AND wk.deleted_at IS NULL
                ORDER BY work_date DESC';
        return DB::select(DB::raw($query_string));
    }

    public function reportLatest($user_login) {
       $query_string = $this->getAll();
       $query_string.= 'INNER JOIN (
                SELECT DATE(MAX(work_date)) as max_work_date FROM working_report wrd
                WHERE wrd.user_login = "'.$user_login.'"
                AND wrd.deleted_at IS NULL
                ) mx on date(work_date) = mx.max_work_date
                WHERE wk.user_login = "'.$user_login.'"
                    AND wk.deleted_at IS NULL
                ORDER BY work_date DESC ';
       return DB::select(DB::raw($query_string));
    }

    public function getListIdWorkingReportByDate($workDate) {
        $data = DB::table('working_report')->distinct('id')->where('work_date',$workDate)->whereNull('deleted_at')->where('user_login', Auth::user()->user_login)->pluck('id')->toArray();
        return $data;
    }

    public function getJob() {
        $sql_string = 'SELECT DISTINCT jobs.job_type, jobs.id, users.block_id from users 
                                INNER JOIN jobs on users.block_id = jobs.block_id
                                where users.user_login = "'.Auth::user()->user_login.'"
                                AND jobs.deleted_at IS NULL';
        return DB::select(DB::raw($sql_string));
    }

    public function getProject() {
        $sql_string = 'SELECT DISTINCT projects.project_name, projects.id, users.block_id from users 
                                INNER JOIN project_block on users.block_id = project_block.block_id
                                INNER JOIN projects on project_block.project_id = projects.id
                                where users.user_login = "'.Auth::user()->user_login.'"
                                AND projects.deleted_at IS NULL';
        return DB::select(DB::raw($sql_string));
    }

    public function insert($input, $workDate) {
        foreach($input as $item) {
            $value = Report::updateOrCreate([
                    'work_content' => $item['work_content'],
                    'relate_block' => $item['relate_block'],
                    'user_login' => Auth::user()->user_login,
                    'project_id' => $item['project_id'],
                    'work_type' => $item['work_type'],
                    'execute_time' => $item['execute_time'],
                    'progress' => $item['progress'],
                    'target' => $item['target'],
                    'result' => $item['result'],
                    'late' => isset($item['late']) ? $item['late'] : 0,
                    'work_date' => $workDate,
                    'note' => $item['note'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
        return $value;
    }

    public function deleteExistReport($listIds) {
            $this->deleteManyByIds($listIds);
    }

    public function getProjectNameById($projectId) {
        $getProjectName = DB::table('projects')->where('id','=',$projectId)->first()->project_name;
        return $getProjectName;
    }

    public function getJobTypeById($workType) {
        $getJobType = DB::table('jobs')->where('id','=',$workType)->first()->job_type;
        return $getJobType;
    }

    public function getBlockEmailByUser($userLogin, $blockIdByUser){
        $blockEmail = DB::table('users')
            ->join('blocks','users.block_id', '=', 'blocks.id')
            ->where('users.user_login', '=', $userLogin)
            ->where('users.block_id', '=', $blockIdByUser)->first()->block_email;
        return $blockEmail;
        
    }
}