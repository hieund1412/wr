<?php

namespace Modules\Permissions\Http\Controllers;

use Core\AnnotationsInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Modules\Permissions\Entities\Permission;
use Modules\Permissions\Repositories\PermissionsInterface;
use Modules\Permissions\Services\PermissionsService;

/**
 * @author HieuV
 * @AnnotatedDescription(allow=true,desc="Quản lý nhóm quyền")
 */
class PermissionsController extends Controller {

    protected $permissionService;
    public function __construct(PermissionsService $permissionsService, AnnotationsInterface $annotations) {
        $this->permissionService = $permissionsService;
    }
    /**
     * @author HieuV
     * @AnnotatedDescription(allow=true,desc="Quản lý nhóm quyền")
     */
    public function index() {
        $data = $this->permissionService->getAllForIndex();
        return view('permissions::index',compact('data'));
    }


    /**
     * @author HieuV
     * @AnnotatedDescription(allow=true,desc="Thêm mới nhóm quyền")
     */
    public function create() {
        return view('permissions::view_final');
    }

    /**
     * @param $permissionId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author HieuV
     * @AnnotatedDescription(allow=true,desc="Sửa đổi nhóm quyền")
     */

    public function update($permissionId) {
        $data = $this->permissionService->getById($permissionId);
        return view('permissions::view_final',compact('data'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @author HieuV
     * @AnnotatedDescription(allow=true,desc="Xóa nhóm quyền")
     */
    public function destroy($id) {
        $this->permissionService->deleteOneById($id);
        return redirect()->route('permissions.index');
    }

    /**
     * @author HieuV
     * lấy ra data để insert
     */
    public function getDataToInsert() {
        $dataToInsert = $this->permissionService->dataTreeInsert();
        return $dataToInsert;
    }

    /**
     * @author HieuV
     * @param $id
     * @return array
     * lấy ra cây quyền
     */
    public function getDataTree($id){
        $dataTree = $this->permissionService->getDataTree($id);
        return $dataTree;
    }

    /**
     * @author HieuV
     * đẩy các input lấy từ index lên để xử lý insert
     */
    public function ajaxGetPermissionScreen() {
        $action_screen = Input::get('checkedIds');
        $permission_name = Input::get('permission_name');
        $permission_note = Input::get('permission_note');
        $id = Input::get('id');
        list($status, $message) = $this->permissionService->insertAndUpdateScreen($action_screen, $permission_name, $permission_note, $id);
        return response()->json(['status' => $status, 'message' => $message]);
    }

}
