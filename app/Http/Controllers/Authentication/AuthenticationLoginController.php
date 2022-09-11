<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Services\AuthService;

class AuthenticationLoginController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function __invoke(LoginRequest $request)
    {
        // Authentication user
        $token = $this->authenticateUser($request);

        // Response with styles
        return $this->authService->respondWithToken($token);
    }

    private function authenticateUser(LoginRequest $request)
    {
        $email = $request->post('email');
        $password = $request->post('password');

        return $this->authService->login($email, $password);
    }
}
