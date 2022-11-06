<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Shurjomukhi\ShurjopayLaravelPlugin\Http\Controllers\Shurjopay;

class HTTPTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_authenticate_method()
    {
        $response=$this->get("/test");
       // $this->assertTrue($response);
        $response->assertStatus(200);
    }

    public function test_makePayment_method()
    {
        $shurjopay_service= new Shurjopay();
        $authentication_data=$shurjopay_service->authenticate();
        $authentication_token=$authentication_data->token;
        $authentication_store_id=$authentication_data->store_id;

        $response=$this->post("/test2",
        [
        "token" => $authentication_token,
        "store_id" => $authentication_store_id,
        "prefix" => config('Shurjopay.merchant_prefix'),
        "return_url" => config('Shurjopay.merchant_return_url'),
        "cancel_url"  => config('Shurjopay.merchant_cancel_url'),
        "currency" => "BDT",
        "amount" => "20000000",
        "order_id" => "FFFFFFF",
        "discount_amount" => 10,
        "disc_percent" => "10",
        "client_ip" => "127.0.0.1",
        "customer_name" => "RAYHAN KHAN RIDOY",
        "customer_phone" => "01951207051",
        "customer_email" => "kredoy416@gmail.com",
        "customer_address" => "DHAKA",
        "customer_city" => "DHAKA",
        "customer_state" => "DHAKA",
        "customer_postcode" => "1229",
        "customer_country" => "BANGLADESH",
        "shipping_address" => "LONDON",
        "shipping_city" => "LONDON",
        "shipping_country" => "USA",
        "received_person_name" => "RAHIM",
        "shipping_phone_number" => "01912121212",
        "value1" => null,
        "value2" => null,
        "value3" => null,
        "value4" => null
        ],
        [
            'Content-Type: application/json'
        ]);

       // $this->assertTrue($response);
        $response->assertStatus(302);
    }

    // public function test_verifyPayment_method()
    // {
    //     $order_id="NOK1232123212";
    //     $shurjopay_service = new Shurjopay();
    //     $response=json_encode($shurjopay_service->verifyPayment($order_id));
    //     $response=json_decode($response);


    // //    $authentication_data=$shurjopay_service->authenticate();

    // //     $response=$this->post("/test3",
    // //     [
    // //         "sp_order_id" => "NOK636260da00d1f",
    // //     ],
    // //     [
    // //         'Authorization:Bearer '.$authentication_data->token,'Content-Type: application/json',
    // //     ]
    // // );
    //  //     $this->assertTrue($response);
    //       $response->assertStatus(200);
    // }
}
