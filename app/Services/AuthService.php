<?php

namespace App\Services;

use App\Exceptions\Auth\InvalidCredentialException;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    /**
     * @throws InvalidCredentialException
     */
    public function login($payload): array
    {
        if (!$token = JWTAuth::attempt(['email' => $payload['email'], 'password' => $payload['password']])) {
            throw new InvalidCredentialException();
        }

        return ['token' => $token, 'user' => auth()->user()];
    }

    public function register($payload): array
    {
        $user = User::create([
            'name'     => $payload['first_name'] . ' ' . $payload['last_name'],
            'email'    => $payload['email'],
            'password' => bcrypt($payload['password']),
        ]);

        return ['user' => $user, 'token' => JWTAuth::fromUser($user)];
    }

    public function me(): User|Authenticatable|null
    {
        return auth()->user();
    }

    public function logout(): true
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return true;
    }
}
