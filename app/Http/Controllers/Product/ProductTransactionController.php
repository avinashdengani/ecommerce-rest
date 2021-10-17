<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductTransactionController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('index');
    }
    public function index(Product $product)
    {
        Gate::authorize('admin');
        $transactions = $product->transactions;
        return $this->showAll($transactions);
    }
}
