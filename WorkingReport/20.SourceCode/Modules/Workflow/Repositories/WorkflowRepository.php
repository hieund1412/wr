<?php

namespace Modules\Workflow\Repositories;

use Core\AbstractBaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Workflow\Entities\Workflow;

class WorkflowRepository extends AbstractBaseRepository implements WorkflowInterface
{
    public function __construct(Workflow $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
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
              , Perform.block_name AS perform_block
              , Perform.id per_id
			  , Relate.block_name AS relation_block
			  , Relate.id re_id
              , departments.department_name AS department_name
              , jobs.job_type
              FROM working_report wk
              INNER JOIN `projects` pj ON wk.project_id = pj.id
              INNER JOIN users ON wk.user_login = users.user_login 
              INNER JOIN blocks Perform ON users.block_id = Perform.id  
			  INNER JOIN blocks Relate ON wk.relate_block = Relate.id  
              INNER JOIN departments ON users.department_id = departments.id
              INNER JOIN jobs ON wk.work_type = jobs.id  ';
        return $sql_string;
    }

    public function getWorkflowByUser($user_login)
    {
        $sql_string = $this->getAll();
        $sql_string .=' WHERE users.user_login = ' . '"' . $user_login . '"';
        return $sql_string;
    }

    /**
     * Search list data by condition
     * @param $userSearch
     * @param $from_date
     * @param $to_date
     * @param $block
     * @param $department
     * @param $progress
     * @param $late
     * @return string
     */
    public function searchBy($userSearch, $from_date, $to_date, $block, $department, $progress, $late)
    {
        $sql_string = $this->getAll();
        $sql_string .= ' WHERE wk.work_date BETWEEN ' . '"' . $from_date . '" and '.'"'.$to_date.'"';
        $sql_string .= ' AND Perform.id = ' . $block;
        if (!empty($department)) {
            $sql_string .= ' AND departments.id = ' . $department;
        }
        if (!empty($userSearch)) {
            $sql_string .= ' AND users.id = ' . '"' . $userSearch . '"';
        }
        if (!is_null($progress)) {
            if ($progress == 1) {
                $sql_string .= ' AND wk.progress = 100';
            } elseif ($progress == 0) {
                $sql_string .= ' AND wk.progress < 100';
            }
        }
        if (!is_null($late)) {
            if ($late == 1) {
                $sql_string .= ' AND wk.late = 1';
            } elseif ($late == 0) {
                $sql_string .= ' AND wk.late = 0';
            }
        }
        $sql_string .= ' AND wk.deleted_at IS NULL';
        $sql_string .= ' ORDER BY work_date DESC, perform_block ASC, department_name ASC, users.fullname';
        return DB::select(DB::raw($sql_string));
    }

    public function update($data)
    {
        return Workflow::query()->where('id', $data['id'])
            ->update(['relate_block' => $data['relate_block'],
                'work_content' => $data['work_content'],
                'project_id' => $data['project_id'],
                'work_type' => $data['work_type'],
                'execute_time' => $data['execute_time'],
                'progress' => $data['progress'],
                'target' => $data['target'],
                'result' => $data['result'],
                'late' => isset($data['late']) ? $data['late'] : 0
            ]);
    }

    public function getJob() {
        $sql_string = 'SELECT DISTINCT job_type, jobs.id, users.block_id FROM users 
                                INNER JOIN jobs ON users.block_id = jobs.block_id
                                WHERE users.user_login = "'.Auth::user()->user_login.'" AND jobs.deleted_at IS NULL';
        return DB::select(DB::raw($sql_string));
    }

    public function getProject() {
        $sql_string = 'SELECT DISTINCT project_name, projects.id, users.block_id FROM users 
                                INNER JOIN project_block ON users.block_id = project_block.block_id
                                INNER JOIN projects ON project_block.project_id = projects.id
                                WHERE users.user_login = "'.Auth::user()->user_login.'" AND projects.deleted_at IS NULL AND project_block.deleted_at IS NULL';
        return DB::select(DB::raw($sql_string));
    }
}