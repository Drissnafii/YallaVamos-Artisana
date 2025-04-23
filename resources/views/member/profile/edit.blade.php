@extends('layouts.member')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Hero profile header - Material Design inspired with yellow theme -->
    <div class="rounded-lg overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-12 sm:px-10 relative">
            <!-- Background image overlay - Default or user uploaded -->
            @if($user->background_image)
                <img src="{{ Storage::url($user->background_image) }}" alt="Profile Background" class="absolute inset-0 object-cover w-full h-full">
                <div class="absolute inset-0 backdrop-blur-sm bg-amber-500/20"></div>
            @else
                <img src="{{ asset('images/world-cup-pattern.png') }}" alt="World Cup Pattern" class="absolute inset-0 object-cover mix-blend-overlay opacity-20 w-full h-full">
            @endif

            <!-- Background image upload button -->
            <label for="background_image" class="absolute top-3 right-3 p-2 bg-black bg-opacity-50 rounded-full text-white cursor-pointer hover:bg-opacity-70 transition-all duration-200 z-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="sr-only">Change background</span>
            </label>

            <div class="flex flex-col sm:flex-row items-start sm:items-end gap-6 relative z-10">
                <!-- Profile image with Material-style elevation -->
                <div class="relative group">
                    <div class="w-32 h-32 sm:w-40 sm:h-40 rounded-full bg-white overflow-hidden shadow-lg transition-transform hover:scale-105">
                        <img
                            id="profile_photo_preview"
                            src="{{ $user->profile_photo ? Storage::url($user->profile_photo) : 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80' }}"
                            alt="{{ $user->name }}"
                            class="w-full h-full object-cover"
                        >
                    </div>
                    <label for="profile_photo" class="absolute inset-0 flex items-center justify-center rounded-full bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-all duration-200 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        <span class="sr-only">Choose photo</span>
                    </label>
                </div>

                <!-- Profile name - Spotify inspired typography -->
                <div class="flex-1 ml-0 sm:ml-4 text-white">
                    <h4 class="text-sm font-medium uppercase tracking-wider drop-shadow-md">Profile</h4>
                    <h1 class="text-4xl sm:text-5xl font-bold mt-1 tracking-tight drop-shadow-lg">{{ $user->name }}</h1>
                    <div class="flex items-center mt-2">
                        <div class="text-sm drop-shadow-md">{{ $user->email }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status message - Enhanced Material Design toast with animation -->
    @if (session('status'))
        <div id="status-alert" class="mb-6 rounded-lg bg-green-100 border-l-4 border-green-500 p-4 transition-all duration-500 ease-in-out shadow-md">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-base font-medium text-green-800">{{ session('status') }}</p>
                </div>
                <div class="ml-auto pl-3">
                    <div class="-mx-1.5 -my-1.5">
                        <button type="button" onclick="document.getElementById('status-alert').remove()" class="inline-flex rounded-md p-1.5 text-green-500 hover:bg-green-200 focus:outline-none">
                            <span class="sr-only">Dismiss</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Profile edit form -->
    <form method="POST" action="{{ route('member.profile.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Hidden file inputs -->
        <input type="file" id="profile_photo" name="profile_photo" class="hidden" accept="image/*">
        <input type="file" id="background_image" name="background_image" class="hidden" accept="image/*">

        <!-- Card style from Google Material Design with Spotify-inspired spacing -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100">
                <h3 class="text-lg font-medium text-gray-900">Profile Information</h3>
                <p class="mt-1 text-sm text-gray-500">Update your account details</p>
            </div>

            <div class="px-6 py-6">
                <div class="grid grid-cols-1 gap-y-8">
                    <!-- Personal Information Section -->
                    <div>
                        <h4 class="font-medium text-gray-700 mb-4">Personal Information</h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name Input - Google Material style input -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                <div class="relative">
                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="{{ old('name', $user->name) }}"
                                        class="block w-full px-4 py-3 border-0 border-b-2 border-gray-300 focus:border-yellow-500 bg-gray-50 focus:outline-none focus:ring-0 transition-colors duration-200 ease-in-out rounded-t-lg @error('name') border-red-300 focus:border-red-500 @enderror"
                                        placeholder="Enter your full name"
                                    >
                                </div>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email Input - Google Material style input -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                <div class="relative">
                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        value="{{ old('email', $user->email) }}"
                                        class="block w-full px-4 py-3 border-0 border-b-2 border-gray-300 focus:border-yellow-500 bg-gray-50 focus:outline-none focus:ring-0 transition-colors duration-200 ease-in-out rounded-t-lg @error('email') border-red-300 focus:border-red-500 @enderror"
                                        placeholder="your.email@example.com"
                                    >
                                </div>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Password Section - Clean separation inspired by Spotify's sectioning -->
                    <div class="pt-4 border-t border-gray-100">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                            <h4 class="font-medium text-gray-700">Password</h4>
                            <span class="text-xs text-gray-500 mt-1 sm:mt-0">Leave blank if you don't want to change it</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Current Password Input -->
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                                <div class="relative">
                                    <input
                                        type="password"
                                        id="current_password"
                                        name="current_password"
                                        class="block w-full px-4 py-3 border-0 border-b-2 border-gray-300 focus:border-yellow-500 bg-gray-50 focus:outline-none focus:ring-0 transition-colors duration-200 ease-in-out rounded-t-lg @error('current_password') border-red-300 focus:border-red-500 @enderror"
                                        placeholder="••••••••"
                                    >
                                </div>
                                @error('current_password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- New Password Input -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                                <div class="relative">
                                    <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        class="block w-full px-4 py-3 border-0 border-b-2 border-gray-300 focus:border-yellow-500 bg-gray-50 focus:outline-none focus:ring-0 transition-colors duration-200 ease-in-out rounded-t-lg @error('password') border-red-300 focus:border-red-500 @enderror"
                                        placeholder="••••••••"
                                    >
                                </div>
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Minimum 8 characters</p>
                            </div>

                            <!-- Confirm Password Input -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                                <div class="relative">
                                    <input
                                        type="password"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        class="block w-full px-4 py-3 border-0 border-b-2 border-gray-300 focus:border-yellow-500 bg-gray-50 focus:outline-none focus:ring-0 transition-colors duration-200 ease-in-out rounded-t-lg"
                                        placeholder="••••••••"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form actions - Google Material style button with Spotify-inspired positioning -->
        <div class="flex justify-end">
            <button
                type="submit"
                class="flex items-center px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-all duration-200 ease-in-out transform hover:-translate-y-1 hover:shadow-lg"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Save changes
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle profile photo selection and preview
        const photoInput = document.getElementById('profile_photo');
        const photoPreview = document.getElementById('profile_photo_preview');

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

        // Handle background image selection and preview
        const backgroundInput = document.getElementById('background_image');
        const backgroundPreview = document.querySelector('.bg-gradient-to-r');

        if (backgroundInput && backgroundPreview) {
            backgroundInput.addEventListener('change', function(e) {
                if (e.target.files && e.target.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(event) {
                        backgroundPreview.style.backgroundImage = `url(${event.target.result})`;
                    }

                    reader.readAsDataURL(e.target.files[0]);
                }
            });
        }

        // Auto-dismiss status alert after 5 seconds
        const statusAlert = document.getElementById('status-alert');
        if (statusAlert) {
            setTimeout(function() {
                statusAlert.style.opacity = '0';
                setTimeout(function() {
                    statusAlert.remove();
                }, 500);
            }, 5000);
        }
    });
</script>
@endpush
@endsection
