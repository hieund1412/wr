<?php
/**
 * Created by PhpStorm.
 * User: KyThuat88
 * Date: 6/23/2019
 * Time: 3:21 PM
 */

namespace Modules\ProjectBlocks\Entities;

use DB;
use Illuminate\Database\Eloquent\Model as BaseModel;
class ProjectBlock extends BaseModel
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'project_block';

    public  $fillable = [

        'block_id',
        'project_id',
        'project_content'

    ];
}