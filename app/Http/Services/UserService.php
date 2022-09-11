<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class UserService
{
    public function store(string $name, string $username, string $email, string $password): User
    {
        try {
            $user = new User();
            $user->name = $name;
            $user->username = $username;
            $user->email = $email;
            $user->password = Hash::make($password);

            $user->save();
        } catch (Exception $exception) {
            throw new HttpResponseException(response()->json([
                'success' => true,
                'message' => 'The user could not be registered, please try again later.',
            ], 500));
        }

        return $user;
    }
}
