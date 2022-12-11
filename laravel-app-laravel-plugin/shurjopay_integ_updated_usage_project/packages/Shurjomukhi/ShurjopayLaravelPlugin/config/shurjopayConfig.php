<?php
/**
 * This php file returns environmental values from .env as cached config
 *
 * @author Rayhan Khan Ridoy
 * @since 2022-12-01
 */
return [
  'merchant_username' => env('MERCHANT_USERNAME'),
  'merchant_password' => env('MERCHANT_PASSWORD'),
  'merchant_prefix' => env('MERCHANT_PREFIX'),
  'merchant_return_url' => env('MERCHANT_RETURN_URL'),
  'merchant_cancel_url' => env('MERCHANT_CANCEL_URL'),
  'auth_token_url' => env('ENGINE_URL').'/api/get_token',
  'secret_pay_url' => env('ENGINE_URL').'/api/secret-pay',
  'verification_url' => env('ENGINE_URL').'/api/verification',
  /* this log_location1 is for laravel_version 5.0x to 9.0x(or above)"  */
  'log_location1'=> storage_path('logs/shurjoPay-plugin.log'),
  /* this log_location2 is for "laravel_version < 5.0x" */
  'log_location2'=> 'storage/logs/',
];
