<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Services\AuthService;

class AuthenticationRefreshController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function __invoke()
    {
        // Get new token
        $token = $this->authService->refresh();

        return $this->authService->respondWithToken($token);
    }
}
