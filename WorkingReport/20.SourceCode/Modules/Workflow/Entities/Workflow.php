<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/19/2019
 * Time: 2:39 PM
 */

namespace Modules\Workflow\Entities;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Workflow extends BaseModel
{
    protected $table = 'working_report';

    public $fillable =
        [
            'user_name',
            'work_date',
            'relate_block',
            'project_id',
            'work_content',
            'work_type',
            'execute_time',
            'progress',
            'late',
            'note'
        ];
}