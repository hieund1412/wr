<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/26/2019
 * Time: 11:56 PM
 */

namespace Modules\Roles\Entities;

use DB;
use Illuminate\Database\Eloquent\Model as BaseModel;
class Role extends BaseModel
{
    protected $table = 'roles';

    public $fillable = [
      'role_name'
    ];
}