<?php

namespace App\Http\Controllers;

use Shurjomukhi\ShurjopayLaravelPlugin\Http\Controllers\Shurjopay;
use Shurjomukhi\ShurjopayLaravelPlugin\Http\Controllers\TransactionClasses\PaymentRequest;

use Illuminate\Http\Request;

class shurjopayIntigretionController extends Controller
{
    public function initialPayment(Request $request){

            $requestArray = array($request->all());
            $request = new PaymentRequest($requestArray);
            $shurjopay_service = new Shurjopay();
            return $shurjopay_service->makePayment($request);
    }

    public function verifyPayment(Request $request){
        $order_id=$request->order_id;
        $shurjopay_service = new Shurjopay();

        return $shurjopay_service->verifyPayment($order_id);
    }
}
