<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SellersController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('index', 'show');
        $this->middleware('scope:read-general')->only('show');
        $this->middleware('can:view,seller')->only('show');
    }
    public function index()
    {
        Gate::authorize('admin');
        $sellers = Seller::has('products')->get();
        return $this->showAll($sellers);
    }
    public function show(Seller $seller)
    {
        return $this->showOne($seller);
    }
}
