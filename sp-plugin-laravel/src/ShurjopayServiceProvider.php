<?php

namespace Shurjopayv3\SpPluginLaravel;

use Illuminate\Support\ServiceProvider;

class ShurjopayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/views','shurjopay');
        $this->app->make('Shurjopayv3\SpPluginLaravel\Http\Controllers\ShurjopayController');

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
    }
}
