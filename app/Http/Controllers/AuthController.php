<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        // Define middleware to protect certain actions
        $this->middleware('auth', ['except' => ['showLoginForm', 'login', 'showRegisterForm', 'register']]);
    }

    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('member.dashb  oard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegisterForm(): View
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        try {
            $user = User::create($request->validated());

            // Automatically log in the user after registration
            Auth::login($user);

            // Redirect based on role
            if ($user->role === 'admin') {
                Log::info('Admin registered: ', ['user_id' => $user->id]);
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('member.dashboard');
        } catch (\Exception $e) {
            Log::error('Registration failed: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Registration failed. Please try again.'])->withInput();
        }
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    }

    public function memberDashboard(): View
    {
        return view('dashboard.member', ['user' => Auth::user()]);
    }

    public function adminDashboard(): View
    {
        return view('dashboard.admin', ['user' => Auth::user()]);
    }
}
