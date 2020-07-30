<?php
namespace Modules\Departments\Repositories;
use Core\RepositoryInterface;

interface DepartmentsInterface extends RepositoryInterface {
   public function getDepartmentData();

    public function getDataByDepartmentId($id);

    public function insertDepartmentData($input);

    public function deleteOneById($id);

    public function updateDepartmentData($data );

    public function getDepartment();

    public function countExistDepartment($departmentName, $id);

    public function getDepartmentByBlock($blockId);

}