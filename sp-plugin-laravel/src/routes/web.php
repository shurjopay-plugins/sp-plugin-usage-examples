<?php

use Illuminate\Support\Facades\Route;
use Shurjopayv3\SpPluginLaravel\Http\Controllers\ShurjopayController;

Route::get('/test',[ShurjopayController::class,'authenticate']);
