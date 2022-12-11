![image](https://user-images.githubusercontent.com/57352037/170198396-932692aa-3354-4cf0-abc1-2b8ef43a6de3.png)
# ShurjoPay


###### To run this laravel application in your device,just do the following tasks sequentially.At-first make sure your device has the proper environment set-up for running PHP / Laravel project.

###### Step1: Open the folder of "shurjopay_integ_updated_usage_project"

###### Step2: Open terminal and give command,
``
composer update
``

###### Step3: Add the following Keys in ".env" file with the credentials provided from shurjoMukhi Limited. If there are no existing of ".env" and ".env.example" files then kindly add these files and then setup below configurations into your ".env" file.

``MERCHANT_USERNAME="sp_sandbox"
``

``MERCHANT_PASSWORD="pyyk97hu&6u6"
``

``MERCHANT_RETURN_URL="https://www.sandbox.shurjopayment.com/response"
``

``MERCHANT_CANCEL_URL="https://www.sandbox.shurjopayment.com/response"
``

``ENGINE_URL="https://sandbox.shurjopayment.com"
``

###### Step4: Now application is ready to work. Just give another command in terminal

``  php artisan serve
``
