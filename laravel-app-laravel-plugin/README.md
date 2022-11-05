![image](https://user-images.githubusercontent.com/57352037/170198396-932692aa-3354-4cf0-abc1-2b8ef43a6de3.png)
# ShurjoPay

# There are two-usages project baseed on Shurjopay Payment Plugin.

i) ``shurjopay_integ_updated_usage_project`` (new project using updated shurjopay)

ii) `` shurjopayv3_integ ``

###### To run this laravel application in your device,just do the following tasks sequentially.At-first make sure your device has the proper environment set-up for running PHP / Laravel project.

###### Step1: Open the folder of "shurjopay_integ_updated_usage_project" or "shurjopayv3_integ" 

###### Step2: Open terminal and give command,
``
composer update
``

###### Step3: Add the following Keys in .env file with the credentials provided from shurjoMukhi Limited

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
###### Step4: Now application is ready to work. Just give another command in terminal

``
  php artisan serve
``
