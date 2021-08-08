<?php

use App\Http\Controllers\BuyersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('buyers', BuyersController::class)->only('index', 'show');
/**
 * Another way for using same routes written above for buyers
 * Route::resource('buyers', BuyersController::class, ['only' => ['index', 'show']]);
*/
