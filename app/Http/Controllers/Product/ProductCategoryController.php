<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductCategoryController extends ApiController
{
    public function index(Product $product)
    {
        $categories = $product->categories;
        return $this->showAll($categories);
    }

    public function update(Request $request, Product $product, Category $category)
    {
        $product->categories()->syncWithoutDetaching($category->id);
        $categories = $product->categories;
        return $this->showAll($categories);
    }

    public function destroy(Product $product, Category $category)
    {
        if(! $product->categories()->find($category->id)) {
            return $this->errorResponse('The product does not belong to the specified category', 404);
        }
        $product->categories()->detach($category->id);
        $categories = $product->categories;
        return $this->showAll($categories);
    }
}
