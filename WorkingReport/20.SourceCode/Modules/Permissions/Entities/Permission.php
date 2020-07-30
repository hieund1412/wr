<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/27/2019
 * Time: 2:00 PM
 */

namespace Modules\Permissions\Entities;

use DB;
use Illuminate\Database\Eloquent\Model as BaseModel;
class Permission extends BaseModel
{
    protected $table = 'permissions';

    public $fillable = [
        'permission_name',
        'permission_note',
        'delete_at'
    ];

}