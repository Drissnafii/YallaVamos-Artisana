<?php

namespace App\Http\Controllers;

use App\Models\Stadium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicStadiumController extends Controller
{
    /**
     * Display a public listing of stadiums.
     */
    public function index(Request $request)
    {
        $query = Stadium::with(['city', 'matches']);

        // Handle search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Check if the user is authenticated
        $isAuthenticated = Auth::check();

        // If not authenticated, limit to 3 stadiums
        if (!$isAuthenticated) {
            $stadiums = $query->orderBy('name')->take(3)->get();
            $showLoginMessage = true;
        } else {
            $stadiums = $query->orderBy('name')->paginate(10);
            $showLoginMessage = false;
        }

        return view('pages.stadiums.index', compact('stadiums', 'isAuthenticated', 'showLoginMessage'));
    }

    /**
     * Display the specified stadium.
     */
    public function show(Stadium $stadium)
    {
        $stadium->load(['city', 'matches']);

        return view('pages.stadiums.show', compact('stadium'));
    }
}
