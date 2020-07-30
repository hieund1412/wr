<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Modules\Users\Services\UsersService;
use Modules\Auth\Http\Controllers\LoginController;

/**
 * @AnnotatedDescription(allow=true,desc="Quản lý người dùng")
 */
class UsersController extends Controller
{
    private  $usersService;
    private  $loginController;

    public function __construct(UsersService $usersService, LoginController $loginController) {
        $this->usersService = $usersService;
        $this->loginController = $loginController;
    }

    /**
     * @author HieuBee
     * @AnnotatedDescription(allow=true,desc="Quản lý người dùng")
     */
    public function index()
    {
        $data = $this->usersService->getUser();
        $block = $this->usersService->getBlock();
        $department = $this->usersService->getDepartment();
        $role = $this->usersService->getRole();
        $permission = $this->usersService->getPermission();
        return view('users::index',compact('data', 'block', 'department', 'role', 'permission'));
    }

    /**
     * @author HieuBee
     * @AnnotatedDescription(allow=true,desc="Lấy dữ liệu từ input")
     * @return mixed
     */
    public function getData()
    {
        $type = Input::get('type');
        $blockId = Input::get('block_id');
        $departmentId = Input::get('department_id');
        $data = $this->usersService->searchDataByUser($type, $blockId, $departmentId);
        return $data;
    }

    /**
     * action tra cuu
     * @author HieuBee
     * @AnnotatedDescription(allow=true,desc="Tìm kiếm người dùng")
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search() {
        $idUser = Input::get('fullname');
        $block = Input::get('block');
        $department = Input::get('department');
        $data = $this->usersService->searchBy($idUser, $block, $department);
        return view('users::table_user',compact('data'));
    }

    /**
     * @author HieuBee
     * @AnnotatedDescription(allow=true,desc="Thêm mới người dùng")
     */
    public function create()
    {
        $user = $this->usersService->getUser();
        $block = $this->usersService->getBlock();
        $depart = $this->usersService->getDepartment();
        $role = $this->usersService->getRole();
        $permission = $this->usersService->getPermission();
        return view('users::form_insert',compact('user', 'block', 'depart', 'role', 'permission'));
    }

    /**
     * @author HieuBee
     * @AnnotatedDescription(allow=false,desc="Xử lý thêm mới người dùng")
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $this->usersService->insert($input);
        return redirect()->route('users.index');
    }

    /**
     * @author HieuBee
     * @AnnotatedDescription(allow=true,desc="Chỉnh sửa người dùng")
     */
    public function edit($id)
    {
        $data = $this->usersService->getById($id);
        $block = $this->usersService->getBlock();
        $depart = $this->usersService->getDepartmentByBlock($data['block_id']);
        $role = $this->usersService->getRole();
        $permission = $this->usersService->getPermission();
        return view('users::form_edit',compact('data', 'block', 'depart', 'role', 'permission'));
    }

    /**
     * @author HieuBee
     * @AnnotatedDescription(allow=true,desc="Bàn làm việc")
     */
    public function startViewUser()
    {
        $user = $this->usersService->getUser();
        $block = $this->usersService->getBlock();
        $depart = $this->usersService->getDepartment();
        return view('users::startViewUser', compact('user', 'block', 'depart'));
    }

    public function processInsertNewUser(Request $request) { 
        $input = $request->all();
        $this->usersService->insertNewUser($input);
        $request->password = Session::get('password');
        Session::put('password', null);
        return $this->loginController->login($request);
    }

    /**
     * @author HieuBee
     * @AnnotatedDescription(allow=false,desc="Xử lý chỉnh sửa người dùng")
     */
    public function update(Request $request,$id)
    {
        $input = $request->all();
        $input['id'] = $id;
        $this->usersService->update($input);
        return redirect()->route('users.index');
    }

    /**
     * @author HieuBee
     * @AnnotatedDescription(allow=true,desc="Xóa người dùng")
     */
    public function destroy($id)
    {
        $this->usersService->deleteOneById($id);
        return redirect()->route('users.index');
    }

    public function checkDuplicateEmail() {
        $id = Input::get('id_check');
        $email = Input::get('email');
        $userLogin = Input::get('user_login_check');
        list($status, $message) = $this->usersService->checkDuplicateEmail($email, $id, $userLogin);
        return response()->json(['status' => $status, 'message' => $message]);
    }
}
