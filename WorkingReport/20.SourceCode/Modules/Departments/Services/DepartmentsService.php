<?php
namespace Modules\Departments\Services;
use Modules\Blocks\Repositories\BlockInterface;
use Modules\Departments\Repositories\DepartmentsInterface;

/**
 * Class DepartmentsService
 * Xử lý logic của Module Departments
 * @author HieuND
 * @access public
 * @package Modules\Departments\Services
 * @see __construct()
 * @see getBlock()
 * @see getAllDataDepartment()
 * @see insertDataDepartment()
 * @see updateDataDepartment()
 * @see deleteOneById()
 */
class DepartmentsService {
    private $_blockInterface;
    private $_departmentInterface;

    /**
     * DepartmentsService constructor.
     * @author HieuND
     * @access public
     * @param BlockInterface $blockInterface
     * @param DepartmentsInterface $departmentInterface
     */
    public function __construct(BlockInterface $blockInterface, DepartmentsInterface $departmentInterface) {
        $this->_blockInterface = $blockInterface;
        $this->_departmentInterface = $departmentInterface;
    }

    /**
     * Lấy tất cả dữ liệu trong table blocks
     * @author HieuND
     * @access public
     * @return mixed
     */
    public function getBlock() {
        return $this->_blockInterface->getBlock();
    }

    public function getDepartment() {
        return $this->_departmentInterface->getDepartment();
    }

    /**
     * Lấy tất cả dữ liệu trong table departments
     * @author HieuND
     * @access public
     * @return mixed
     */
    public function getAllDepartmentData() {
        return $this->_departmentInterface->getDepartmentData();
    }

    /**
     * Kiểm tra dữ liệu trong DB và thực hiện insert
     * @author HieuND
     * @access public
     * @param $input
     * @return boolean
     */
    public function insertDepartmentData($input) {
        $checkDuplicateDepartmentName = $this->_departmentInterface->findOneBy('department_name', $input['department_name']);
        if (!empty($checkDuplicateDepartmentName)) {
            return back()->with('error', 'Tên phòng ban đã tồn tại');
        }
        $isSuccess = $this->_departmentInterface->insertDepartmentData($input);
        $statusInsert = 'error';
        $messageStatus = 'Thêm mới phòng ban thất bại';
        if ($isSuccess) {
            $statusInsert = 'success';
            $messageStatus = 'Thêm mới phòng ban thành công';
        }
        return back()->with($statusInsert, $messageStatus);
    }

    /**
     * Kiểm tra dữ liệu trong DB và thực hiện update
     * @author HieuND
     * @access public
     * @param $data
     * @return boolean
     */
    public function updateDepartmentData($data) {
        $getIdDepartment = $this->_departmentInterface->findOneById($data['id']);
        if ($getIdDepartment->department_name != $data['department_name']) {
            $checkDuplicateDepartmentName = $this->_departmentInterface->findOneBy('department_name', $data['department_name']);
            if (!empty($checkDuplicateDepartmentName)) {
                return back()->with('error', 'Tên phòng ban đã tồn tại');
            }
        }
        $isSuccess = $this->_departmentInterface->updateDepartmentData($data);
        $statusUpdate = 'error';
        $messageStatus = 'Sửa đổi phòng ban thất bại';
        if ($isSuccess) {
            $statusUpdate = 'success';
            $messageStatus = 'Sửa đổi phòng ban thành công';
        }
        return back()->with($statusUpdate, $messageStatus);
    }

    /**
     * @author HieuV
     * @param $data
     * @return mixed
     */
    public function insertAndUpdateDepartment($data) {
        if (!empty($data['id'])) {
            return $this->_departmentInterface->updateDepartmentData($data);
        } else {
            return $this->_departmentInterface->insertDepartmentData($data);
        }
    }

    /**
     * Xóa dữ liệu
     * @author HieuND
     * @access public
     * @param $id
     * @return bool
     */
    public function deleteOneById($id) {
        $isSuccess = $this->_departmentInterface->deleteOneById($id);
        $statusDelete = 'error';
        $messageStatus = 'Xóa phòng ban thất bại';
        if ($isSuccess) {
            $statusDelete = 'success';
            $messageStatus = 'Xóa phòng ban thành công';
        }
        return back()->with($statusDelete, $messageStatus);
    }

    /**
     * @param $department_name_add
     * @param $department_name_edit
     * @param $id
     * @return array
     */
    public function checkDuplicateBlock($department_name_add, $department_name_edit, $id) {
        $department_name = $department_name_add;
        if (!empty($department_name_edit)) {
            $department_name = $department_name_edit;
        }
        $countExistDepartment = $this->_departmentInterface->countExistDepartment($department_name, $id);
        $status = 'error';
        $message = 'Không được trùng tên phòng ban';
        if ($countExistDepartment[0]->count == 0) {
            $status = 'success';
            $message = 'Thành công';
        }
        return [$status, $message];
    }
}