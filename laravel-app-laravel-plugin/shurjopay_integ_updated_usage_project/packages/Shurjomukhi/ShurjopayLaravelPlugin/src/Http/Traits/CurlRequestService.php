<?php
namespace Shurjomukhi\ShurjopayLaravelPlugin\Http\Traits;

    /**
     * This trait provides a method for making curl request
     *
     * @author Rayhan Khan Ridoy
     * @since 2022-12-01
     */

trait CurlRequestService{

    ################################################################################
                   # CurlRequestService Method
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

        }catch(\Exception $e){

                $this->createLog("ShurjoPay has been failed for preparing Curl request !");
                return $e->getMessage();

        }finally{
           $response = curl_exec($curl);

            curl_close($curl);

            $response=json_decode($response);

             return ($response);

        }
    }

}
