<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignupRequest;
use App\Http\Services\AuthService;
use App\Http\Services\UserService;

class AuthenticationSignupController extends Controller
{
    private AuthService $authService;
    private UserService $userService;

    public function __construct(AuthService $authService, UserService $userService)
    {
        $this->authService = $authService;
        $this->userService = $userService;
    }

    public function __invoke(SignupRequest $request)
    {
        // Store user data to database
        $this->storeUserData($request);

        // Authenticate user
        $token = $this->authenticateUser($request);

        // Return with style
        return $this->authService->respondWithToken($token);
    }

    private function storeUserData(SignupRequest $request)
    {
        $name = $request->post('name');
        $username = $request->post('username');
        $email = $request->post('email');
        $password = $request->post('password');

        $this->userService->store($name, $username, $email, $password);
    }

    private function authenticateUser(SignupRequest $request): string
    {
        $email = $request->post('email');
        $password = $request->post('password');

        return $this->authService->login($email, $password);
    }
}
