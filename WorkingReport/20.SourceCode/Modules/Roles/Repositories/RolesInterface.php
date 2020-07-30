<?php

namespace Modules\Roles\Repositories;

use Core\RepositoryInterface;
use DB;

interface RolesInterface extends RepositoryInterface
{
    public function getRole();

}