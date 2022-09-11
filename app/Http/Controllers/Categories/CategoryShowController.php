<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryShowController extends Controller
{
    public function __invoke(Category $category)
    {
        return new CategoryResource($category);
    }
}
