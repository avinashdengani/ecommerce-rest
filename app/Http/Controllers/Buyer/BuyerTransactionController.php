<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyerTransactionController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('index');
    }
    public function index(Buyer $buyer)
    {
        $transactions =  $buyer->transactions;
        return $this->showAll($transactions);
    }
}
