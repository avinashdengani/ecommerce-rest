<?php

use App\Http\Controllers\BuyersController;
use App\Http\Controllers\SellersController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('buyers', BuyersController::class)->only('index', 'show');
/**
 * Another way for using same routes written above for buyers
 * Route::resource('buyers', BuyersController::class, ['only' => ['index', 'show']]);
*/
Route::resource('sellers', SellersController::class)->only('index', 'show');
Route::resource('users', UsersController::class)->except('create', 'edit');
