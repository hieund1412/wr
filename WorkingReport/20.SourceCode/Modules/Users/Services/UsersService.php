<?php

namespace Modules\Users\Services;

use Illuminate\Support\Facades\Auth;
use Modules\Blocks\Repositories\BlockInterface;
use Modules\Departments\Repositories\DepartmentsInterface;
use Modules\Permissions\Repositories\PermissionsInterface;
use Modules\Roles\Repositories\RolesInterface;
use Modules\Users\Repositories\UsersInterface;
use Illuminate\Support\Facades\DB;

class UsersService
{
    private $block;
    private $departments;
    private $role;
    private $permission;
    private $user;

    public function __construct(
          BlockInterface $block
        , DepartmentsInterface $departments
        , RolesInterface $role
        , PermissionsInterface $permissions
        , UsersInterface $user
    )
    {
        $this->block = $block;
        $this->departments = $departments;
        $this->role = $role;
        $this->permission = $permissions;
        $this->user = $user;
    }

    public function getUser()
    {
        $aryData = $this->user->getAll();
        return $aryData;
    }

    public function searchBy($idUser, $block, $department)
    {
        $aryData = $this->user->searchBy($idUser, $block, $department);
        return DB::select(DB::raw($aryData));
    }

    public function insert($input)
    {
        $checkUserLogin = $this->user->findOneBy('user_login', $input['user_login']);
        $checkUserEmail = $this->user->findOneBy('email',$input['email']);
        if (!empty($checkUserLogin)) {
            return back()->with('error', 'Tên đăng nhập đã tồn tại');
        } if (!empty($checkUserEmail)) {
            return back()->with('error', 'Email đã tồn tại');
        }
        $aryData = $this->user->insert($input);
        return $aryData;
    }

    public function insertNewUser($input) {
        return $this->user->insertNewUser($input);        
    }

    public function update($data)
    {
        $checkUserEmail = $this->user->findDiffOneByCondition('id', $data['id'], 'email', $data['email']);
        if (!empty($checkUserEmail)) {
            return back()->with('error', 'Email đã tồn tại');
        }
        $aryData = $this->user->update($data);
        return $aryData;
    }

    public function deleteOneById($id)
    {
        $aryData = $this->user->deleteOneById($id);
        return $aryData;
    }

    public function searchDataByUser($type,$block_id,$department_id)
    {
        if ($type == 'block') {
            $data = $this->departments->findAllByCredentials(['block_id' => $block_id]);
        } else {
            $data = $this->user->findAllByCredentials(['block_id' => $block_id, 'department_id' => $department_id]);
        }
        return $data->toArray();
    }

    public function getUserByUsername($user_login)
    {
        return $this->user->findOneBy('user_login', $user_login);
    }

    public function getById($id)
    {
        $aryData = $this->user->getById($id);
        return $aryData;
    }

    public function startViewUser()
    {
        $aryData = $this->user->getAll();
        return $aryData;
    }

    public function getBlock()
    {
        $aryData = $this->block->getBlock();
        return $aryData;
    }

    public function getDepartment()
    {
        $aryData = $this->departments->getDepartment();
        return $aryData;
    }

    public function getDepartmentByBlock($block_id) {
        return $this->departments->getDepartmentByBlock($block_id);
    }

    public function getRole()
    {
        $aryData = $this->role->getRole();
        return $aryData;
    }

    public function getPermission()
    {
        $aryData = $this->permission->getPermission();
        return $aryData;
    }

    public function checkDuplicateEmail($email, $id, $user_login) {
        $checkExistEmail = $this->user->checkExistEmail($email, $id);
        $checkExistUser = $this->user->checkExistUser($user_login, $id);
        $status = 'error';
        $message = 'Không được trùng tên đăng nhập hoặc email';
        if (!empty($user_login)) {
            if (!$checkExistUser[0]->count == 0 && $checkExistEmail[0]->count == 0) {
                $message = 'Tên đăng nhập đã tồn tại';
            }
        }
        if (!$checkExistEmail[0]->count == 0 && $checkExistUser[0]->count == 0) {
            $message = 'Không được trùng email';
        }
        if ($checkExistEmail[0]->count == 0 && $checkExistUser[0]->count == 0) {
            $status = 'success';
            $message = 'Thành công';
        }
        return [$status, $message];
    }
}