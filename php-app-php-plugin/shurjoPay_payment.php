<?php
//use Shurjomukhi\ShurjopayPhpPlugin;
//use Shurjomukhi\ShurjopayPhpPlugin\PaymentRequest;
/**
 *
 * PHP Plug-in service to provide shurjoPay get way services.
 *
 * @author Md Wali Mosnad Ayshik
 * @since 2022-10-15
 */
require_once 'src/ShurjopayPlugin.php';
 require_once 'src/PaymentRequest.php';
//use Shurjomukhi\ShurjopayPhpPlugin\a;

$amount = (float)$_POST['pamount'];
$sp_instance = new ShurjopayPlugin();
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
