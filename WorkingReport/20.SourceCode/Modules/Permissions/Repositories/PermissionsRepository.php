<?php

namespace Modules\Permissions\Repositories;

use Core\AbstractBaseRepository;
use Auth;
use DB;
use Modules\Permissions\Entities\PermissionScreen;
use Modules\Permissions\Entities\Permission;

class PermissionsRepository extends AbstractBaseRepository implements PermissionsInterface {

    public function __construct(Permission $model) {
        parent::__construct($model);
    }

    public function getAll() {
        $data = Permission::query()->whereNull('deleted_at')->orderBy('id','desc')->get();
        return $data;
    }

    public function getDataScreen() {
        $data = PermissionScreen::query()->get();
        return $data;
    }

    public function getScreenById($id) {
        $data = PermissionScreen::query()->where('permission_id', [$id])->get();
        return $data;
    }

    public function getById($id) {
        $data = Permission::query()->where('id', [$id])->get();
        return $data;
    }

    public function insert($action_screen, $permission_name, $permission_note) {
        $permissions = new Permission();
        $permissions->permission_name = $permission_name;
        $permissions->permission_note = $permission_note;
        $permissions->save();
        foreach ($action_screen as $value) {
            $permission_screen = new PermissionScreen();
            $permission_screen->permission_id = $permissions->id;
            $permission_screen->action_screen = $value;
            $permission_screen->save();
        }
        return isset($permission_screen) ? 1 : 0;
    }

    public function getPermission() {
        $aryData = Permission::all();
        return $aryData;
    }

    public function update($action_screen, $permission_name, $permission_note, $id) {
        DB::beginTransaction();
        try {
            DB::table('permissions')->where('id', $id)->update([
                'permission_name' => $permission_name,
                'permission_note' => $permission_note,
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            if (isset($action_screen)) {
                DB::table('permission_screen')->where('permission_id', $id)
                    ->delete();
                foreach ($action_screen as $acion_per => $value) {
                    DB::table('permission_screen')
                        ->where('permission_id', $id)
                        ->insert(['action_screen' => $value,
                            'permission_id' => $id]);
                };
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function joinPermission() {
        $permission = Auth::user()->permission;
        if (!$permission) return [];
        $dataJoin = 'SELECT
                            permission_screen.action_screen
                    FROM `permission_screen`
                    LEFT JOIN `users` ON permission_screen.permission_id = users.permission
                    WHERE '.$permission.' = permission_screen.permission_id';
        return DB::select(DB::raw($dataJoin));
    }

    public function deleteOneById($id) {
        Permission::query()->where('id', $id)->update(['deleted_at' => date("Y-m-d H:i:s")]);
    }

    public function countExistPermission($permission_name) {
        $countExistPermission = DB::table('permissions')->select(DB::raw('count(*) count'))
                ->where('permission_name', '=', $permission_name);
        return $countExistPermission->get();
    }

    public function getPermissionToCheck($permission_name, $id) {
        $getPermissionToCheck = DB::table('permissions')->select(DB::raw('count(*) count'))->where('permission_name', '=', $permission_name)->where('id', '=', $id);
        return $getPermissionToCheck->get();
    }
}