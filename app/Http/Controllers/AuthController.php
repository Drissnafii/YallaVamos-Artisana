<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Article;
use App\Models\City;
use App\Models\MatchX;
use App\Models\Stadium;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthController extends \App\Http\Controllers\Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
        $this->middleware('auth', ['except' => ['showLoginForm', 'login', 'showRegisterForm', 'register']]);
    }

    public function showLoginForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return Redirect::route('admin.dashboard');
            }
            return Redirect::route('member.dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return Redirect::route('admin.dashboard');
            }

            return Redirect::route('member.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
         ])->withInput($request->except('password'));
    }

    public function showRegisterForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return Redirect::route('member.dashboard');
        }

        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $user = $this->authService->register($request->all());

            Auth::login($user);

            if (Auth::user()->role === 'admin') {
                return Redirect::route('admin.dashboard');
            }

            return Redirect::route('member.dashboard');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Registration failed. Please try again.'])->withInput();
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::route('index');
    }

    public function adminDashboard(): View
    {
        $cityCount = City::count();
        $stadiumCount = Stadium::count();

        return view('dashboard.admin.index', [
            'user' => Auth::user(),
            'cityCount' => $cityCount,
            'stadiumCount' => $stadiumCount
        ]);
    }

    public function memberDashboard(): View
    {
        $user = Auth::user();

        $userArticles = Article::where('author_id', $user->id)->get();
        $upcomingMatches = MatchX::with(['team1', 'team2', 'stadium.city'])
            ->whereDate('date', '>=', now())
            ->whereDate('date', '<=', now()->addDays(7))
            ->orderBy('date')
            ->get();

        return view('member.dashboard', compact(
            'userArticles',
            'upcomingMatches'
        ));
    }
}
