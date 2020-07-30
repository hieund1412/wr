<?php
/**
 * Created by PhpStorm.
 * User: anhnv
 * Date: 4/16/2019
 * Time: 11:16 AM
 */

namespace Modules\Auth\Entities;

use Core\BaseModel as Eloquent;

class PermissionRole extends Eloquent
{
    protected $table = 'permission_role';
    protected $fillable = [
        'permission_id',
        'role_id',
    ];
}