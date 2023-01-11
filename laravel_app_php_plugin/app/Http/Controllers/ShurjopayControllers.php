<?php

namespace App\Http\Controllers;

use ShurjopayPlugin\Shurjopay;
use ShurjopayPlugin\PaymentRequest;
use Illuminate\Http\Request;

class ShurjopayControllers extends Controller
{
    public function make_payment_request(){

        $sp_instance = new Shurjopay();
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

        $sp_instance->makePayment($request);

    }

    public function verify_payment(Request $request){
        $sp_order_id= $request->order_id;
        $sp_instance = new Shurjopay();
        return $sp_instance->verifyPayment($sp_order_id);
    }
}
