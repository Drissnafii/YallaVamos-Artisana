<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

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
            $credentials = $request->validated();

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                // Check user role and redirect accordingly
                if (Auth::user()->role === 'admin') {
                    return redirect()->intended('/admin/dashboard');
                }

                return redirect()->intended('/dashboard');
            }

            return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
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
                return redirect('/admin/dashboard');
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

    public function userDashboard(): View
    {
        $user = $this->authService->me();
        return view('dashboard.user', compact('user'));
    }


    public function adminDashboard(): View
    {
        $user = $this->authService->me();
        return view('dashboard.admin', compact('user'));
    }

}
