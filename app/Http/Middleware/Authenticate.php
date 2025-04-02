<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Use the facade
use Tymon\JWTAuth\Facades\JWTAuth; // Use JWTAuth facade
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Auth\AuthenticationException; // Import this

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, \Closure $next, ...$guards)
    {
        // If default web guard is requested or no specific guard
        if (empty($guards) || in_array('web', $guards)) {
            // 1. Check if a JWT token exists in the session
            if ($token = $request->session()->get('jwt_token')) {
                try {
                    // 2. Attempt to authenticate using the JWT token from the session
                    // This sets the user for the 'api' guard (or whichever guard uses jwt driver)
                    if ($user = JWTAuth::setToken($token)->authenticate()) {
                         // 3. Explicitly log the user into the default 'web' guard for THIS request
                         // This makes Auth::user() and Auth::check() work as expected later in the request lifecycle
                         // ONLY if the JWT token is valid.
                         Auth::guard('web')->setUser($user); // Or just Auth::setUser($user); if 'web' is default

                         // Proceed with the request, user is authenticated via JWT stored in session
                        return $next($request);
                    }
                } catch (JWTException $e) {
                    // Token invalid or expired - clear it and fall through to standard auth check or redirect
                    $request->session()->forget('jwt_token');
                    Auth::guard('api')->logout(); // Ensure api guard is logged out too
                }
            }
        }

        // Fallback to the standard Laravel authentication check for the requested guards
        // This will handle standard session logins if you mix methods, or redirect if session JWT fails
        $this->authenticate($request, $guards);


        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     * Added null return type hint for compatibility.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login'); // Or your login route name
    }
}
