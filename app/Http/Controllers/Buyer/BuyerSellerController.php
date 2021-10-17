<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyerSellerController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('index');
        $this->middleware('can:view,buyer')->only('index');
    }
    public function index(Buyer $buyer)
    {
        $sellers =  $buyer->transactions()
                ->with('product.seller')
                ->get()
                ->pluck('product.seller')
                ->unique();
        return $this->showAll($sellers);
    }
}
