<?php
/**
 * Created by PhpStorm.
 * User: KyThuat88
 * Date: 6/18/2019
 * Time: 9:54 AM
 */

namespace Modules\Projects\Services;


use Modules\Projects\Repositories\ProjectInterface;

class ProjectServices
{
    private $project;

    public function __construct(ProjectInterface $projectRepo) {
        $this->project = $projectRepo;
    }

    public function getProject() {
        $aryData = $this->project->getProject();
        return $aryData;
    }
    public function ajaxGetAll($corporationName, $projectName) {
        $aryData = $this->project->getToAjax($corporationName,$projectName);
        return $aryData;
    }

    public function deleteOneById($id) {
        $del = $this->project->deleteOneById($id);
        return $del;
    }

    public function getById($id) {
        $getById = $this->project->getById($id);
        return $getById;
    }

    public function updatePj($input) {
        $update = $this->project->update($input);
        return $update;
    }

    public function insertPj($input) {
        $insertPj = $this->project->insert($input);
        return $insertPj;
    }

    public function getAllForIndex() {
        $aryIndex = $this->project->getAll();
        return $aryIndex;
    }

    public function getCprName() {
        $corporationName = $this->project->getCprName();
        return $corporationName;
    }

    public function insertAndUpdatePj($input) {
        if (!empty($input['id'])) {
            return $this->project->update($input);
        } else {
            return $this->project->create($input);
        }
    }

    public function checkDuplicateProject($projectNameAdd, $projectNameEdit, $id) {
        $project_name = $projectNameAdd;
        if (!empty($projectNameAdd)) {
            $project_name = $projectNameEdit;
        }
        $countExistProject = $this->project->countExistProject($project_name, $id);
        $status = 'error';
        $message = 'Không được trùng dự án';
        if ($countExistProject[0]->count == 0) {
            $status = 'success';
            $message = 'Thành công';
        }
        return [$status, $message];
    }
}