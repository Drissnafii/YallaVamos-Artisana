<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Keep this if you keep Auth::login()
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Auth\AuthenticationException; // <-- Import this!

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\AuthenticationException // <-- Declare thrown exception
     */
    public function handle(Request $request, Closure $next)
    {
        $token = null;
        $user = null;

        try {
            // --- Try Header First ---
            $authorizationHeader = $request->header('Authorization');
            if ($authorizationHeader && preg_match('/Bearer\s(\S+)/', $authorizationHeader, $matches)) {
                $token = $matches[1];
                Log::debug('JWT Middleware: Found token in Header.');
            }

            // --- Fallback to Session ---
            if (!$token) {
                $token = Session::get('jwt_token');
                if ($token) {
                    Log::debug('JWT Middleware: Found token in Session.');
                 }
            }

            // --- If no token found anywhere ---
            if (!$token) {
                 Log::debug('JWT Middleware: No token found in Header or Session.');
                throw new AuthenticationException('Token not provided.'); // <-- Throw standard exception
            }

            // --- Authenticate using the found token ---
            JWTAuth::setToken($token);
            $user = JWTAuth::authenticate(); // Throws exceptions on failure

            if (!$user) {
                 // This case is less likely as authenticate() usually throws, but handle defensively
                 Log::warning('JWT Middleware: authenticate() returned null/false unexpectedly.');
                 Session::forget('jwt_token'); // Clear potentially bad session token
                throw new AuthenticationException('User not found for token.'); // <-- Throw standard exception
            }

             // --- Optional but potentially useful: Log user into web guard ---
             // This makes Auth::user() work consistently in subsequent parts of the *same* request
             // Keep it if you need it, remove if JWT auth is sufficient on its own.
             Auth::login($user);
             Log::debug('JWT Middleware: User authenticated and logged into web guard.', ['user_id' => $user->id]);


        } catch (TokenExpiredException $e) {
             Log::debug('JWT Middleware: Token expired.');
             // --- Attempt Refresh ---
             // Note: Refresh might fail if the refresh TTL is also exceeded or token is blacklisted
            try {
                 // Use the token we already extracted
                $refreshedToken = JWTAuth::refresh(); // Don't need to pass the token if already set
                Session::put('jwt_token', $refreshedToken); // Store the NEW token
                 Log::debug('JWT Middleware: Token refreshed successfully.');

                 // Re-authenticate with the NEW token
                JWTAuth::setToken($refreshedToken);
                $user = JWTAuth::authenticate(); // Authenticate again
                if ($user) {
                     Auth::login($user); // Log in with web guard again
                     Log::debug('JWT Middleware: Re-authenticated with refreshed token.', ['user_id' => $user->id]);
                     // Now proceed to the $next request with the refreshed token active
                } else {
                     // Should not happen if refresh succeeded and user exists
                     Log::warning('JWT Middleware: Failed to authenticate after token refresh.');
                     Session::forget('jwt_token');
                     throw new AuthenticationException('Unable to authenticate user after token refresh.'); // <-- Throw standard exception
                }

            } catch (JWTException $refreshException) {
                 // Refresh failed (e.g., refresh TTL exceeded, token blacklisted)
                 Log::warning('JWT Middleware: Token could not be refreshed.', ['error' => $refreshException->getMessage()]);
                 Session::forget('jwt_token'); // Clear expired/unrefreshable token
                 throw new AuthenticationException('Token has expired and could not be refreshed.'); // <-- Throw standard exception
            }

        } catch (TokenInvalidException $e) {
             Log::warning('JWT Middleware: Token is invalid.');
             Session::forget('jwt_token'); // Clear invalid token
             throw new AuthenticationException('Token is invalid.'); // <-- Throw standard exception

        } catch (JWTException $e) {
             // Catch other JWT issues (e.g., token malformed, blacklisted, user not found by authenticate())
             Log::error('JWT Middleware: General JWT Exception.', ['error' => $e->getMessage()]);
             Session::forget('jwt_token'); // Clear potentially problematic token
             throw new AuthenticationException('Authentication error: ' . $e->getMessage()); // <-- Throw standard exception
        }

        // If we reach here, authentication (or refresh) was successful
        return $next($request);
    }
}
