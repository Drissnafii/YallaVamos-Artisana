@extends('layouts.admin')

@section('content')
<div class="admin-dashboard-content">
  <div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center">
      <h1 class="text-xl font-semibold text-gray-900">Edit User</h1>
      <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Back to Users
      </a>
    </div>

    <div class="p-6">
      <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Name field -->
          <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <div class="relative rounded-md shadow-sm">
              <input type="text" name="name" id="name"
                class="focus:ring-primary focus:border-primary block w-full pl-3 pr-3 py-3 sm:text-sm border-gray-300 rounded-md"
                required value="{{ old('name', $user->name) }}">
            </div>
            @error('name')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Email field -->
          <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <div class="relative rounded-md shadow-sm">
              <input type="email" name="email" id="email"
                class="focus:ring-primary focus:border-primary block w-full pl-3 pr-3 py-3 sm:text-sm border-gray-300 rounded-md"
                required value="{{ old('email', $user->email) }}">
            </div>
            @error('email')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Password field -->
          <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
              Password <span class="text-gray-500 text-xs">(leave blank to keep current)</span>
            </label>
            <div class="relative rounded-md shadow-sm">
              <input type="password" name="password" id="password"
                class="focus:ring-primary focus:border-primary block w-full pl-3 pr-3 py-3 sm:text-sm border-gray-300 rounded-md">
            </div>
            @error('password')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <!-- Confirm Password field -->
          <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
            <div class="relative rounded-md shadow-sm">
              <input type="password" name="password_confirmation" id="password_confirmation"
                class="focus:ring-primary focus:border-primary block w-full pl-3 pr-3 py-3 sm:text-sm border-gray-300 rounded-md">
            </div>
          </div>
        </div>

        <!-- Role field -->
        <div class="mb-6 max-w-md">
          <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
          <div class="relative">
            <select name="role" id="role"
              class="focus:ring-primary focus:border-primary block w-full pl-3 pr-10 py-3 text-base border-gray-300 rounded-md appearance-none"
              required>
              <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
              <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
              <option value="member" {{ old('role', $user->role) == 'member' ? 'selected' : '' }}>Member</option>
            </select>
            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
              <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </div>
          </div>
          @error('role')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <!-- User profile info -->
        <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
          <div class="flex items-center">
            <div class="flex-shrink-0 h-12 w-12">
              @if($user->profile_photo)
              <img class="h-12 w-12 rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
              @else
              <div class="h-12 w-12 rounded-full bg-primary flex items-center justify-center text-white font-semibold text-lg">
                {{ strtoupper(substr($user->name, 0, 1)) }}{{ strtoupper(substr($user->name, strpos($user->name, ' ') + 1, 1)) }}
              </div>
              @endif
            </div>
            <div class="ml-4">
              <h2 class="text-sm font-medium text-gray-900">User Information</h2>
              <p class="text-sm text-gray-500">ID: {{ $user->id }}</p>
            </div>
          </div>
        </div>

        <!-- Form buttons -->
        <div class="flex items-center justify-end space-x-3 pt-5 border-t border-gray-200">
          <a href="{{ route('admin.users.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
            Cancel
          </a>
          <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
            Update User
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
