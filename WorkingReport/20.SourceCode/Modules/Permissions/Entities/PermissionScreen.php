<?php
/**
 * Created by PhpStorm.
 * User: KyThuat88
 * Date: 7/19/2019
 * Time: 5:38 PM
 */

namespace Modules\Permissions\Entities;

use DB;
use Illuminate\Database\Eloquent\Model as BaseModel;

class PermissionScreen extends BaseModel
{
    protected $table = 'permission_screen';
    public $timestamps = false;

    public $fillable = [
        'action_screen',
        'permission_id'
    ];
}