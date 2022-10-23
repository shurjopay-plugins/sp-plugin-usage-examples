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


> 📝 **NOTE** For shurjoPay version 3 live engine integration's all necessary credential will be given to merchant after subscription completed on shurjoPay gateway.



#### To integrate the shurjoPay Payment Gateway in your Laravel project do the following tasks sequentially.

### Installation and Configuration

``composer require shurjopayv3/sp-plugin-laravel
``

###### After successful installation of shurjopay-laravel-package, go to your project and open config folder and then click on app.php file. Append the following line in providers array.
``
Shurjopayv3\SpPluginLaravel\ShurjopayServiceProvider::class
``

###### After successfully doing the above steps add the following Keys in .env file with the credentials provided from shurjoMukhi Limited

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
###### Now add this line of code in your method where you want to call shurjoPay Payment Gateway. You can use any code segment of below

``
use shurjopayv2\ShurjopayLaravelPackage8\Http\Controllers\ShurjopayController;
``

``$info = array(
'currency' => "",
'amount' => ,
'order_id' => "",
'discsount_amount' => ,
'disc_percent' => ,
'client_ip' => "",
'customer_name' => "",
'customer_phone' => "",
'email' => "",
'customer_address' => "",
'customer_city' => "",
'customer_state' => "",
'customer_postcode' => "",
'customer_country' => "",
);``

``$shurjopay_service = new ShurjopayController();
return $shurjopay_service->checkout($info);``

###### for verifying,

``$shurjopay_service = new ShurjopayController();
return $shurjopay_service->verify($order_id);``


### Postman Documentations

    This document will illustrate the overall request and response flow.
    URL : https://documenter.getpostman.com/view/6335853/U16dS8ig	
		
### Who do I talk to? ###
	For any technical assistance please contact to: https://shurjopay.com.bd/#contacts

