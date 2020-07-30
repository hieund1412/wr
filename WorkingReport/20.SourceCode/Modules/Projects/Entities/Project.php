<?php
/**
 * Created by PhpStorm.
 * User: KyThuat88
 * Date: 6/18/2019
 * Time: 9:23 AM
 */

namespace Modules\Projects\Entities;
use DB;
use Illuminate\Database\Eloquent\Model as BaseProject;

class Project extends BaseProject
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'projects';

    public  $fillable = [

        'corporation_name',
        'project_name',
        'project_note'


    ];
}