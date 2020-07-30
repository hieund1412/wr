<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/24/2019
 * Time: 4:59 PM
 */

namespace Modules\Users\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'users';

    public $fillable =
        [
            'user_login',
            'fullname',
            'department_id',
            'email',
            'block_id',
            'role_id',
            'permission',
            'remember_token'
        ];
}