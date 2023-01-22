
 <!-- 
 * This is an official documentation of integrating "shurjoPay" in laravel.
 *
 * By following steps of this documentation, any user can be able to integrate "shurjoPay" pacakge easily. 
 * In this documentation , a sample integration process is also available.
 *
 * @author Rayhan Khan Ridoy
 * @since 2022-12-01 
 -->
 

# ![image](https://user-images.githubusercontent.com/57352037/170198396-932692aa-3354-4cf0-abc1-2b8ef43a6de3.png) Include ``sp-plugin-php`` into laravel application
[![Test Status](https://github.com/rust-random/rand/workflows/Tests/badge.svg?event=push)]()
[![Stable](https://img.shields.io/badge/Stable-v2.1.0-green)]()
[![License](https://img.shields.io/badge/License-MIT-blue)]()
[![Rating](https://img.shields.io/badge/Rating-*****-green)]()
[![Depandency](https://img.shields.io/badge/Depandency-No-blue)]()

Official documentation for shurjoPay plugin developers to connect with [**_shurjoPay_**](https://shurjopay.com.bd) Payment Gateway ``` v2.1.0 ``` developed and maintained by [_**ShurjoMukhi Limited**_](https://shurjomukhi.com.bd). This documentation can be used to integrate sp-plugin-php into laravel application.

## Audience

This document is intended for the developers and technical personnel who want to integrate the shurjoPay online payment gateway by sp-plugin-php in laravel application.

# How to use sp-plugin-php package in laravel ?
To integrate the shurjoPay Payment Gateway using ``sp-plugin-php``, kindly do the following tasks sequentially.

#### Step-1: Install the package inside your project environment.
Run below commands ,
```
"shurjomukhi/shurjopay-plugin-php":"^0.1.0"
``` 
Or , Open your project's ``composer.json`` file . Then copy below line and put it into the body of ``require`` block.
```
"shurjomukhi/shurjopay-plugin-php":"dev-dev"
``` 
Next , copy below block of codes and put into "composer.json" 
```
"repositories": [
                   {
                     "type": "vcs",
                     "url": "https://github.com/shurjopay-plugins/sp-plugin-laravel.git"
                   }
                ]
```
Then , please copy below command line and run on your project's terminal. By running this command , our ``shurjoPay`` package will be loaded into your project. 

```
composer update
```
#### Step-2: Integrating controller setup :-
Use below namespaces in your controller .

```
use ShurjopayPlugin\Shurjopay;
use ShurjopayPlugin\ShurjopayConfig;
use ShurjopayPlugin\PaymentRequest;
```
Now , inside your payment-request making method , please make two instances of ``Shurjopay`` & ``PaymentRequest`` classes.

```
public function make_payment_request()
{
        /* Declearing public variable */
        public $conf;
        
        /* Creating instance and initialize all fields of "PaymentRequest" class. */
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
        
        /* Passing ShurjopayConfig to Shurjopay Constructor*/
        $sp_instance = new Shurjopay($this->getShurjopayConfig());
        
        /* Passing object of PaymentRequest to makePayment() method */
        $sp_instance->makePayment($request);

        /* initializing object of ShurjopayConfig from .env file */
        private function getShurjopayConfig() 
        {
           $obj = new ShurjopayConfig();
           $obj->username = env('SP_USERNAME');
           $obj->password = env('SP_PASSWORD');
           $obj->order_prefix = env('SP_PREFIX');
           $obj->api_endpoint = env('SHURJOPAY_API');
           $obj->callback_url = env('SP_CALLBACK');
           $obj->log_path = env('SP_LOG_LOCATION');
           $obj->ssl_verifypeer = env('CURLOPT_SSL_VERIFYPEER', 1);
           return $obj;
        }

        /* Payment verification can be done after each transaction with shurjopay_order_id */
        public function verify_payment(Request $request)
        {
           $sp_order_id= $request->order_id;
           $sp_instance = new Shurjopay($this->conf);

           /*
            Call the "verifyPayment()" method with the instance of "Shurjopay" class and pass 
            the "shurjopay_order_id" as perameter.
           */
           return $sp_instance->verifyPayment($sp_order_id);
        }
```
#### Step-4: Ready to run.
Now application is ready to work. Just give another command in terminal

```
php artisan serve
```
<!--
# Advance Customization Set-up 
### Where will I set merchant credentials ?
Now , your laravel application is running with ``sp-plugin-php`` and this plugin always taking some merchant credentials to run. These credentials are defined in ``ShurjopayConfig.php`` file and path-directory of this file is ``vendor/shurjomukhi/shurjopay-plugin-php/src/ShurjopayConfig.php`` . If you want to define your merchant-credentials then you will need to change that file's credentials. 

### Can I set merchant credentials with ``.env`` file ?
Yes ! , you can. For doing this thing , you need to setup below configuration into your ``.env`` file.
```
SP_USERNAME="sp_sandbox"
SP_PASSWORD="pyyk97hu&6u6"
SP_PREFIX="NOK"
SP_CALLBACK="https://sandbox.shurjopayment.com/response"
SHURJOPAY_API="https://sandbox.shurjopayment.com/"
```
After that , you need to access avobe values into ``Shurjopay.php`` file from ``.env`` and path-directory is ``vendor/shurjomukhi/shurjopay-plugin-php/src/Shurjopay.php``. Now, open this file to make some changes .
#### Firstly , copy below lines of constructor [``__construct()``] and replace the code of constructor into ``Shurjopay.php`` .

```
public function __construct()
    {
        $this->authentication_url = env(SHURJOPAY_API) . "api/get_token";
        $this->checkout_url = env(SHURJOPAY_API) . "api/secret-pay";
        $this->verification_url = env(SHURJOPAY_API) . "api/verification";
    }
```
#### Secondly , copy below lines of ``authenticate()`` method and replace the code of this method
into ``Shurjopay.php`` .

```
public function authenticate()
    {
        if ( empty(env(SP_USERNAME)) || empty(env(SP_PASSWORD)) ) {
             $this->sp_log("Authentication process can not continue as username or password is empty");
             exit("Authentication process can not continue as username or password is empty");
        }

        $postFields = array('username' => env(SP_USERNAME), 'password' => env(SP_PASSWORD));

        $response = $this->getHttpResponse($this->authentication_url, 'POST', $postFields, array(''));
        if (!$response) {
            $this->sp_log("Authentication failed");
            return null;
        }
        $response = json_decode(json_encode($response), true);
        $this->sp_log("Token generated Successfully");
        $this->SP_TOKEN = $response['token'];
        $this->SP_STORE = $response['store_id'];
        return $this->SP_TOKEN;
    }
```
#### Finally, copy below lines of ``prepareTransactionPayload($payload)`` method and replace the code of 
this method into ``Shurjopay.php`` and save the file. After doing this final step, you are done to run your application with ``.env`` credentials.
```
public function prepareTransactionPayload($payload)
{

return json_encode(
    array(
        # store information
        'token' => $this->SP_TOKEN,
        'store_id' => $this->SP_STORE,
        'prefix' => env(SP_PREFIX),
        'currency' => $payload->currency,
        'return_url' => env(SP_CALLBACK),
        'cancel_url' => env(SP_CALLBACK),
        'amount' => $payload->amount,
        # Order information
        'order_id' => env(SP_PREFIX).uniqid(),
        'discsount_amount' => $payload->discountAmount,
        'disc_percent' => $payload->discPercent,
        # Customer information
        'client_ip' => $_SERVER['REMOTE_ADDR'] ?: ($_SERVER['HTTP_X_FORWARDED_FOR'] ?: $_SERVER['HTTP_CLIENT_IP']),
        'customer_name' => $payload->customerName,
        'customer_phone' => $payload->customerPhone,
        'customer_email' => $payload->customerEmail,
        'customer_address' => $payload->customerAddress,
        'customer_city' => $payload->customerCity,
        'customer_state' => $payload->customerState,
        'customer_postcode' => $payload->customerPostcode,
        'customer_country' => $payload->customerCountry,
        'shipping_address' => $payload->shippingAddress,
        'shipping_city' => $payload->shippingCity,
        'shipping_country' => $payload->shippingCountry,
        'received_person_name' => $payload->receivedPersonName,
        'shipping_phone_number' => $payload->shippingPhoneNumber,
        'value1' => $payload->value1,
        'value2' => $payload->value2,
        'value3' => $payload->value3,
        'value4' => $payload->value4
        )
        );
    }
```
### Can I set merchant-credentials of ``.env`` as pacakage-configuration file ?
Yes ! you can. For implementing this kind of thing , kindly follow bellow things.
#### Firstly , create a ``config`` folder under ``vendor/shurjomukhi/shurjopay-plugin-php/src/`` this directory and create a ``shurjopayConfig.php`` file under ``vendor/shurjomukhi/shurjopay-plugin-php/src/config`` folder. Then copy below line of codes and paste these into newly created ``shurjopayConfig.php`` file.
```
<?php

return [
  'SP_USERNAME' => env('SP_USERNAME'),
  'SP_PASSWORD' => env('SP_PASSWORD'),
  'SP_PREFIX' => env('SP_PREFIX'),
  'SP_CALLBACK' => env('SP_CALLBACK'),
  'SHURJOPAY_API' => env(SHURJOPAY_API)',
];
```
#### Secondly , in ``register()`` method of your ``ShurjopayServiceProvider`` put below line kindly.
```
        /*'ShurjopayConfig' is a key for accessing value as config('ShurjopayConfig.SP_USERNAME') in controller */
        $this->mergeConfigFrom(__DIR__.'/../config/shurjopayConfig.php', 'ShurjopayConfig');  
```
#### Thirdly , in ``boot()`` method of your ``ShurjopayServiceProvider`` put below line kindly.
```
  # for exporting config file
        if ($this->app->runningInConsole())
        {
            $this->publishes(
            [
                # Publishing package "src/config/shurjopayConfig.php" to application "config/shurjopayConfig.php"

              __DIR__.'/../config/shurjopayConfig.php' => config_path('shurjopayConfig.php'),
            ],'shurjopayConfig');
        }
```
####  Next , please publish your package congfiguration by running below command. Which will give you ``shurjopayConfig.php`` file under application's ``config`` folder.

```
php artisan vendor:publish --tag=shurjopayConfig
composer dump-autoload
```
#### Then , copy below lines of constructor [``__construct()``] and replace the code of constructor into ``Shurjopay.php`` .

```
public function __construct()
    {
        $this->authentication_url = config('ShurjopayConfig.SHURJOPAY_API')."api/get_token";
        $this->checkout_url = config('ShurjopayConfig.SHURJOPAY_API'). "api/secret-pay";
        $this->verification_url = config('ShurjopayConfig.SHURJOPAY_API'). "api/verification";
    }
```
#### After that , copy below lines of ``authenticate()`` method and replace the code of this method
into ``Shurjopay.php`` .

```
public function authenticate()
{
    if ( config('ShurjopayConfig.SP_USERNAME')) || config('ShurjopayConfig.SP_PASSWORD)) ) {
            $this->sp_log("Authentication process can not continue as username or password is empty");
            exit("Authentication process can not continue as username or password is empty");
    }

    $postFields = array('username' => config('ShurjopayConfig.SP_USERNAME'), 'password' => config('ShurjopayConfig.SP_PASSWORD));

    $response = $this->getHttpResponse($this->authentication_url, 'POST', $postFields, array(''));
    if (!$response) {
        $this->sp_log("Authentication failed");
        return null;
    }
    $response = json_decode(json_encode($response), true);
    $this->sp_log("Token generated Successfully");
    $this->SP_TOKEN = $response['token'];
    $this->SP_STORE = $response['store_id'];
    return $this->SP_TOKEN;
}
```
#### Next, copy below lines of ``prepareTransactionPayload($payload)`` method and replace the code of this method into ``Shurjopay.php`` and save the file. After doing this step, you are done to run your application with ``.env`` credentials.

```
public function prepareTransactionPayload($payload)
{

return json_encode(
    array(
        # store information
        'token' => $this->SP_TOKEN,
        'store_id' => $this->SP_STORE,
        'prefix' => config('ShurjopayConfig.SP_PREFIX),
        'currency' => $payload->currency,
        'return_url' => config('ShurjopayConfig.SP_CALLBACK),
        'cancel_url' => config('ShurjopayConfig.SP_CALLBACK),
        'amount' => $payload->amount,
        # Order information
        'order_id' => config('ShurjopayConfig.SP_PREFIX).uniqid(),
        'discsount_amount' => $payload->discountAmount,
        'disc_percent' => $payload->discPercent,
        # Customer information
        'client_ip' => $_SERVER['REMOTE_ADDR'] ?: ($_SERVER['HTTP_X_FORWARDED_FOR'] ?: $_SERVER['HTTP_CLIENT_IP']),
        'customer_name' => $payload->customerName,
        'customer_phone' => $payload->customerPhone,
        'customer_email' => $payload->customerEmail,
        'customer_address' => $payload->customerAddress,
        'customer_city' => $payload->customerCity,
        'customer_state' => $payload->customerState,
        'customer_postcode' => $payload->customerPostcode,
        'customer_country' => $payload->customerCountry,
        'shipping_address' => $payload->shippingAddress,
        'shipping_city' => $payload->shippingCity,
        'shipping_country' => $payload->shippingCountry,
        'received_person_name' => $payload->receivedPersonName,
        'shipping_phone_number' => $payload->shippingPhoneNumber,
        'value1' => $payload->value1,
        'value2' => $payload->value2,
        'value3' => $payload->value3,
        'value4' => $payload->value4
        )
        );
    }
```
remember to save the file kindly. For [more information](https://laravelpackage.com/07-configuration-files.html#merging-into-the-existing-configuration).

### Can I customize ``shurjoPay-plugin.log`` file's path?
Yes ! , you can . By default ``sp-plugin-php`` provide logging file in application's ``public`` folder. If you want our ``shurjoPay-plugin.log`` file into laravel's default log-location then kindly remove 
``define('SP_LOG_LOCATION', 'shurjoPay-plugin-log/', false);`` from ``vendor/shurjomukhi/shurjopay-plugin-php/src/ShurjppayConfig.php`` file and put below line there.

```
/* this SP_LOG_LOCATION will work for only laravel_version 5.1x to 9.0x(or above)"  */
define('SP_LOG_LOCATION',storage_path('logs/shurjoPay-plugin-log/'), false);
```
-->
#### References
 Please see our [sample integration](https://github.com/shurjopay-plugins/sp-plugin-usage-examples/tree/dev/laravel-app-laravel-plugin/shurjopay_integ_usage_project_new) project which will give you some idea and help you to integrate our package.

#### License
This code is under the [MIT open source License](http://www.opensource.org/licenses/mit-license.php).

#### Please [contact](https://shurjopay.com.bd/#contacts) with shurjoPay team for more detail!
<hr>
Copyright ©️2023 shurjoMukhi Limited.
