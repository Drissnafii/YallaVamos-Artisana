<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProfileRequest;
use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Authorization logic can be implemented here if needed.
    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('dashboard.admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user profile
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('dashboard.admin.users.create');
    }

    /**
     * Store a newly created user profile
     *
     * @param  \App\Http\Requests\Admin\StoreProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreProfileRequest $request)
    {
        $validated = $request->validated();

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo = $path;
        }

        $user->save();

        // Assign role if using a role management system
        if (isset($validated['role'])) {
            $user->assignRole($validated['role']);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'User profile created successfully.');
    }

    /**
     * Display the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('dashboard.admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('dashboard.admin.users.edit', compact('user'));
    }

    /**
     * Show the current user's profile edit form.
     *
     * @return \Illuminate\View\View
     */
    public function editProfile()
    {
        return view('dashboard.admin.profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the specified user.
     *
     * @param  \App\Http\Requests\Admin\UpdateProfileRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProfileRequest $request, User $user)
    {
        $validated = $request->validated();

        // Update basic info
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old profile photo if exists
            if ($user->profile_photo) {
                Storage::delete('public/' . $user->profile_photo);
            }

            // Store the new image
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo = $path;
        }

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        // Check if role needs to be updated and if user has permission
        if (isset($validated['role']) && $request->user()->can('manageRoles', $user)) {
            $user->syncRoles($validated['role']);
        }

        if ($user->id === Auth::id()) {
            return redirect()->route('admin.profile.edit')
                ->with('success', 'Your profile has been updated successfully.');
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'User profile updated successfully.');
    }

    /**
     * Update the current user's profile.
     *
     * @param  \App\Http\Requests\Admin\UpdateProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = User::find(Auth::id());
        $validated = $request->validated();

        // Update basic info
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old profile photo if exists
            if ($user->profile_photo) {
                Storage::delete('public/' . $user->profile_photo);
            }

            // Store the new image
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo = $path;
        }

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Your profile has been updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        // Don't allow users to delete themselves
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        // Check if this is the last admin user
        if ($user->hasRole('admin') && User::role('admin')->count() <= 1) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Cannot delete the last admin user.');
        }

        // Delete user's profile photo if exists
        if ($user->profile_photo) {
            Storage::delete('public/' . $user->profile_photo);
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}
