<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Get the middleware that should be assigned to the controller.
     *
     * @return array
     */
    protected function middleware()
    {
        return [
            'auth' => ['except' => ['showLoginForm', 'login', 'showRegisterForm', 'register']],
        ];
    }

    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        try {
            // dd(Auth::user());
            $credentials = $request->validated();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->role === 'member') {
                return redirect()->route('member.dashboard');
            }
            return redirect('/dashboard');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => $e->getMessage()]);
        }
    }

    public function showRegisterForm(): View
    {
        return view('auth.register');
    }


    public function register(RegisterRequest $request): RedirectResponse
    {
        try {
            // 1. Register the user using the service. It returns an array.
            $registrationResult = $this->authService->register($request->validated());

            // --- Handle JWT ---
            $user = $registrationResult['user'];
            $token = $registrationResult['token'];

            // Defensive check: Ensure service returned valid data
            if (!$user instanceof User || !$token) {
                Log::error('AuthService::register did not return a valid user object or token.');
                return back()->withErrors(['error' => 'Registration failed: Could not initialize session.'])->withInput();
            }

            // 2. Store the JWT token in the session (CRUCIAL STEP)
            // Use the service's method | directly call session()
            session(['jwt_token' => $token]);
            // OR if you want to keep it encapsulated:
            // $this->authService->storeTokenInSession($token); // Assumes storeTokenInSession is public or protected and called via $this

            Log::info('User registered and JWT token stored in session.', ['user_id' => $user->id]);
            // --- End JWT Handling ---


            // 3. Redirect based on the user's role (use the $user object we just got)
            // DO NOT use Auth::user() here, as the JWT state is primary
            Log::info('Redirecting user after registration:', ['role' => $user->role]);

            if ($user->role === 'admin') { // This case might be unlikely right after registration if role is hardcoded to 'member'
                Log::warning('Admin user registered directly.', ['user_id' => $user->id]); // Log if this happens
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'member') {
                return redirect()->route('member.dashboard');
            } else {
                // Fallback if role is somehow different
                Log::warning('User registered with unexpected role:', ['user_id' => $user->id, 'role' => $user->role]);
                return redirect()->route('member.dashboard'); // Default redirect
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Registration validation failed.', ['errors' => $e->errors()]);
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Registration process failed:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            return back()->withErrors(['error' => 'An unexpected error occurred during registration.'])->withInput();
        }
    }

    public function logout(): RedirectResponse
    {
        $this->authService->logout();
        return redirect('/login');
    }

    public function dashboard(): View
    {
        $user = $this->authService->me();
        return view('dashboard', compact('user'));
    }

    public function memberDashboard(): View
    {
        $user = $this->authService->me();
        return view('dashboard.member', compact('user'));
    }


    public function adminDashboard(): View
    {
        $user = $this->authService->me();
        return view('dashboard.admin', compact('user'));
    }

}
// Log::info('User after registration:', ['user' => $user->toArray()]);
// Log::info('Auth::user():', Auth::user() ? Auth::user()->toArray() : null);
// Log::info('JWT Token:', ['token' => $token]);
