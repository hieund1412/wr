<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/17/2019
 * Time: 1:32 PM
 */
namespace Modules\Blocks\Entities;
use Illuminate\Database\Eloquent\Model as BaseModel;

/**
 * Class Block
 * @author HieuND
 * @access public
 * @package Modules\Blocks\Entities
 */
class Block extends BaseModel {
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'blocks';
    public $fillable = [
        'block_name',
        'block_note',
        'block_email'
    ];
}