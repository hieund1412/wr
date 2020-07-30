<?php

namespace Modules\Workflow\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Blocks\Repositories\BlockInterface;
use Modules\Departments\Repositories\DepartmentsInterface;
use Modules\Jobs\Repositories\JobsInterface;
use Modules\Projects\Repositories\ProjectInterface;
use Modules\Users\Repositories\UsersInterface;
use Modules\Workflow\Repositories\WorkflowInterface;

class WorkflowService
{
    private $block;
    private $job;
    private $project;
    private $user;
    private $department;
    private $workflow;

    public function __construct(
        BlockInterface $block
        , JobsInterface $jobs
        , ProjectInterface $project
        , UsersInterface $users
        , DepartmentsInterface $departments
        , WorkflowInterface $workflow
    )
    {
        $this->block = $block;
        $this->job = $jobs;
        $this->project = $project;
        $this->user = $users;
        $this->department = $departments;
        $this->workflow = $workflow;
    }

    public function getWorkflow()
    {
        $user_login = Auth::user()->user_login;
        $aryData = $this->workflow->getWorkflowByUser($user_login);
        return DB::select(DB::raw($aryData));
    }

    public function searchBy($userSearch, $from_date, $to_date, $block, $department, $progress, $late) {
        return $this->workflow->searchBy($userSearch, $from_date, $to_date, $block, $department, $progress, $late);
    }

    public function update($input)
    {
        $aryData = $this->workflow->update($input);
        return $aryData;
    }

    public function searchDataByWorkflow($type, $block_id, $department_id)
    {
        if ($type == 'block') {
            $data = $this->department->findAllByCredentials(['block_id' => $block_id]);
        } else {
            $data = $this->user->findAllByCredentials(['block_id' => $block_id, 'department_id' => $department_id]);
        }
        return $data;
    }

    public function getBlock()
    {
        $aryData = $this->block->getBlock();
        return $aryData;
    }

    public function getJob()
    {
        $aryData = $this->workflow->getJob();
        return $aryData;
    }

    public function getProject()
    {
        $aryData = $this->workflow->getProject();
        return $aryData;
    }

    public function getUser()
    {
        $aryData = $this->user->getUser();
        return $aryData;
    }

    public function getDepartment()
    {
        $aryData = $this->department->getDepartment();
        return$aryData;
    }

}