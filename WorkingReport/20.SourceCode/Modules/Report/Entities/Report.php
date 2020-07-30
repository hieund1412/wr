<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/9/2019
 * Time: 1:38 PM
 */
namespace Modules\Report\Entities;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Report extends BaseModel {
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'working_report';

    public $fillable = [
        'user_login',
        'work_date',
        'relate_block',
        'project_id',
        'work_content',
        'work_type',
        'execute_time',
        'progress',
        'target',
        'result',
        'late',
        'note'
    ];
}