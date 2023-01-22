
 <!-- 
 * This is an official documentation of integrating "shurjoPay" in laravel.
 *
 * By following steps of this documentation, any user can be able to integrate "shurjoPay" pacakge easily. 
 * In this documentation , a sample integration process is also available.
 *
 * @author Rayhan Khan Ridoy
 * @since 2022-12-01 
 -->
 

# ![image](https://user-images.githubusercontent.com/57352037/170198396-932692aa-3354-4cf0-abc1-2b8ef43a6de3.png) How to run this project?
[![Test Status](https://github.com/rust-random/rand/workflows/Tests/badge.svg?event=push)]()
[![Stable](https://img.shields.io/badge/Stable-v2.1.0-green)]()
[![License](https://img.shields.io/badge/License-MIT-blue)]()
[![Rating](https://img.shields.io/badge/Rating-*****-green)]()
[![Depandency](https://img.shields.io/badge/Depandency-No-blue)]()

Official documentation for shurjoPay plugin developers to connect with [**_shurjoPay_**](https://shurjopay.com.bd) Payment Gateway ``` v2.1.0 ``` developed and maintained by [_**ShurjoMukhi Limited**_](https://shurjomukhi.com.bd). This documentation can be used to integrate sp-plugin-php into laravel application.

## Audience

This document is intended for the developers and technical personnel who want to integrate the shurjoPay online payment gateway by sp-plugin-php in laravel application.

To integrate the shurjoPay Payment Gateway using ``sp-plugin-php``, kindly do the following tasks sequentially.

#### Step-1: Install the package inside your project environment.
Open your project's ``composer.json`` file . Then copy below line and put it into the body of ``require`` block.

```
"shurjomukhi/shurjopay-plugin-php":"dev-refactor-code"
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
#### Step-2: Ready to run but make sure you have ``.env`` file. If there is no ``.env`` then please make a ``.env`` from ``.env.example`` by below command.
```
cp .env.example .env
```
Now application is ready to work. Just give another command in terminal

```
php artisan serve
```
#### References
 Please see our [sample integration](https://github.com/shurjopay-plugins/sp-plugin-usage-examples/tree/dev/laravel-app-php-plugin-for-refactor-code--branch) project which will give you some idea and help you to integrate our package.

#### License
This code is under the [MIT open source License](http://www.opensource.org/licenses/mit-license.php).

#### Please [contact](https://shurjopay.com.bd/#contacts) with shurjoPay team for more detail!
<hr>
Copyright ©️2022 shurjoMukhi Limited.
