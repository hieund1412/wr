<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/17/2019
 * Time: 1:44 PM
 */
namespace Modules\Blocks\Repositories;
use Core\RepositoryInterface;

interface BlockInterface extends RepositoryInterface {
    public function getAllBlockData();

    public function getDataByBlockId($id);

    public function insertBlockData($input);

    public function deleteOneById($id);

    public function updateBlockData($data);

    public function getBlock();

    public function countExistBlock($blockName, $id);

    public function countExistEmail($email, $id);
}