<?php

namespace Modules\Projects\Repositories;


use Core\RepositoryInterface;

interface ProjectInterface extends RepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function insert($input);

    public function deleteOneById($id);

    public function update($data );

    public function getProject();

    public function getToAjax($corporationName, $projectName);

    public function getCprName();

    public function countExistProject($projectName, $id);
}