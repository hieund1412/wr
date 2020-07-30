<?php
namespace Modules\Departments\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Modules\Departments\Services\DepartmentsService;

/**
 * Class DepartmentsController
 * @AnnotatedDescription(allow=true,desc="Quản lý phòng ban")
 * @author HieuND
 * @access public
 * @package Modules\Departments\Http\Controllers
 * @see __construct()
 * @see index()
 * @see processInsertDepartment()
 * @see processUpdateDepartment()
 * @see processDeleteDepartment()
 */
class DepartmentsController extends Controller {
    private $_departmentsService;

    /**
     * DepartmentsController constructor.
     * @author HieuND
     * @access public
     * @param DepartmentsService $departmentsService
     */
    public function __construct(DepartmentsService $departmentsService) {
        $this->_departmentsService = $departmentsService;
    }

    /**
     * @AnnotatedDescription(allow=true,desc="Quản lý phòng ban")
     * @author HieuND
     * @access public
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $getDataDepartment = $this->_departmentsService->getAllDepartmentData();
        $getDataBlock = $this->_departmentsService->getBlock();
        return view('departments::index', compact('getDataDepartment', 'getDataBlock'));
    }

    /**
     * @AnnotatedDescription(allow=true,desc="Thêm mới phòng ban")
     * @author HieuND
     * @access public
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processInsertDepartment(Request $request) {
        $aryInsertDepartment = $request->all();
        $this->_departmentsService->insertAndUpdateDepartment($aryInsertDepartment);
        return redirect()->route('departments.index');
    }

    /**
     * @AnnotatedDescription(allow=true,desc="Chỉnh sửa phòng ban")
     * @author HieuND
     * @access public
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processUpdateDepartment(Request $request) {
        $aryUpdateDepartment = $request->all();
        $this->_departmentsService->insertAndUpdateDepartment($aryUpdateDepartment);
        return redirect()->route('departments.index');
    }

    /**
     * @AnnotatedDescription(allow=true,desc="Xóa phòng ban")
     * @author HieuND
     * @access public
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processDeleteDepartment($id) {
        $this->_departmentsService->deleteOneById($id);
        return redirect()->route('departments.index');
    }

    /**
     * @author HieuV
     * @access public
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxCheckDuplicateDepartment() {
        $id = Input::get('id_check');
        $departmentNameAdd = Input::get('department_name_add');
        $departmentNameEdit = Input::get('department_name_edit');
        list($status, $message) = $this->_departmentsService->checkDuplicateBlock($departmentNameAdd, $departmentNameEdit, $id);
        return response()->json(['status' => $status, 'message' => $message]);
    }
}
