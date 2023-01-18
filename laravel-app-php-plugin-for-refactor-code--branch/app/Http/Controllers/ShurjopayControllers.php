<?php

namespace App\Http\Controllers;

use ShurjopayPlugin\Shurjopay;
use ShurjopayPlugin\ShurjopayConfig;
use ShurjopayPlugin\ShurjopayEnvReader;
use ShurjopayPlugin\PaymentRequest;
use Illuminate\Http\Request;

class ShurjopayControllers extends Controller
{
    public $conf;
    public function make_payment_request(){

        $request = new PaymentRequest();

        $request->currency = 'BDT';
        $request->amount = 100;
        $request->discountAmount = '0';
        $request->discPercent = '0';
        $request->customerName = 'MD Wali Mosnad Ayshik';
        $request->customerPhone = '01775503498';
        $request->customerEmail = 'test@gmail.com';
        $request->customerAddress = 'Dhaka';
        $request->customerCity = 'Dhaka';
        $request->customerState = 'Dhaka';
        $request->customerPostcode = '1207';
        $request->customerCountry = 'Bangladesh';
        $request->shippingAddress = 'Sirajganj';
        $request->shippingCity = 'Dhaka';
        $request->shippingCountry = 'Bangladesh';
        $request->receivedPersonName = 'Ayshik';
        $request->shippingPhoneNumber = '01775503498';
        $request->value1 = 'value1';
        $request->value2 = 'value2';
        $request->value3 = 'value3';
        $request->value4 = 'value4';

        $sp_instance = new Shurjopay($this->getShurjopayConfig());
        $sp_instance->makePayment($request);
    }

    private function getShurjopayConfig() {
        $obj = new ShurjopayConfig();
        $obj->username = env('SP_USERNAME');
        $obj->password = env('SP_PASSWORD');
        $obj->order_prefix = env('SP_PREFIX');
        $obj->api_endpoint = env('SHURJOPAY_API');
        $obj->callback_url = env('SP_CALLBACK');
        $obj->log_path = env('SP_LOG_LOCATION', '/tmp/');
        $obj->ssl_verifypeer = env('CURLOPT_SSL_VERIFYPEER', 1);
        return $obj;
    }

    public function verify_payment(Request $request){
        $sp_order_id= $request->order_id;
        $sp_instance = new Shurjopay($this->conf);
        return $sp_instance->verifyPayment($sp_order_id);
    }
}
