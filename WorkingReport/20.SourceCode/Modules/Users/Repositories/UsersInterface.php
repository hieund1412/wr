<?php

namespace Modules\Users\Repositories;

use Core\RepositoryInterface;

interface UsersInterface extends RepositoryInterface
{
    public function getAll();

    public function insert($input);

    public function insertNewUser($input);

    public function getById($id);

    public function update($data);

    public function deleteOneById($id);

    public function searchBy($idUser, $block, $department);

    public function getUser();

    public function checkExistEmail($email, $id);

    public function checkExistUser($userLogin, $id);
}