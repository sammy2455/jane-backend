<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Services\AuthService;

class AuthenticationLogoutController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function __invoke()
    {
        $this->authService->logout();

        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out'
        ]);
    }
}
