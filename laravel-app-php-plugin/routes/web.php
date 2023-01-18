<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('/shurjopay', 'ShurjopayControllers@make_payment_request')-> name('shurjopay.lara');
Route::get('/paymentUpdate', 'ShurjopayControllers@verify_payment');
