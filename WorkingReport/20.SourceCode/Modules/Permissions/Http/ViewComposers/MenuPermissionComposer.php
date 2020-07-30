<?php
/**
 * Created by PhpStorm.
 * User: anhpt
 * Date: 8/30/2018
 * Time: 11:02 AM
 */

namespace Modules\Permissions\Http\ViewComposers;

use App\Auth\Models\User;
use App\Models\Campaigns;
use App\Repositories\Services\ServicesRepositoryInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class MenuPermissionComposer
{
    public function __construct()
    {
    }

    public function compose(View $view)
    {
        $permissions = [];
        $listAdmin = app('isSuperAdmin');
        $user_id = \Auth::id();

        if (in_array($user_id, $listAdmin)) {
            $permissions = ["*"];

        } else {
            if (Session::exists('permission')) {
                $permissions = Session::get('permission');
            }
        }
        $view->with('permissions', $permissions);
    }
}