<?php

namespace Modules\Users\Repositories;

use Core\AbstractBaseRepository;
use Illuminate\Support\Facades\DB;
use Modules\Users\Entities\User;

class UsersRepository extends AbstractBaseRepository implements UsersInterface
{

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        $sql_string = $this->_createGetUserSql();

        return DB::select(DB::raw($sql_string));
    }

    private function _createGetUserSql()
    {
        $sql_string = 'SELECT
                            users.id,
                            users.user_login,
                            users.fullname,
                            users.department_id,
                            departments.department_name,
                            users.block_id,
                            blocks.block_name,
                            users.role_id,
                            roles.role_name,
                            users.permission,
                            permissions.permission_name,
                            users.deleted_at
                        FROM
                            `users`
                            INNER JOIN departments ON users.department_id = departments.id
                            INNER JOIN blocks ON users.block_id = blocks.id
                            LEFT JOIN roles ON users.role_id = roles.id
                            LEFT JOIN permissions ON users.permission = permissions.id
                            WHERE users.deleted_at IS NULL';
        return $sql_string;
    }

    public function getUser()
    {
        $aryData = User::all();
        return $aryData;
    }

    public function searchBy($idUser, $block, $department)
    {
        $sql_string = $this->_createGetUserSql();
        if (!empty($block)) {
            $sql_string .= ' AND blocks.id = ' . $block;
        }
        if (!empty($department)) {
            $sql_string .= ' AND departments.id = ' . $department;
        }
        if (!empty($idUser)) {
            $sql_string .= ' AND users.id = ' . '"' . $idUser . '"';
        }
        return $sql_string;
    }

    public function insert($input)
    {
        $rs = User::create($input);
        return $rs;
    }

    public function insertNewUser($input) {
        $data = User::updateOrCreate(
            ['user_login' => $input['user_login']],
            ['fullname' => $input['fullname'], 'department_id' => $input['department_id'], 'block_id' => $input['block_id'], 'email' => $input['email']]
        );
        return $data;
    }

    public function getById($id)
    {
        $data = User::query()->where('id', [$id])->first();
        return $data;
    }

    public function update($data)
    {
        User::query()->where('id', $data['id'])
                ->update([
                        'fullname' => $data['fullname'],
                        'block_id' => $data['block_id'],
                        'department_id' => $data['department_id'],
                        'role_id' => $data['role_id'],
                        'permission' => $data['permission'],
                        'email' => $data['email']
                ]);
    }

    public function deleteOneById($id)
    {
        $data = User::query()->where('id', $id)->delete();
        return $data;
    }

    public function checkExistEmail($email, $id) {
        $check = DB::table('users')->select(DB::raw('count(*) count'))->where('email', '=', $email)->whereNull('deleted_at');
        if (!empty($id)) {
            $check->where('id', '<>', $id);
        }
        return $check->get();
    }

    public function checkExistUser($userLogin, $id) {
        $check = DB::table('users')->select(DB::raw('count(*) count'))->where('user_login', '=', $userLogin)->whereNull('deleted_at');
        if (!empty($id)) {
            $check->where('id', '<>', $id);
        }
        return $check->get();
    }
}