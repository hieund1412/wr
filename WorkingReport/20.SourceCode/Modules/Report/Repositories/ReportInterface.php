<?php

namespace Modules\Report\Repositories;

use Core\RepositoryInterface;
use DB;

interface ReportInterface extends RepositoryInterface {
    public function getAll();

    public function unComplete($user_login);

    public function reportLatest($user_login);

    public function insert($input, $workDate);

    public function deleteExistReport($listIds);

    public function  getReport();

    public function getJob();

    public function getProject();

    public function getListIdWorkingReportByDate($data);

    public function getProjectNameById($projectId);

    public function getJobTypeById($workType);

    public function getBlockEmailByUser($userLogin, $blockIdByUser);
}