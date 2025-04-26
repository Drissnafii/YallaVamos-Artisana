<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;

class AuthService
{
    /**
     * Register a new user.
     *
     * @param array $data
     * @return array
     */
    public function register($data)
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'role'     => $data['role'] ?? 'member', // Use the role from the form data, or default to 'member' if not provided
            'password' => Hash::make($data['password']),
        ]);

        return [
            'user' => $user,
        ];
    }

    /**
     * Log in a user and return a JWT token.
     *
     * @param array $credentials
     * @return string
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function login(array $credentials): array
    {
        if (!Auth::attempt($credentials)) {
            throw new AuthenticationException('Invalid credentials.');
        }

        return [
            'message' => 'Login successful.',
        ];
    }

    /**
     * Log out the currently authenticated user.
     *
     * @return void
     */
    public function logout(): void
    {
        Auth::logout();
    }

}
