<?php

use App\Http\Controllers\BuyerCategoryController;
use App\Http\Controllers\BuyerProductController;
use App\Http\Controllers\BuyersController;
use App\Http\Controllers\BuyerSellerController;
use App\Http\Controllers\BuyerTransactionController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\CategorySellerController;
use App\Http\Controllers\CategoryTransactionController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SellerBuyerController;
use App\Http\Controllers\SellerCategoryController;
use App\Http\Controllers\SellerProductController;
use App\Http\Controllers\SellersController;
use App\Http\Controllers\SellerTransactionController;
use App\Http\Controllers\TransactionCategoryController;
use App\Http\Controllers\TransactionSellerController;
use App\Http\Controllers\TransactiosController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::resource('buyers', BuyersController::class)->only('index', 'show');
/**
 * Another way for using same routes written above for buyers
 * Route::resource('buyers', BuyersController::class, ['only' => ['index', 'show']]);
*/
Route::resource('buyers.transactions', BuyerTransactionController::class)->only('index');
Route::resource('buyers.products', BuyerProductController::class)->only('index');
Route::resource('buyers.sellers', BuyerSellerController::class)->only('index');
Route::resource('buyers.categories', BuyerCategoryController::class)->only('index');


Route::resource('sellers', SellersController::class)->only('index', 'show');
Route::resource('sellers.transactions', SellerTransactionController::class)->only('index');
Route::resource('sellers.buyers', SellerBuyerController::class)->only('index');
Route::resource('sellers.categories', SellerCategoryController::class)->only('index');
Route::resource('sellers.products', SellerProductController::class)->except(['create', 'edit']);


Route::resource('users', UsersController::class)->except('create', 'edit');


Route::resource('categories', CategoriesController::class)->except('create', 'edit');
Route::resource('categories.products', CategoryProductController::class)->only('index');
Route::resource('categories.sellers', CategorySellerController::class)->only('index');
Route::resource('categories.buyers', CategorySellerController::class)->only('index');
Route::resource('categories.transactions', CategoryTransactionController::class)->only('index');


Route::resource('products', ProductsController::class)->only('index', 'show');


Route::resource('transactions', TransactiosController::class)->only('index', 'show');
Route::resource('transactions.categories', TransactionCategoryController::class)->only('index');
Route::resource('transactions.sellers', TransactionSellerController::class)->only('index');
