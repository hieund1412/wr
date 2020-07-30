<?php
namespace Modules\Departments\Repositories;
use Core\AbstractBaseRepository;
use Modules\Departments\Entities\Department;
use DB;

/**
 * Class DepartmentsRepository
 * @author HieuND
 * @access public
 * @package Modules\Departments\Repositories
 * @see __construct()
 * @see getDataDepartment()
 * @see getDepartment()
 * @see getDataByIdDepartment()
 * @see insertDataDepartment()
 * @see updateDataDepartment()
 */
class DepartmentsRepository extends AbstractBaseRepository implements DepartmentsInterface {
    /**
     * DepartmentsRepository constructor.
     * @author HieuND
     * @access public
     * @param Department $model
     */
    public function __construct(Department $model) {
        parent::__construct($model);
    }

    /**
     * Lấy tất cả dữ liệu trong table departments với điều kiện delete_at = null và sắp xếp giảm dần theo id
     * @author HieuND
     * @access public
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getDepartmentData() {
        return Department::query()->join('blocks', 'departments.block_id', '=', 'blocks.id')
            ->select('departments.id', 'departments.block_id', 'blocks.block_name', 'departments.department_name', 'departments.department_note')
            ->whereNull('departments.deleted_at')->orderBy('departments.id', 'desc')->get();
    }

    /**
     * Lấy tất cả dữ liệu trong table departments
     * @author HieuND
     * @access public
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getDepartment() {
        return Department::all();
    }

    public function getDepartmentByBlock($block_id) {
        return Department::query()->join('blocks', 'departments.block_id', '=', 'blocks.id')
            ->select('department_name', 'departments.id')->where('blocks.id', '=', $block_id)
            ->whereNull('departments.deleted_at')->get();
    }

    /**
     * Lấy dữ liệu theo id
     * @author HieuND
     * @access public
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getDataByDepartmentId($id) {
        return $this->findOneById($id);
    }

    /**
     * Insert dữ liệu vào trong DB, create() trả về trạng thái true-false
     * @author HieuND
     * @access public
     * @param $input
     * @return mixed
     */
    public function insertDepartmentData($input) {
        return Department::create($input);
    }

    /**
     * Update dữ liệu vào trong DB
     * @author HieuND
     * @access public
     * @param $data
     * @return bool
     * @throws \Core\RepositoryException
     */
    public function updateDepartmentData($data) {
        return $this->updateOneById($data['id'],
            [
                'block_id' => $data['block_id'],
                'department_name' => $data['department_name'],
                'department_note' => $data['department_note']
            ]
        );
    }

    public function countExistDepartment($departmentName, $id) {
        $countExistProject = DB::table('departments')->select(DB::raw('count(*) count'))->where('department_name', '=', $departmentName);
        if (!empty($id)) {
            $countExistProject->where('id', '<>', $id);
        }
        return $countExistProject->get();
    }
}