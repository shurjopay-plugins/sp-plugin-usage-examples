<?php

namespace Shurjomukhi\ShurjopayLaravelPlugin;

use Illuminate\Support\ServiceProvider;

/**
 * This is Shurjopay Service-Provider.It has two core methods named as register() & boot()
 * like other general service-provider.
 *
 * Inside register() method:-
 *      * Shurjopay controller is registered.
 *      * Merged package's custom config with applicatin config's directory.
 * Inside boot() method:-
 *      * Package's custom configuration is published.
 *
 * @author Rayhan Khan Ridoy
 * @since 2022-12-01
*/

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
        $this->mergeConfigFrom(__DIR__.'/../config/shurjopayConfig.php', 'Shurjopay');  //'Shurjopay' is a key for accessing value as config('Shurjopay.merchant_return_url') in controller
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

              __DIR__.'/../config/shurjopayConfig.php' => config_path('ShurjopayConfig.php'),
            ],'shurjopay');
        }
    }

}
