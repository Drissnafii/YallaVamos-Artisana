<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // Display a listing of users
    public function index()
    {
        $users = User::all();
        return view('dashboard.admin.users.index', compact('users'));
    }

    // Show the form for creating a new user
    public function create()
    {
        return view('dashboard.admin.users.create');
    }

    // Store a newly created user in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,editor,viewer',
        ]);
        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    // Show the form for editing the specified user
    public function edit(User $user)
    {
        return view('dashboard.admin.users.edit', compact('user'));
    }

    // Update the specified user in storage
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|in:admin,editor,viewer',
        ]);
        if ($validated['password']) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }
        $user->update($validated);
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    // Remove the specified user from storage
    public function destroy(User $user)
    {
        // Check if user has authored any articles
        $articlesCount = Article::where('author_id', $user->id)->count();

        if ($articlesCount > 0) {
            return redirect()->route('admin.users.index')
                ->with('error', "Cannot delete this user because they have authored {$articlesCount} articles. Please reassign or delete these articles first.");
        }

        try {
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Failed to delete user. They may have associated records in the system.');
        }
    }

    // Optional: Add this method to provide a UI for reassigning articles
    public function confirmDelete(User $user)
    {
        $articles = Article::where('author_id', $user->id)->get();
        $adminUsers = User::where('role', 'admin')
                        ->where('id', '!=', $user->id)
                        ->get();

        return view('dashboard.admin.users.confirm-delete', compact('user', 'articles', 'adminUsers'));
    }

    // Optional: Add this method to handle article reassignment
    public function reassignArticles(Request $request, User $user)
    {
        $request->validate([
            'new_author_id' => 'required|exists:users,id'
        ]);

        DB::beginTransaction();

        try {
            // Reassign all articles to new author
            Article::where('author_id', $user->id)
                ->update(['author_id' => $request->new_author_id]);

            // Delete the user
            $user->delete();

            DB::commit();

            return redirect()->route('admin.users.index')
                ->with('success', 'User deleted and articles reassigned successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('admin.users.index')
                ->with('error', 'Failed to reassign articles and delete user: ' . $e->getMessage());
        }
    }
}
