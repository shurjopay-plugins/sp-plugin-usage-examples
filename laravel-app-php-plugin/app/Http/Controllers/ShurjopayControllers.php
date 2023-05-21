<?php

namespace App\Http\Controllers;

use ShurjopayPlugin\Shurjopay;
use ShurjopayPlugin\PaymentRequest;
use Illuminate\Http\Request;

class ShurjopayControllers extends Controller
{
   public $sp_instance;
    /* Shurjopay injected in a constructor */
    public function __construct(Shurjopay $sp)
    {
        $this->sp_instance = $sp;
    }
   public function send_payment_request_to_shurjopay(){

       $payment_request = new PaymentRequest();

       $payment_request->currency = 'BDT';
       $payment_request->amount = 1000000000;
       $payment_request->discountAmount = '0';
       $payment_request->discPercent = '0';
       $payment_request->customerName = 'Mr. Piter';
       $payment_request->customerPhone = '01722222222';
       $payment_request->customerEmail = 'test@gmail.com';
       $payment_request->customerAddress = 'Dhaka';
       $payment_request->customerCity = 'Dhaka';
       $payment_request->customerState = 'Dhaka';
       $payment_request->customerPostcode = '1207';
       $payment_request->customerCountry = 'Bangladesh';
       $payment_request->shippingAddress = 'Sirajganj';
       $payment_request->shippingCity = 'Dhaka';
       $payment_request->shippingCountry = 'Bangladesh';
       $payment_request->receivedPersonName = 'Cris Gayle';
       $payment_request->shippingPhoneNumber = '01722222222';
       $payment_request->value1 = 'value1';
       $payment_request->value2 = 'value2';
       $payment_request->value3 = 'value3';
       $payment_request->value4 = 'value4';

       return $this->sp_instance->makePayment($payment_request);
   }
    public function verify_payment(Request $request){
        $order_id = $request->order_id;
        $response=$this->sp_instance->verifyPayment($order_id);
        print_r($response);exit;
    }
}
