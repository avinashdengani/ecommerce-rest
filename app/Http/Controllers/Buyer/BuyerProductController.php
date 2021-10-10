<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyerProductController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('index');
        $this->middleware('scope:read-genereal')->only('index');
    }
    public function index(Buyer $buyer)
    {
        $products =  $buyer->transactions()
                ->with('product')
                ->get()
                ->pluck('product');
        return $this->showAll($products);
    }
}
