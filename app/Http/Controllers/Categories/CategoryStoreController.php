<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\StoreRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Services\AuthService;
use App\Http\Services\CategoryService;
use App\Models\User;

class CategoryStoreController extends Controller
{
    private AuthService $authService;
    private CategoryService $categoryService;

    public function __construct(AuthService $authService, CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->authService = $authService;
    }

    public function __invoke(StoreRequest $request)
    {
        // Get token user
        $tokenUser = $this->authService->getAuthenticatedUser();

        // Create category
        $category = $this->createCategory($request, $tokenUser);

        //
        return new CategoryResource($category);
    }

    private function createCategory(StoreRequest $request, User $user)
    {
        $name = $request->post('name');
        $createdBy = $user->user_id;

        return $this->categoryService->store($name, $createdBy);
    }
}
