<?php

namespace Modules\Permissions\Services;

use Core\AnnotationsInterface;
use DB;
use Modules\Permissions\Repositories\PermissionsInterface;

class PermissionsService
{
    private $permissionsRepo;
    private $annotation;
    public function __construct(PermissionsInterface $permissionsRepo,AnnotationsInterface $annotations)
    {
        $this->annotation = $annotations;
        $this->permissionsRepo = $permissionsRepo;
    }

    public function insertAndUpdateScreen($action_screen, $permission_name, $permission_note, $id) {
        $countExistPermission = $this->permissionsRepo->countExistPermission($permission_name);
        $getPermissionToCheck = $this->permissionsRepo->getPermissionToCheck($permission_name, $id);
        $status = 'error';
        $message = 'Không được trùng tên nhóm quyền';
        if ($countExistPermission[0]->count == 0) {
            if (isset($id)) {
                $this->permissionsRepo->update($action_screen, $permission_name, $permission_note, $id);
            } else {
                $this->permissionsRepo->insert($action_screen, $permission_name, $permission_note);
            }
            $status = 'success';
            $message = 'Thành công';
        }
        if ($getPermissionToCheck[0]->count == 1) {
            $status = 'success';
            $message = 'Thành công';
            $this->permissionsRepo->update($action_screen, $permission_name, $permission_note, $id);
        }
        return [$status, $message];
    }

    public function getJoinPermission() {
        $aryData = $this->permissionsRepo->joinPermission();
        $aryPer = array();
        foreach ($aryData as $item) {
            array_push($aryPer,$item->action_screen);
        }
        if (empty($aryPer)) {
            $aryPer = array('report.index', 'users.startView', 'menu');
        }
        return $aryPer;
    }

    public function deleteOneById($id) {
        $del = $this->permissionsRepo->deleteOneById($id);
        return $del;
    }

    public function getAllForIndex() {
        $getAll = $this->permissionsRepo->getAll();
        return $getAll;
    }

    public function getById($permissionId) {
        $getForUpdate = $this->permissionsRepo->getById($permissionId);
        return $getForUpdate;
    }

    public function getDataTree($id) {
        $data_tree = $this->annotation->read();
        $array_tree = array();
        $data_screen = $this->permissionsRepo->getScreenById($id);
        $screen = array();
        if (isset($data_screen) && count($data_screen) > 0){
			//Lấy data có permission_id = $id
			//Lấy 1 mảng chứa các action
            foreach ($data_screen as $item) {
                array_push($screen, $item['action_screen']);
            }
        }
		//Lấy ra quyền cha
        foreach ($data_tree as $parent => $each){
            $array_tree[$parent]['id'] = strtolower(substr($each['code'],0,strlen($each['code'])-10));
            $array_tree[$parent]['text'] = $each['desc'];
			//Checked checkBox
            $array_tree[$parent]['checked'] = in_array($array_tree[$parent]['id'], $screen);
			//Lấy ra quyền con
            foreach ($each['methods'] as $key => $children){
                $array_tree[$parent]['children'][$key]['id'] = $children['code'];
                $array_tree[$parent]['children'][$key]['text'] = $children['desc'];
				//Checked checkBox
                $array_tree[$parent]['children'][$key]['checked'] = in_array($array_tree[$parent]['children'][$key]['id'], $screen);
            }
        }
        return $array_tree;
    }

    public function dataTreeInsert() {
        $data_tree = $this->annotation->read();
        $array_tree = array();
        foreach ($data_tree as $parent => $each){
            $array_tree[$parent]['id'] = $each['code'] = strtolower(substr($each['code'],0,strlen($each['code']) - 10));
            $array_tree[$parent]['text'] = $each['desc'];
            foreach ($each['methods'] as $key => $children){
                $array_tree[$parent]['children'][$key]['id'] = $children['code'];
                $array_tree[$parent]['children'][$key]['text'] = $children['desc'];
            }
        }
        return $array_tree;
    }
}