![image](https://user-images.githubusercontent.com/57352037/170198396-932692aa-3354-4cf0-abc1-2b8ef43a6de3.png)
# ShurjoPay


###### To run this laravel application in your device,just do the following tasks sequentially.

######Step1: Open the folder of "shurjopayv3_integ" 

######Step2: Open terminal and give command,
``
composer update
``
######Step2: Go to your project and open config folder and then click on app.php file. Append the following line in providers array.
``
Shurjopayv3\SpPluginLaravel\ShurjopayServiceProvider::class
``

######Step3: Add the following Keys in .env file with the credentials provided from shurjoMukhi Limited

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
######Step4: Now application is ready to work. Just give another command in terminal

``
php artisan serve
``
