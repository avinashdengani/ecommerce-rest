<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Models\Product;
use Facade\FlareClient\Api;
use Illuminate\Http\Request;

class ProductsController extends ApiController
{
    public function index()
    {
        $products = Product::all();
        return $this->showAll($products);
    }

    public function show(Product $product)
    {
        return $this->showOne($product);
    }
}