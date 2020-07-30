<?php

namespace Modules\Permissions\Services;


class CommonMenu
{
    public static $menu = [
        array(
            'route' => 'menu',
            'class' => 'waves-effect',
            'icon' => 'menu-icon glyphicon glyphicon-home',
            'text' => 'Bàn làm việc',
        ),
        array(
            'route' => '#',
            'icon' => 'menu-icon fa fa-user',
            'class' => 'menu-dropdown',
            'text' => 'Quản lý chung',
            'child' => array(
                array(
                    'route' => 'users.index',
                    'class' => 'waves-effect',
                    'icon' => 'menu-icon fa fa-leanpub',
                    'text' => 'Quản lý người dùng'
                ),
                array(
                    'route' => 'block.index',
                    'class' => 'waves-effect',
                    'icon' => 'menu-icon fa fa-cubes',
                    'text' => 'Quản lý khối'
                ),
                array(
                    'route' => 'departments.index',
                    'class' => 'waves-effect',
                    'icon' => 'menu-icon fa fa-archive',
                    'text' => 'Quản lý phòng ban'
                ),
                array(
                    'route' => 'permissions.index',
                    'class' => 'waves-effect',
                    'icon' => 'menu-icon fa fa-street-view',
                    'text' => 'Quản lý nhóm quyền'
                ),
            )
        ),

        array(
            'route' => '#',
            'class' => 'menu-dropdown',
            'icon' => 'menu-icon fa fa-user',
            'text' => 'Quản lý dự án và công việc',
            'child' => [
                array(
                    'route' => 'projects.list',
                    'class' => 'waves-effect admin',
                    'icon' => 'menu-icon fa fa-book',
                    'text' => 'Quản lý dự án'
                ),
                array(
                    'route' => 'projectblock.index',
                    'class' => 'waves-effect admin',
                    'icon' => 'menu-icon fa fa-building',
                    'text' => 'Quản lý dự án theo khối'
                ),
                array(
                    'route' => 'jobs.index',
                    'class' => 'waves-effect admin',
                    'icon' => 'menu-icon fa fa-simplybuilt',
                    'text' => 'Quản lý loại công việc'
                ),
            ]
        ),

        array(
            'route' => '#',
            'class' => 'menu-dropdown',
            'icon' => 'menu-icon fa fa-newspaper-o',
            'text' => 'Báo cáo công việc',
            'child' => [
                array(
                    'route' => 'report.index',
                    'class' => 'waves-effect admin',
                    'icon' => 'menu-icon fa fa-plus',
                    'text' => 'Tạo mới báo cáo'
                ),
                array(
                    'route' => 'workflow.view',
                    'class' => 'waves-effect',
                    'icon' => 'menu-icon fa fa-newspaper-o',
                    'text' => 'Quản lý công việc',
                ),
            ]
        ),
        array(
            'route' => '#',
            'class' => 'menu-dropdown',
            'icon' => 'menu-icon fa fa-tasks',
            'text' => 'Thống kê',
            'child' => [
                array(
                    'route' => 'statiscalProject.index',
                    'class' => 'waves-effect admin',
                    'icon' => 'menu-icon fa fa-tasks',
                    'text' => 'Thống kê Theo dự án'
                ),
                array(
                    'route' => 'statistic.employees',
                    'class' => 'waves-effect admin',
                    'icon' => 'menu-icon fa fa-group',
                    'text' => 'Thống kê theo nhân viên'
                ),
            ]
        ),
        /*array(
            'route' => '#',
            'class' => 'waves-effect',
            'icon' => 'menu-icon fa fa-building',
            'text' => 'Test',
            'child' => [
                array(
                    'route' => 'statistic.employees',
                    'class' => 'waves-effect',
                    'icon' => 'menu-icon fa fa-plus',
                    'text' => 'Test1'
                ),
            ]
        ),*/
    ];


}