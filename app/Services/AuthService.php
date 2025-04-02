<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Auth\AuthenticationException;
use Tymon\JWTAuth\Exceptions\JWTException;

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
            'role'     => 'member', // default !
            'password' => Hash::make($data['password']),
        ]);

        // Generate a JWT token for the newly created user
        $token = JWTAuth::fromUser($user);

        return [
            'user' => $user,
            'token' => $token,
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
        if (!$token = JWTAuth::attempt($credentials)) {
            throw new AuthenticationException('Invalid credentials.');
        }

        $this->storeTokenInSession($token);

        return [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
        ];
    }

    /**
     * Log out the current user by invalidating the token.
     *
     * @return void
     */
    public function logout(): void
    {
        $token = session('jwt_token');

        if (!$token) {
             try {
                 $token = JWTAuth::getToken();
             } catch (\Exception $e) {
                 // No token found, maybe already logged out or stateless request
                 $token = null;
             }
        }

        // Invalidate the JWT token if found
        if ($token) {
            try {
                 JWTAuth::invalidate(JWTAuth::setToken($token)->getToken());
            } catch (\Exception $e) {
                // Handle cases where token might already be invalid, etc.
            }
        }

        Auth::guard('api')->logout();

        // Clear the token from the session
        session()->forget('jwt_token');

    }

    /**
     * Refresh the JWT token.
     *
     * @return string
     *
     * @throws \Illuminate\Auth\AuthenticationException|\Tymon\JWTAuth\Exceptions\JWTException
     */
    public function refresh(): string
    {
        $token = null;
        try {
             $token = JWTAuth::getToken();
             if (!$token && session()->has('jwt_token')) { // Fallback to session only if guard fails
                $token = session('jwt_token');
             }
        } catch (\Exception $e) {
            if (session()->has('jwt_token')) {
                $token = session('jwt_token');
            }
        }


        if (!$token) {
             throw new JWTException('Token not provided or found.');
        }

        try {
            $newToken = JWTAuth::refresh();
             if (!$newToken) {
                 throw new JWTException('Could not refresh token.');
             }
             $this->storeTokenInSession($newToken); //
             return $newToken;
        } catch (\Exception $e) {
             throw new JWTException('Could not refresh token: ' . $e->getMessage());
        }
    }


    /**
     * Get the authenticated user.
     *
     * @return \App\Models\User|null
     */
    public function me(): ?User
    {
        $token = session('jwt_token') ?? JWTAuth::getToken();

        if (!$token) {
            throw new JWTException('Token not provided.');
        }

        return JWTAuth::setToken($token)->authenticate();
    }

    /**
     * Store the JWT token in the session.
     *
     * @param string $token
     * @return void
     */
    protected function storeTokenInSession(string $token): void
    {
        session(['jwt_token' => $token]);
    }
}
