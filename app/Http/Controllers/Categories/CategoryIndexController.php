<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\IndexRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryIndexController extends Controller
{
    public function __invoke(IndexRequest $request)
    {
        return $this->createQuery($request);
    }

    private function createQuery(IndexRequest $request)
    {
        $categories = Category::query();

        if (!is_null($request->query('name'))) {
            $categories->where('name', 'LIKE', '%' . $request->query('name') . '%');
        }

        $categories->latest();

        return CategoryResource::collection($categories->paginate());
    }
}
