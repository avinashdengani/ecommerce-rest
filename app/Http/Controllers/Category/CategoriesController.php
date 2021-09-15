<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\Category;
use App\Transformers\CategoryTransformer;
use Illuminate\Http\Request;

class CategoriesController extends ApiController
{
    public function __construct()
    {
        $this->middleware('transform.input:'. CategoryTransformer::class)->only(['store', 'update']);
    }
    public function index()
    {
        $categories = Category::all();
        return $this->showAll($categories);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:2',
            'description' => 'required|min:2'
        ];

        $this->validate($request, $rules);

        $category = Category::create($request->only('name', 'description'));
        return $this->showOne($category);
    }

    public function show(Category $category)
    {
        return $this->showOne($category);
    }

    public function update(Request $request, Category $category)
    {
        $category->fill($request->only(['name', 'description']));

        if($category->isClean()) {
            return $this->errorResponse('You need to change something to update data!', 422);
        }

        $category->save();
        return $this->showOne($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->showOne($category);
    }
}
