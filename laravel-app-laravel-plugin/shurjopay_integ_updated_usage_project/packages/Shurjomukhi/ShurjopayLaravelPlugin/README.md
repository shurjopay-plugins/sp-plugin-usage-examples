![image](https://user-images.githubusercontent.com/57352037/170198396-932692aa-3354-4cf0-abc1-2b8ef43a6de3.png)
# ShurjoPay

Shurjopay laravel integration steps
## Prerequisite
To integrate ShurjoPay you need few credentials to access shurjopay:
```
:param prefix: Any string not more than 5 characters. It distinguishes the stores of a merchant.
:param currency: ISO format,(only BDT and USD are allowed).
:param return_url: Merchant should provide a GET Method return url to verify users initiated transaction status. 
:param cancel_url: Merchant should provide a cancel url to redirect the user if he/she cancels the transaction in midway. 
:param client_ip: User's ip
:param username: Merchant Username provided by shurjopay.
:param password: Merchant Password provided by shurjopay.
:param post_address: Live shurjopay version 2 URL.
```


> 📝 **NOTE** For shurjoPay live engine integration's all necessary credential will be given to merchant after subscription completed on shurjoPay gateway.



# Shurjopay/Laravel
#### To integrate the shurjoPay Payment Gateway in your Laravel project do the following tasks sequentially.

### step:1  Installation and Configuration



``composer require ......
``

###### step:2  After successful installation of shurjopay-laravel-package, go to your project and open config folder and then click on app.php file. Append the following line in providers array.

``
Shurjopay\Laravelplugin\ShurjopayServiceProvider::class
``

###### step:3  After successfully doing the above steps add the following Keys in .env file with the credentials provided from shurjoMukhi Limited

``MERCHANT_USERNAME=""  
``

``MERCHANT_PASSWORD=""
``

``MERCHANT_PREFIX=""
``

``MERCHANT_RETURN_URL=""
``

``MERCHANT_CANCEL_URL=""
``

``ENGINE_URL=""
``
###### step:4 Now add this line of code in your method where you want to call shurjoPay Payment Gateway. You can use any code segment of below

=> Use below namespace in your controller
``
use Shurjopay\Laravelplugin\Http\Controllers\Shurjopay;
``

``First make sure you are doing http post request for making payment by your method (param should be used Illuminate\Http\Request ) with values of below fields:

'currency' => '',
'amount' => '',
'order_id' => '',
'discount_amount' => '' ,
'disc_percent' =>'',
'client_ip' => '',
'customer_name' => '',
'customer_phone' => '',
'customer_email' => '',
'customer_address' => '',
'customer_city' => '',
'customer_state' =>'',
'customer_postcode' => '',
'customer_country' => '',
'shipping_address' => '',
'shipping_city' => '',
'shipping_country' => '',
'received_person_name' => '',
'shipping_phone_number' => '',
'value1' =>'',
'value2' =>'',
'value3' =>'',
'value4' =>'',

=>Then in your payment method you need to add below lines

``$shurjopay_instance = new Shurjopay();
  return $shurjopay_instance->makePayment($request);``

###### for verifying,

``$shurjopay_instance = new Shurjopay();
  return $shurjopay_instance->verifyPayment($order_id);``


### Postman Documentations

    This document will illustrate the overall request and response flow.
    URL : https://documenter.getpostman.com/view/6335853/U16dS8ig	
		
### Who do I talk to? ###
	For any technical assistance please contact to: https://shurjopay.com.bd/#contacts

