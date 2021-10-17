<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TransactiosController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('index', 'show');
        $this->middleware('scope:read-general')->only('show');
        $this->middleware('can:view,transaction')->only('show');
    }
    public function index()
    {
        Gate::authorize('admin');
        $transactions = Transaction::all();
        return $this->showAll($transactions);
    }

    public function show(Transaction $transaction)
    {
        return $this->showOne($transaction);
    }
}
