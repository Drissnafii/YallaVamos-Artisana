<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            // Retrieve the token from the Authorization header or the session
            $authorizationHeader = $request->header('Authorization');
            if ($authorizationHeader && preg_match('/Bearer\s(\S+)/', $authorizationHeader, $matches)) {
                $token = $matches[1];
            } else {
                $token = Session::get('jwt_token');
            }

            if (!$token) {
                return response()->json(['message' => 'Token not provided.'], 401);
            }

            // Set token for the current request
            JWTAuth::setToken($token);

            // Attempt to authenticate the user
            $user = JWTAuth::authenticate();

            if (!$user) {
                Session::forget('jwt_token');
                return response()->json(['message' => 'User not found.'], 401);
            }

            // Log the user into the application
            Auth::login($user);

        } catch (TokenExpiredException $e) {
            // Token has expired; attempt to refresh it
            try {
                $refreshedToken = JWTAuth::refresh(JWTAuth::getToken());
                Session::put('jwt_token', $refreshedToken);

                // Reattempt authentication with the refreshed token
                JWTAuth::setToken($refreshedToken);
                $user = JWTAuth::authenticate();
                if ($user) {
                    Auth::login($user);
                } else {
                    Session::forget('jwt_token');
                    return redirect()->route('login')
                        ->withErrors(['user' => 'Unable to authenticate user after token refresh.']);
                }
            } catch (JWTException $e) {
                Session::forget('jwt_token');
                return response()->json(['message' => 'Token could not be refreshed.'], 401);
            }
        } catch (TokenInvalidException | JWTException $e) {
            Session::forget('jwt_token');
            return response()->json(['message' => 'Token is invalid.'], 401);
        }

        return $next($request);
    }
}
