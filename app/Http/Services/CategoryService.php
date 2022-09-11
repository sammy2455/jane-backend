<?php

namespace App\Http\Services;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoryService
{
    public function createdBy(Category $category, User $user)
    {
        if (strcmp($category->created_by, $user->user_id) != 0) {
            throw new HttpResponseException(response()->json([
                'success' => true,
                'message' => 'Forbidden',
            ], 403));
        }
    }

    public function store(string $name, string $createdBy): Category
    {
        try {
            $category = new Category();

            $category->name = $name;
            $category->created_by = $createdBy;

            $category->save();
        } catch (\Exception $exception) {
            throw new HttpResponseException(response()->json([
                'success' => true,
                'message' => 'The category could not be registered, please try again later.',
            ], 500));
        }

        return $category;
    }

    public function update(Category $category, string $name = null)
    {
        try {

            if (!is_null($name)) {
                $category->name = $name;
            }

            $category->save();
        } catch (\Exception $exception) {
            throw new HttpResponseException(response()->json([
                'success' => true,
                'message' => 'The category could not be updated, please try again later.',
            ], 500));
        }
    }

    public function delete(Category $category)
    {
        try {
            $category->deleteOrFail();
        } catch (\Throwable $e) {
            throw new HttpResponseException(response()->json([
                'success' => true,
                'message' => 'The category could not be deleted, please try again later.',
            ], 500));
        }
    }
}
