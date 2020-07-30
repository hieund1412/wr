<?php

namespace Modules\ProjectBlocks\Services;
use DB;
use Modules\Blocks\Repositories\BlocksRepository;
use Modules\ProjectBlocks\Repositories\ProjectBlocksInterface;
use Modules\Projects\Repositories\ProjectInterface;

class ProjectBlocksService
{
    private $blockRepo;
    private $projectRepo;
    private $projectBlockRepo;
    public function __construct(ProjectBlocksInterface $projectBlocksRepo,
                                BlocksRepository $blockRepo,
                                ProjectInterface $projectRepo)
    {
        $this->blockRepo = $blockRepo;
        $this->projectRepo = $projectRepo;
        $this->projectBlockRepo = $projectBlocksRepo;
    }

    public function ajaxGetAll($block_name, $project_name) {
        $aryData = $this->projectBlockRepo->getToAjax($block_name, $project_name);
        return $aryData;
    }

    public function deleteOneById($id) {
        $del = $this->projectBlockRepo->deleteOneById($id);
        return $del;
    }

    public function getAll() {
        $dataAll = $this->projectBlockRepo->getAll();
        return $dataAll;
    }

    public function getBlockName() {
        $blockName = $this->projectBlockRepo->getBlockName();
        return $blockName;
    }

    public function findAllBlock() {
        $dataBlock = $this->blockRepo->findAll();
        return $dataBlock;
    }

    public function findAllProject() {
        $dataProject = $this->projectRepo->findAll();
        return $dataProject;
    }

    public function createAndUpdateProjectBlock($input) {
            if (!empty($input['id'])) {
                return $this->projectBlockRepo->update($input);
            } else {
                return $this->projectBlockRepo->create($input);
            }
    }

    public function checkDuplicatePjB($projectIdAdd, $projectNameEdit, $id) {
        $project_id = $projectIdAdd;
        if (!empty($projectNameEdit)) {
            $project_id = $projectNameEdit;
        }
        $countExistPjB = $this->projectBlockRepo->countExistPjB($project_id, $id);
        $status = 'error';
        $message = 'Không được trùng dự án';
        if ($countExistPjB[0]->count == 0) {
            $status = 'success';
            $message = 'Thành công';
        }
        return [$status, $message];
    }
}