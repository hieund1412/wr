<?php

namespace Modules\Jobs\Repositories;

use Core\RepositoryInterface;
use DB;

interface JobsInterface extends RepositoryInterface
{

    public function getAll();

    public function getById($id);

    public function getJob();

    public function getToAjax($blockId, $jobType);

    public function countExistJob($blockId, $jobType, $id);

    public function update($inputRequest);
}