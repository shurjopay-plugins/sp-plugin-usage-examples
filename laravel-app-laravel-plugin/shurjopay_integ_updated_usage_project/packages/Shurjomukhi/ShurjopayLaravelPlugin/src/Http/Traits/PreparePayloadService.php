<?php
namespace Shurjomukhi\ShurjopayLaravelPlugin\Http\Traits;

    /**
     * This trait provides a method for preparing transaction payload
     *
     * @author Rayhan Khan Ridoy
     * @since 2022-12-01
     */

trait PreparePayloadService{

    ################################################################################
                   # PreparePayloadService Method
    ################################################################################

    /**
     * Prepare Transaction Payload
     *
     * @param  mixed $request
     * @return void
     */

    public function prepareTransactionPayload($request)
    {
        //dd((array)$request);
        $payload_data = array(
            'currency' => $request->currency,
            'amount' => $request->amount,
            'order_id' => $request->order_id,
            'discount_amount' => $request->discount_amount ,
            'disc_percent' => $request->disc_percent ,
            'client_ip' => $this->getIp(),
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'customer_address' => $request->customer_address,
            'customer_city' => $request->customer_city,
            'customer_state' => $request->customer_state,
            'customer_postcode' => $request->customer_postcode,
            'customer_country' => $request->customer_country,
            'shipping_address' => $request->shipping_address,
            'shipping_city' => $request->shipping_city,
            'shipping_country' => $request->shipping_country,
            'received_person_name' => $request->received_person_name,
            'shipping_phone_number' => $request->shipping_phone_number,

        );

        return $payload_data;
    }
}
