<?php
/**
 * Created by PhpStorm.
 * User: KyThuat88
 * Date: 6/26/2019
 * Time: 9:21 AM
 */

namespace Modules\Jobs\Entities;


use DB;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Jobs extends BaseModel
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'jobs';

    public  $fillable = [

        'job_type',
        'block_id',
        'job_note'

    ];
}