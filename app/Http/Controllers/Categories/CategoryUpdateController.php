<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\UpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Services\AuthService;
use App\Http\Services\CategoryService;
use App\Models\Category;

class CategoryUpdateController extends Controller
{
    private AuthService $authService;
    private CategoryService $categoryService;

    public function __construct(AuthService $authService, CategoryService $categoryService)
    {
        $this->authService = $authService;
        $this->categoryService = $categoryService;
    }

    public function __invoke(UpdateRequest $request, Category $category)
    {
        // Get token user
        $tokenUser = $this->authService->getAuthenticatedUser();

        // Check if category created by user
        $this->categoryService->createdBy($category, $tokenUser);

        // Update category
        $this->updateCategory($request, $category);

        //
        return new CategoryResource($category);
    }

    private function updateCategory(UpdateRequest $request, Category $category)
    {
        $name = $request->post('name');

        $this->categoryService->update($category, $name);
    }
}
