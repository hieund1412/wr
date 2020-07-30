<?php

namespace Modules\Permissions\Providers;

use Core\Annotations;
use Core\AnnotationsInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\Permissions\Repositories\PermissionsInterface;
use Modules\Permissions\Repositories\PermissionsRepository;

class PermissionsServiceProvider extends ServiceProvider
{
    protected $listAdmin = [39];
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->registerComposer();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->bind(PermissionsInterface::class,PermissionsRepository::class);
        $this->app->bind(AnnotationsInterface::class,Annotations::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('permissions.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'permissions'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/permissions');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/permissions';
        }, \Config::get('view.paths')), [$sourcePath]), 'permissions');

        \Blade::if ('role', function ($permit) {

            return $this->checkRole($permit);
        });
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/permissions');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'permissions');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'permissions');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
        $this->app->singleton("isSuperAdmin", function () {
            return $this->listAdmin;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    public function registerComposer()
    {
        View::composer(
            '*', '\Modules\Permissions\Http\ViewComposers\MenuPermissionComposer'
        );
    }

    protected function getUser()
    {
        return Auth::id();
    }

    public function checkRole($permit)
    {
        $permissions = [];
        if (Session::exists('permission')) {
            $permissions = Session::get('permission');
        }
        // kiểm tra nếu là super admin thì auto pass
        if ($this->isSuperAdmin(Auth::id())) {
            return true;
        }
        return in_array($permit, $permissions);
    }

    protected function isSuperAdmin($user_id)
    {
        return in_array($user_id, $this->listAdmin);
    }
}
