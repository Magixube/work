<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/orders', 'App\Http\Controllers\api\OrdersController@index');
