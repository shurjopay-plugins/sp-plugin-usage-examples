<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use ShurjopayPlugin\Shurjopay;
use ShurjopayPlugin\ShurjopayConfig;

class ShurjopayProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(Shurjopay::class, function ($app) {
            return new Shurjopay($this->getShurjopayConfig());
        });
    }

    private function getShurjopayConfig(): ShurjopayConfig
    {
        $conf = new ShurjopayConfig();
        $conf->username = env('SP_USERNAME');
        $conf->password = env('SP_PASSWORD');
        $conf->api_endpoint = env('SHURJOPAY_API');
        $conf->callback_url = env('SP_CALLBACK');
        $conf->log_path = env('SP_LOG_LOCATION');
        $conf->order_prefix = env('SP_PREFIX');
        $conf->ssl_verifypeer = env('CURLOPT_SSL_VERIFYPEER');
        return $conf;
    }

}