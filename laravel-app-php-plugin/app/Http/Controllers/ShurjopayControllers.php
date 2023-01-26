<?php

namespace App\Http\Controllers;

use ShurjopayPlugin\Shurjopay;
use ShurjopayPlugin\PaymentRequest;
use Illuminate\Http\Request;

class ShurjopayControllers extends Controller
{
   public $sp;
   public function __construct(Shurjopay $sp)
   {
       $this->sp = $sp;
   }
   public function make_payment_request(){

       $request = new PaymentRequest();

       $request->currency = 'BDT';
       $request->amount = 1000000000;
       $request->discountAmount = '0';
       $request->discPercent = '0';
       $request->customerName = 'Mr. Piter';
       $request->customerPhone = '0555503498';
       $request->customerEmail = 'test@gmail.com';
       $request->customerAddress = 'Dhaka';
       $request->customerCity = 'Dhaka';
       $request->customerState = 'Dhaka';
       $request->customerPostcode = '1207';
       $request->customerCountry = 'Bangladesh';
       $request->shippingAddress = 'Sirajganj';
       $request->shippingCity = 'Dhaka';
       $request->shippingCountry = 'Bangladesh';
       $request->receivedPersonName = 'Cris Gayle';
       $request->shippingPhoneNumber = '07895503498';
       $request->value1 = 'value1';
       $request->value2 = 'value2';
       $request->value3 = 'value3';
       $request->value4 = 'value4';

       return $this->sp->makePayment($request);
   }
    public function verify_payment(Request $sp_order_id){
        return $this->sp->verifyPayment($sp_order_id);
    }
}
