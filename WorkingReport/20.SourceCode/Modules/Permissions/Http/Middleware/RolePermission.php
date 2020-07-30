<?php

namespace Modules\Permissions\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RolePermission
{
    protected $allow = ['login', 'auth.login', 'logout', '404', 'api/*', 'startViewUser', 'menu'];


    public function handle($request, Closure $next, $guard = null)
    {
        //  return $next($request);
        $route = \Route::getRoutes()->match($request);
        $scope_id = $route->getName();
        $listRoute = $this->getListRouteName();
        if (!in_array($scope_id, $listRoute)) {
            return $next($request);
        }

        $listAdmin = app('isSuperAdmin');
        if (Auth::check() == null) {
            return $next($request);
        }

        if (in_array(Auth::id(), $listAdmin)) {
            return $next($request);
        }

        $scopes = $this->listRoute();
        if (in_array($scope_id, $scopes)) {
            return $next($request);
        } else {
            return redirect('/404');
            //$this->showError($request->method());
            exit;
        }
    }

    protected function showError($method)
    {
        switch ($method) {
            case "GET" :
                {
                    return redirect('/404');
                }
            default:
                {
                    return redirect('/404');
                }
        }
    }

    protected function listRoute()
    {
        $permit = Session::get('permission') ?: [];

        return array_merge($permit, $this->allow);
    }

    protected function getListRouteName()
    {
        $file = "";
        if (file_exists('permission.json')) {
            $file = file_get_contents('permission.json');
        }
        return $file == "" ? [] : json_decode($file, true);
    }
}
