<?php

namespace Modules\Jobs\Services;

use DB;
use Modules\Blocks\Repositories\BlocksRepository;
use Modules\Jobs\Repositories\JobsInterface;

class JobsService
{

    private $jobRepo;
    private $blockRepo;
    public function __construct(JobsInterface $jobRepo, BlocksRepository $blocksRepo)
    {
        $this->jobRepo = $jobRepo;
        $this->blockRepo = $blocksRepo;
    }

    public function ajaxGetAll($block_id, $job_type) {
        $aryData = $this->jobRepo->getToAjax($block_id, $job_type);
        return $aryData;
    }

    public function deleteOneById($id) {
        $del = $this->jobRepo->deleteOneById($id);
        return $del;
    }

    public function getAll() {
        $dataJobIndex = $this->jobRepo->getAll();
        return  $dataJobIndex;
    }

    public function findAll() {
        $dataBlockIndex = $this->blockRepo->findAll();
        return $dataBlockIndex;
    }

    public function create($input) {
        $create = $this->jobRepo->create($input);
        return $create;
    }

    public function update($input) {
        $update = $this->jobRepo->update($input);
        return $update;
    }

    /**
     * @author HieuV
     * @param $input
     * @return true false to update or insert
     */
    public function createAndUpdateJob($input) {
            if (!empty($input['id'])) {
                return $this->jobRepo->update($input);
            } else {
                return $this->jobRepo->create($input);
            }
    }

    public function checkDuplicateJob($blockIdAdd, $jobTypeAdd, $blockIdEdit, $jobTypeEdit, $id) {
        $blockId = $blockIdAdd;
        $jobType = $jobTypeAdd;
        if (!empty($blockIdEdit) && !empty($jobTypeEdit)) {
            $blockId = $blockIdEdit;
            $jobType = $jobTypeEdit;
        }
        $countExistJob = $this->jobRepo->countExistJob($blockId, $jobType, $id);
        $status = 'error';
        $message = 'Không được trùng dự án';
        if ($countExistJob[0]->count == 0) {
            $status = 'success';
            $message = 'Thành công';
        }
        return [$status, $message];
    }
}