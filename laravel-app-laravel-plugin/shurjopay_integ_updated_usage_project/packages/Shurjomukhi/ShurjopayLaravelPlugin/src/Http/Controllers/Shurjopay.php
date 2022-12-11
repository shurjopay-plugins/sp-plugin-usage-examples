<?php

namespace Shurjomukhi\ShurjopayLaravelPlugin\Http\Controllers;

use ArgumentCountError;
use BadMethodCallException;
use InvalidArgumentException;
use App\Http\Controllers\Controller;
use Shurjomukhi\ShurjopayLaravelPlugin\Http\Traits\GetIpService;
use Shurjomukhi\ShurjopayLaravelPlugin\Http\Traits\CreateLogService;
use Shurjomukhi\ShurjopayLaravelPlugin\Http\Traits\ValidationService;
use Shurjomukhi\ShurjopayLaravelPlugin\Http\Traits\CurlRequestService;
use Shurjomukhi\ShurjopayLaravelPlugin\Http\Traits\CheckInternetService;
use Shurjomukhi\ShurjopayLaravelPlugin\Http\Traits\ExceptionInfoService;
use Shurjomukhi\ShurjopayLaravelPlugin\Http\Traits\PreparePayloadService;
use Shurjomukhi\ShurjopayLaravelPlugin\Http\Traits\CheckTokenExpiredService;
use Shurjomukhi\ShurjopayLaravelPlugin\Http\ShurjopayException\ShurjopayException;
use Shurjomukhi\ShurjopayLaravelPlugin\Http\Controllers\TransactionClasses\PaymentRequest;


/**
 * This is 'Shurjopay.php' package controller.
 *
 * This controller has core three public methods named as
 * authenticate(),makePayment() and verifyPayment().
 *           * authenticate() -> makes client authenticate
 *           *  makePayment() -> generates payment url for checkout
 *          * verifyPayment() -> makes payment verified.
 * Inside the controller some traits are used called "ValidationService,PreparePayloadService,GetIpService;
 * CurlRequestService,CreateLogService,ExceptionInfoService,CheckTokenExpiredService & CheckInternetService"
 * prepareCurlRequest(),validateInput(),prepareTransactionPayload(),checkInternetConnection()
 * exceptionInfo(),CheckTokenExpired() & createLog() used from above traits.
 *
 * @author Rayhan Khan Ridoy
 * @since 2022-12-01
 */

class Shurjopay extends Controller
{

    use ValidationService;
    use PreparePayloadService;
    use GetIpService;
    use CurlRequestService;
    use CreateLogService;
    use ExceptionInfoService;
    use CheckInternetService;
    use CheckTokenExpiredService;

    /**
     * Create the merchant authorized
     *
     * @return  mixed $response
     */


    public function authenticate()
    {
        # Checking Internet Connection
        if ($this->checkInternetConnection()) {
            # This is curl header which is an array type
            $curl_header = array('Content-Type: application/json');

            # This is payload array which contains username and password
            $payload = array(
                'username' => config('Shurjopay.merchant_username'),
                'password' => config('Shurjopay.merchant_password')
            );


            try {
                # Making curl request to "/api/get_token"
                $response = $this->prepareCurlRequest(config('Shurjopay.auth_token_url'), 'POST', json_encode($payload), $curl_header);

                # Taking logging record after successfull merchant authentication
                $this->createLog("ShurjoPay has been authenticated successfully !");

                # Got object as response from prepareCurlRequest in $response variable
                # and returning that object from here
                return $response;
                //return response(['response'=>$response],200);
            }
            # Catching ShurjopayException custom exception and throwing it to ShurjopayException
            catch (ShurjopayException $e) {

                // dd($e);
                //  dd(get_class($e));
                // $this->createLog("Invalid User name or Password due to shurjoPay authentication.");
                //return $e->getMessage();
                throw new ShurjopayException("--------------", 0, $e);
            }
            # Catching BadMethodCallException custom exception and throwing it to ShurjopayException
            catch (BadMethodCallException $e) {
                //  dd(get_class($e));
                $this->createLog("BadMethodCallException occured !");
                throw new ShurjopayException("----------", 0, $e);
            }
            # Catching ArgumentCountError custom exception and throwing it to ShurjopayException
            catch (ArgumentCountError $e) {
                $this->createLog("ArgumentCountError occured !");
                throw new ShurjopayException("----------", 0, $e);
            }
            # Catching InvalidArgumentException custom exception and throwing it to ShurjopayException
            catch (InvalidArgumentException $e) {
                $this->createLog("InvalidArgumentException occured !");
                throw new ShurjopayException("----------", 0, $e);
            }
            // catch (\Exception $e) {

            //     //  dd($e);
            //     //  dd(get_class($e));
            //     $this->createLog("InvalidArgumentException occured !");
            //     throw new ShurjopayException("Please make your method name correct,first",0,$e);
            // }catch (\Error $e) {

            //     // dd($e);
            //     //  dd(get_class($e));
            //     $this->createLog("InvalidArgumentException occured !");
            //     throw new ShurjopayException("Please make your method name correct,first",0,$e);
            // }
        }
        # When there is no internet connection
        else
        {
            return "Your internet connection is failed ! Please check your internet connection,firstly.";
        }
    }

    /**
     * Make Payment request to shurjoPay
     *
     * @param  PaymentRequest $request
     * @return void
     */

    //public function makePayment(Request $request){
    public function makePayment(PaymentRequest $request)
    {
        try {
            # Checking internet connection
            if ($this->checkInternetConnection()) {

                # Validating the $request object
                $validation_status = $this->validateInput($request);

                # When validation success and "isValidationPass=true"
                if ($validation_status["isValidationPass"])
                {
                    # This is also a curl header
                    $curl_header = array('Content-Type: application/json');
                    # By using prepareTransactionPayload() , payload will be created and stored in $trxn_data
                    $trxn_data =  $this->prepareTransactionPayload($request);
                    # By calling authenticate() method ,total response from "api/get_token" is stored in $authentication_data
                    $authentication_data = $this->authenticate();  //object

                    /**
                       * sleep was used for making paused http request for 40 seconds to next php line
                       * and our CheckTokenExpired() will be checked "token create_time+30 sec".
                       * That's why token will be expired and program will be terminated
                       * main purpose of using sleep() for debuging
                    */
                    //sleep(40);

                    // Checking Token is expired or not
                    $IsTokenExpired_Valid = $this->CheckTokenExpired($authentication_data->token_create_time);

                    // If true "$IsTokenExpired_Valid"
                    if ($IsTokenExpired_Valid)
                    {
                        // Checking sp_code
                        if (!empty($authentication_data->sp_code) && ($authentication_data->sp_code) == '200')
                        {
                            // Creating an array about merchant information
                            $merchant_info = array(
                                'token' => $authentication_data->token,
                                'store_id' => $authentication_data->store_id,
                                'prefix' => config('Shurjopay.merchant_prefix'),
                                'return_url' => config('Shurjopay.merchant_return_url'),
                                'cancel_url' => config('Shurjopay.merchant_cancel_url'),
                            );
                            // Making curl request to "/api/secret-pay"
                            $response = $this->prepareCurlRequest(config('Shurjopay.secret_pay_url'), 'POST', json_encode(array_merge($merchant_info, $trxn_data)), $curl_header);

                            /**
                            * Checking "checkout_url" from $response.
                            * If "checkout_url" exits then redirection to that url and take a logging record of that.
                            * If doesn't exit then also return a different response also
                            */
                            if (!empty($response->checkout_url))
                            {
                                $this->createLog("Payment URL has been generated by shurjoPay!");
                                return redirect($response->checkout_url);
                            }
                            else
                            {
                                return $response;  //object
                            }
                        }

                        # When wrong credentials or empty credentials
                        else
                        {
                            $this->createLog("Payment request failed");
                            return $authentication_data;  //object
                        }
                    }
                    # When token will be expired
                    else
                    {
                        $this->createLog("ShurjoPay token is expired!");
                        exit("ShurjoPay token is expired !");
                    }
                }
                # When validation will be failed
                else
                {
                    return $validation_status;
                }
            }
            # When there is no internet connection!
            else
            {
                return "Your internet connection is failed ! Please check your internet connection,firstly.";
            }
        }
        # When any exception will occur then next block of code will be executed
        catch (\Exception $e)
        {
            $this->createLog("Exception occured into makePayment() !");
            throw new ShurjopayException("-------", 0, $e);
        }
    }

    /**
     *  Verify the payment request
     *
     * @param string $order_id
     * @return mixed $response
     */

    public function verifyPayment($order_id)
    {
        # Checking internet Connection
        if ($this->checkInternetConnection()) {

            # By calling authenticate() method ,total response from "api/get_token" is stored in $authentication_data
            $authentication_data = $this->authenticate();   //object

            # Checking sp_code
            if (!empty($authentication_data->sp_code) && ($authentication_data->sp_code) == '200')
            {
                /**
                 * In try block there is an array typed $curl_header which has some data field
                 * In $response , a curl request is held for payment verification by calling "api/verification" by prepareCurlRequest()
                 * Also taking logging records and returning response
                 */

                try {
                    $curl_header = array('Authorization:Bearer ' . $authentication_data->token, 'Content-Type: application/json');
                    $response = $this->prepareCurlRequest(config('Shurjopay.verification_url'), 'POST', json_encode(array('order_id' => $order_id)), $curl_header);
                    $this->createLog("Payment verification is done successfully!");

                    return $response;       //object
                }
                # If any exception occur in try block then that will be caught here and thrown to ShurjopayException
                catch (\Exception $e) {
                    $this->createLog("Exception occured into makePayment() !");
                    throw new ShurjopayException("-----", 0, $e);
                }
            }
            # Taking logging record and returning regarding response if there is no sp_code
            else
            {
                $this->createLog("Payment verification is failed!");
                return $authentication_data;   //object
            }
        }
        # If there is no internet connection
        else
        {
            return "Your internet connection is failed ! Please check your internet connection,firstly.";
        }
    }
}
