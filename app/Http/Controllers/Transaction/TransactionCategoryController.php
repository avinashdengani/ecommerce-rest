<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionCategoryController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('index');
        $this->middleware('can:view,transaction')->only('index');
    }
    public function index(Transaction $transaction)
    {
        $categories = $transaction->product->categories;
        return $this->showAll($categories);
    }
}
