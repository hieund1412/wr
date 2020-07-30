<?php

namespace Modules\Auth\Providers;

use Core\AbstractBaseRepository;
use DB;
use Modules\Users\Repositories\UsersInterface;

class AuthRepository extends AbstractBaseRepository
{

    private $user;
    public function __construct(UsersInterface $users)
    {

    }



}