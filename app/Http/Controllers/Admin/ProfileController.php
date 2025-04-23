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
     * Show the profile edit form (works for both admin and member)
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user();

        // Check if the user is an admin and show the appropriate view
        if ($user->role === 'admin') {
            return view('dashboard.admin.profile.edit', [
                'user' => $user,
            ]);
        } else {
            // For members, use the member profile view in the new location
            return view('member.profile.edit', [
                'user' => $user,
            ]);
        }
    }

    /**
     * Show the form for creating a new user profile
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('dashboard.admin.profile.create');
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
            ->with('status', 'User profile created successfully.');
    }

    /**
     * Update the user's profile
     *
     * @param  \App\Http\Requests\Admin\UpdateProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProfileRequest $request)
    {
        $user = User::find(Auth::id());
        $validated = $request->validated();

        // Track what was updated
        $updatedPassword = false;

        // Update basic info
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old profile photo if exists
            if ($user->profile_photo) {
                Storage::delete($user->profile_photo);
            }

            // Store the new image
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo = $path;
        }

        // Update password if provided
        if ($request->filled('password')) {
            // Verify that the current password matches before allowing the change
            if (!Hash::check($validated['current_password'], $user->password)) {
                return back()
                    ->withErrors(['current_password' => 'The provided current password does not match your actual password.'])
                    ->withInput();
            }

            $user->password = Hash::make($validated['password']);
            $updatedPassword = true;
        }

        $user->save();

        // Show appropriate success message
        $message = $updatedPassword
            ? 'Password updated successfully.'
            : 'Profile updated successfully.';

        // Redirect based on user role
        if ($user->role === 'admin') {
            return redirect()->route('admin.profile.edit')->with('status', $message);
        } else {
            return redirect()->route('member.profile.edit')->with('status', $message);
        }
    }
}
