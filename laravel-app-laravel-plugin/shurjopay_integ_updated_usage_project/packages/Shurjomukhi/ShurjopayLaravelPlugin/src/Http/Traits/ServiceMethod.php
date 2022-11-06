<?php

namespace Shurjomukhi\ShurjopayLaravelPlugin\Http\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Exception;

trait ServiceMethod {



    ################################################################################
                   # Service Method
    ################################################################################


    /**
     * Prepare Curl Request
     *
     * @param  mixed $url
     * @param  mixed $method
     * @param  mixed $payload_data
     * @return mixed $response
     */

    public function prepareCurlRequest($url, $method, $payload_data,$header)
    {
        try{
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_POSTFIELDS => $payload_data,
                CURLOPT_HTTPHEADER => $header
            ));
        }catch(Exception $e){

                $this->createLog("ShurjoPay has been failed for preparing Curl request !");
                return $e->getMessage();

        }finally{
                $response = curl_exec($curl);
                curl_close($curl);

                # here , returning object instead of Json to our core three method
                return(json_decode($response));

        }
    }

    /**
     * Validate a transaction request required data
     *
     * @param  mixed $request
     * @return void
     */

    public function validateInput($request)
    {
        $validate_input = Validator::make($request->all(), [
            'order_id' => "required|string",
            'amount' => "required|numeric",
            'customer_name' => "required|max:200",
            'customer_phone' => "required|regex:/(01)[0-9]{9}/|max:18",
            'customer_address' => "required|max:250",
            'customer_city' => "required|max:15",
            'currency' => "required",
           // 'client_ip' =>"required"
        ]);

        # If validation fails show appropriate errors
        if ($validate_input->fails()) {
            $errors = $validate_input->errors();

            $error_array = array();
            foreach ($errors->all() as $error){
                $e = $error;
                array_push($error_array,$e);
            }

            return array(
                'isValidationPass' => false,
                'message' => "Validation Failed",
                'errors' => array($error_array)
            );
        }

        # When validation passed
        else{
            return array(
                'isValidationPass' => true,
                'message' => "Validation success",
            );
        }

    }

    /**
     * Prepare Transaction Payload
     *
     * @param  mixed $request
     * @return void
     */
    public function prepareTransactionPayload($request)
    {
        $payload_data = array(
            'currency' => $request->currency,
            'amount' => $request->amount,
            'order_id' => $request->order_id,
            'discount_amount' => $request->discount_amount ,
            'disc_percent' => $request->disc_percent ,
            'client_ip' => $request->ip(),
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
            'value1' => $request->value1,
            'value2' => $request->value2,
            'value3' => $request->value3,
            'value4' => $request->value4,
        );

        return $payload_data;
    }

    /**
     * Prepare Logging method for creating runtime 'shurjopay-plugin.log'
     * file in user's side with proper message
     *
     * @param  string $message
     * @return void
     */

     public function createLog( $message )
     {
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/shurjopay-plugin.log'),
            ])->info($message);
     }

}


