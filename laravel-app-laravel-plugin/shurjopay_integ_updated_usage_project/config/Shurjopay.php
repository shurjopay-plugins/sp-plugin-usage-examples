<?php

return [
  'merchant_username' => env('MERCHANT_USERNAME'),
  'merchant_password' => env('MERCHANT_PASSWORD'),
  'merchant_prefix' => env('MERCHANT_PREFIX'),
  'merchant_return_url' => env('MERCHANT_RETURN_URL'),
  'merchant_cancel_url' => env('MERCHANT_CANCEL_URL'),
  'auth_token_url' => env('ENGINE_URL').'/api/get_token',
  'secret_pay_url' => env('ENGINE_URL').'/api/secret-pay',
  'verification_url' => env('ENGINE_URL').'/api/verification',

];
