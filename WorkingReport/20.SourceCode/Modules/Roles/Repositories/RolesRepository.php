<?php

namespace Modules\Roles\Repositories;

use Core\AbstractBaseRepository;
use DB;
use Modules\Roles\Entities\Role;

class RolesRepository extends AbstractBaseRepository implements RolesInterface
{

    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    public function getRole() {
        $aryData = Role::all();
        return $aryData;
    }



}