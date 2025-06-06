@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Admin context header -->
    <div class="mb-4 flex items-center">
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-primary transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Users List
        </a>
    </div>

    <!-- User profile header -->
    <div class="rounded-lg overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-indigo-600 to-blue-600 px-6 py-12 sm:px-10 relative">
            <!-- Admin badge -->
            <div class="absolute top-4 right-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-400 text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Admin Editing
                </span>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-end gap-6">
                <!-- Profile image -->
                <div class="relative group">
                    <div class="w-32 h-32 sm:w-40 sm:h-40 rounded-full bg-gray-200 overflow-hidden shadow-lg">
                        <img
                            id="profile_photo_preview"
                            src="{{ $user->profile_photo ? Storage::url($user->profile_photo) : 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80' }}"
                            alt="{{ $user->name }}"
                            class="w-full h-full object-cover"
                        >
                    </div>
                    <label for="profile_photo" class="absolute inset-0 flex items-center justify-center rounded-full bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        <span class="sr-only">Choose photo</span>
                    </label>
                </div>

                <!-- Profile name with user ID -->
                <div class="flex-1 ml-0 sm:ml-4 text-white">
                    <div class="flex items-center">
                        <h4 class="text-sm font-medium opacity-90">User Account</h4>
                        <span class="ml-2 px-2 py-0.5 bg-white bg-opacity-20 rounded-md text-xs">
                            ID: {{ $user->id }}
                        </span>
                    </div>
                    <h1 class="text-4xl sm:text-6xl font-bold mt-1">{{ $user->name }}</h1>
                    <div class="flex items-center mt-2">
                        <div class="text-sm opacity-90">{{ $user->email }}</div>
                        <span class="ml-3 px-2 py-0.5 text-xs font-medium rounded-md
                            {{ $user->role == 'admin' ? 'bg-red-500' :
                               ($user->role == 'member' ? 'bg-green-500' : 'bg-blue-500') }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status message -->
    @if (session('status'))
        <div class="mb-6 rounded-md bg-green-50 p-4 transition-all duration-300 ease-in-out shadow-sm">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('status') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- User edit form -->
    <form method="POST" action="{{ route('admin.users.update', $user) }}" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <!-- Hidden file input for profile photo -->
        <input type="file" id="profile_photo" name="profile_photo" class="hidden" accept="image/*">

        <!-- Account Information Card -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Account Information</h3>
                    <p class="mt-1 text-sm text-gray-500">Basic user account details</p>
                </div>
                <div class="flex items-center">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Admin Edit
                    </span>
                </div>
            </div>

            <div class="px-6 py-8 space-y-6">
                <!-- Name Input -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 ease-in-out @error('name') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                            placeholder="Enter user's full name"
                        >
                    </div>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 ease-in-out @error('email') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                            placeholder="user.email@example.com"
                        >
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role Selection -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">User Role</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <select
                            id="role"
                            name="role"
                            class="block w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 ease-in-out appearance-none @error('role') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                        >
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator</option>
                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Regular User</option>
                            <option value="member" {{ old('role', $user->role) == 'member' ? 'selected' : '' }}>Member</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    @error('role')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Password Card -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Reset Password</h3>
                    <p class="mt-1 text-sm text-gray-500">Leave blank if you don't want to change it</p>
                </div>
                <div class="flex items-center">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                        Security
                    </span>
                </div>
            </div>

            <div class="px-6 py-8 space-y-6">
                <!-- New Password Input -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                               <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 ease-in-out @error('password') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                            placeholder="••••••••"
                        >
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Minimum 8 characters recommended</p>
                </div>

                <!-- Confirm Password Input -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 ease-in-out"
                            placeholder="••••••••"
                        >
                    </div>
                </div>
            </div>
        </div>

        <!-- Account Status Card (New) -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Account Status</h3>
                    <p class="mt-1 text-sm text-gray-500">Manage user account status</p>
                </div>
                <div class="flex items-center">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        Admin Controls
                    </span>
                </div>
            </div>

            <div class="px-6 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">Account Active</h4>
                        <p class="text-sm text-gray-500">Enable or disable user access</p>
                    </div>
                    <div class="relative inline-block w-12 align-middle select-none">
                        <input type="checkbox" name="is_active" id="is_active" class="sr-only" {{ $user->is_active ? 'checked' : '' }}>
                        <label for="is_active" class="block h-6 overflow-hidden bg-gray-300 rounded-full cursor-pointer">
                            <span class="block h-6 w-6 rounded-full bg-white transform transition-transform duration-200 ease-in-out {{ $user->is_active ? 'translate-x-6' : 'translate-x-0' }}"></span>
                        </label>
                    </div>
                </div>

                <!-- Last updated timestamp -->
                <div class="mt-6 pt-4 border-t border-gray-100">
                    <div class="flex items-center text-sm text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Last updated: {{ $user->updated_at->format('M d, Y') }} by Admin
                    </div>
                </div>
            </div>
        </div>

        <!-- Form actions -->
        <div class="flex justify-between items-center pt-4">
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                Cancel
            </a>

            <div class="flex space-x-3">
                <button
                    type="submit"
                    class="flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-md shadow-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 ease-in-out"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Update User
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle profile photo selection and preview
        const photoInput = document.getElementById('profile_photo');
        const photoPreview = document.getElementById('profile_photo_preview');
        const activeToggle = document.getElementById('is_active');

        if (photoInput && photoPreview) {
            photoInput.addEventListener('change', function(e) {
                if (e.target.files && e.target.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(event) {
                        photoPreview.src = event.target.result;
                    }

                    reader.readAsDataURL(e.target.files[0]);
                }
            });
        }

        // Toggle for active status
        if (activeToggle) {
            activeToggle.addEventListener('change', function() {
                const toggle = this.nextElementSibling.firstElementChild;
                if (this.checked) {
                    toggle.classList.remove('translate-x-0');
                    toggle.classList.add('translate-x-6');
                } else {
                    toggle.classList.remove('translate-x-6');
                    toggle.classList.add('translate-x-0');
                }
            });
        }
    });
</script>
@endpush
@endsection
