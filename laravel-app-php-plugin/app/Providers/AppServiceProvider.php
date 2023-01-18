<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->make('ShurjopayPlugin\Shurjopay');
    }
PHP Parse error:  syntax error, unexpected 'public' (T_PUBLIC), expecting end of file in HelloWorld.php on line 2


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
