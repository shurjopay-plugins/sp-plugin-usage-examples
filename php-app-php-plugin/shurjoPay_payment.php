<?php

use ShurjopayPlugin\ShurjopayEnvReader;
use ShurjopayPlugin\Shurjopay;
use ShurjopayPlugin\PaymentRequest;

/**
 *
 * PHP Plug-in service to provide shurjoPay get way services.
 *
 * @author Md Wali Mosnad Ayshik
 * @since 2022-10-15
 */


 require_once __DIR__ . '/src/ShurjopayEnvReader.php';
 require_once __DIR__ . '/src/Shurjopay.php';
 require_once __DIR__ . '/src/PaymentRequest.php';

$env = new ShurjopayEnvReader(__DIR__ . '/_env');
$conf = $env->getConfig();


$amount = (float)$_POST['pamount'];
$sp_instance = new Shurjopay($conf);

$request = new PaymentRequest();


$request->currency = 'BDT';
$request->amount = $amount;
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

$sp_instance->makePayment($request);

?>
