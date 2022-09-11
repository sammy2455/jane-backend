<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Services\CategoryService;
use App\Models\Category;

class CategoryDestroyController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function __invoke(Category $category)
    {
        // Soft delete Category
        $this->categoryService->delete($category);

        return response()->json([
            'success' => true,
            'message' => 'The category was successfully eliminated.',
        ]);
    }
}
