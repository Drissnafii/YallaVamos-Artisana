<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
            $user = $this->authService->register($request->validated());
            $this->authService->login([
                'email' => $request->email,
                'password' => $request->password
            ]);

            // Check user role and redirect accordingly
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->role === 'member') {
                return redirect()->route('member.dashboard');
            }
            return redirect('/dashboard');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
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
