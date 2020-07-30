<?php
/**
 * Created by PhpStorm.
 * User: KyThuat88
 * Date: 6/24/2019
 * Time: 11:38 PM
 */

namespace Modules\ProjectBlocks\Repositories;


use Core\RepositoryInterface;

interface ProjectBlocksInterface extends RepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function update($data);

    public function insert($input);

    public function getToAjax($blockName, $projectName);

    public function getBlockName();

    public function countExistPjB($projectId, $id);
}