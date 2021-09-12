<?php

use App\Http\Controllers\Buyer\BuyerCategoryController;
use App\Http\Controllers\Buyer\BuyerProductController;
use App\Http\Controllers\Buyer\BuyersController as BuyerBuyersController;
use App\Http\Controllers\Buyer\BuyerSellerController;
use App\Http\Controllers\Buyer\BuyerTransactionController;
use App\Http\Controllers\Category\CategoriesController;
use App\Http\Controllers\Category\CategoryBuyerController;
use App\Http\Controllers\Category\CategoryProductController;
use App\Http\Controllers\Category\CategorySellerController;
use App\Http\Controllers\Category\CategoryTransactionController;
use App\Http\Controllers\Product\ProductsController;
use App\Http\Controllers\Seller\SellerBuyerController;
use App\Http\Controllers\Seller\SellerCategoryController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Seller\SellersController;
use App\Http\Controllers\Seller\SellerTransactionController;
use App\Http\Controllers\Transaction\TransactionCategoryController;
use App\Http\Controllers\Transaction\TransactionSellerController;
use App\Http\Controllers\Transaction\TransactiosController;
use App\Http\Controllers\User\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//BUYER
Route::resource('buyers', BuyerBuyersController::class)->only('index', 'show');
/**
 * Another way for using same routes written above for buyers
 * Route::resource('buyers', BuyersController::class, ['only' => ['index', 'show']]);
*/
Route::resource('buyers.transactions', BuyerTransactionController::class)->only('index');
Route::resource('buyers.products', BuyerProductController::class)->only('index');
Route::resource('buyers.sellers', BuyerSellerController::class)->only('index');
Route::resource('buyers.categories', BuyerCategoryController::class)->only('index');


//SELLER
Route::resource('sellers', SellersController::class)->only('index', 'show');
Route::resource('sellers.transactions', SellerTransactionController::class)->only('index');
Route::resource('sellers.buyers', SellerBuyerController::class)->only('index');
Route::resource('sellers.categories', SellerCategoryController::class)->only('index');
Route::resource('sellers.products', SellerProductController::class)->except(['create', 'edit']);


//USER
Route::resource('users', UsersController::class)->except('create', 'edit');

//CATEGORY
Route::resource('categories', CategoriesController::class)->except('create', 'edit');
Route::resource('categories.products', CategoryProductController::class)->only('index');
Route::resource('categories.sellers', CategorySellerController::class)->only('index');
Route::resource('categories.buyers', CategoryBuyerController::class)->only('index');
Route::resource('categories.transactions', CategoryTransactionController::class)->only('index');


Route::resource('products', ProductsController::class)->only('index', 'show');

//TRANSACTIONS
Route::resource('transactions', TransactiosController::class)->only('index', 'show');
Route::resource('transactions.categories', TransactionCategoryController::class)->only('index');
Route::resource('transactions.sellers', TransactionSellerController::class)->only('index');
