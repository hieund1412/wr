<?php

namespace Modules\Permissions\Repositories;

use Core\RepositoryInterface;
use DB;

interface PermissionsInterface extends RepositoryInterface
{
    public function getAll();

    public function insert($action_screen,$permission_name,$permission_note);

    public function getById($id);

    public function getDataScreen();

    public function getScreenById($id);

    public function update($action_screen,$permission_name,$permission_note,$id);

    public function getPermission();

    public function joinPermission();

    public function countExistPermission($permission_name);

    public function getPermissionToCheck($permission_name, $id);
}