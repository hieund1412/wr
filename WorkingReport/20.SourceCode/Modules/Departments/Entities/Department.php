<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/23/2019
 * Time: 5:31 PM
 */
namespace Modules\Departments\Entities;
use Illuminate\Database\Eloquent\Model as BaseModel;

/**
 * Class Department
 * @author HieuND
 * @access public
 * @package Modules\Departments\Entities
 */
class Department extends  BaseModel {
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'departments';
    public  $fillable = [
        'block_id',
        'department_name',
        'department_note'
    ];
}