<?php

namespace Modules\Workflow\Repositories;

use Core\RepositoryInterface;
use DB;

interface WorkflowInterface extends RepositoryInterface
{
    public function getAll();
    public function getWorkflowByUser($user_login);
    public function update($data);
    public function searchBy($userSearch, $from_date, $to_date,$block,$department,$progress,$late);
    public function getJob();
    public function getProject();
}