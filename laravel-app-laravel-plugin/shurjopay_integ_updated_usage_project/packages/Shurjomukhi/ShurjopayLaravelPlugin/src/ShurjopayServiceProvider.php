<?php

namespace Shurjomukhi\ShurjopayLaravelPlugin;

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
        $this->app->make('Shurjomukhi\ShurjopayLaravelPlugin\Http\Controllers\Shurjopay');
        $this->mergeConfigFrom(__DIR__.'/../config/shurjopay.php', 'Shurjopay');  //'Shurjopay' is a key for accessing value as config('Shurjopay.merchant_return_url') in controller
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        #for http routing
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        # for exporting config file
        if ($this->app->runningInConsole())
        {
            $this->publishes(
            [
                # Publishing package config/shurjopay.php to application config/Shurjopay.php

              __DIR__.'/../config/shurjopay.php' => config_path('Shurjopay.php'),
            ], 'shurjopay');
        }
    }

}
