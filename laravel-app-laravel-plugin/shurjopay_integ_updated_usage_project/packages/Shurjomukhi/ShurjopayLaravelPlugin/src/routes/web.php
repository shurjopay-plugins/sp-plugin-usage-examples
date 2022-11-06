<?php

use Illuminate\Support\Facades\Route;
use Shurjomukhi\ShurjopayLaravelPlugin\Http\Controllers\Shurjopay;

Route::get('/test',[Shurjopay::class,'authenticate']);
Route::post('/test2',[Shurjopay::class,'makePayment']);
Route::post('/test3',[Shurjopay::class,'verifyPayment']);
