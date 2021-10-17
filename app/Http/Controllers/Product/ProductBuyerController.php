<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductBuyerController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('index');
    }
    public function index(Product $product)
    {
        Gate::authorize('admin');
        $buyers = $product->transactions()
                    ->with('buyer')
                    ->get()
                    ->pluck('buyer')
                    ->unique('id');

        return $this->showAll($buyers);
    }
}
