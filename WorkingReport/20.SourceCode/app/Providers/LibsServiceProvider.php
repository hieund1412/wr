<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Route;
class LibsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Route $route)
    {
        //


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind( \Core\AnnotationsInterface::class,\Core\Annotations::class);
        //
    }
}
