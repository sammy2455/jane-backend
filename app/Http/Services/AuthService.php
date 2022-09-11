<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class AuthService
{
    public function login(string $email, string $password): string
    {
        // Authenticate user in to API
        $credentials = [
            'email' => $email,
            'password' => $password,
        ];

        // Get token user
        if (! $token = auth()->attempt($credentials)) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'You have entered an incorrect e-mail address or password'
            ], 401));
        }

        return $token;
    }

    public function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'success' => true,
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => env('JWT_TTL', 10080)
        ]);
    }

    public function logout(): void
    {
        auth()->logout();
    }

    public function refresh(): string
    {
        return auth()->refresh();
    }

    public function getAuthenticatedUser(): User
    {
        return auth()->user();
    }
}
