<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Resources\User;
use App\Http\Services\AuthService;

class AuthenticationMeController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function __invoke()
    {
        return new User($this->authService->getAuthenticatedUser());
    }
}
