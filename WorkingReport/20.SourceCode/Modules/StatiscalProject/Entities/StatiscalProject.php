<?php
/**
 * Created by PhpStorm.
 * User: KyThuat88
 * Date: 7/12/2019
 * Time: 1:27 PM
 */

namespace Modules\StatiscalProject\Entities;
use DB;
use Illuminate\Database\Eloquent\Model as BaseStatiscalProject;

class StatiscalProject extends BaseStatiscalProject
{
    protected $table = 'working_report';
}