@extends('layouts.app') {{-- Assuming your admin area uses the same base layout --}}
{{-- If you create a separate admin layout (e.g., layouts.admin), extend that instead --}}

@section('title', 'Admin Dashboard - Morocco 2030')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex">
        <!-- Sidebar -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64">
                {{-- Sidebar component --}}
                <div class="flex flex-col h-0 flex-1 bg-white border-r border-gray-200">
                    <div class="flex items-center h-16 flex-shrink-0 px-4 bg-primary">
                        <img class="h-8 w-auto" src="{{ asset('images/morocco-logo.svg') }}" alt="Morocco 2030">
                        <span class="ml-2 text-white font-medium">Admin Panel</span>
                    </div>
                    <div class="flex-1 flex flex-col overflow-y-auto">
                        {{-- Sidebar Navigation (Updated for Project) --}}
                        <nav class="flex-1 px-2 py-4 space-y-1">
                            <!-- Dashboard -->
                            {{-- Use route names once defined, e.g., route('admin.dashboard') --}}
                            <a href="{{ url('/admin') }}" class="{{ request()->is('admin') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                <svg class="text-gray-500 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Dashboard
                            </a>

                            <!-- Manage Cities -->
                            <a href="{{ url('/admin/cities') }}" class="{{ request()->is('admin/cities*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Host Cities
                            </a>

                             <!-- Manage Stadiums -->
                            <a href="{{ url('/admin/stadiums') }}" class="{{ request()->is('admin/stadiums*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 11.714L12 4.286l-7.428 7.428M6 14.571v5.715h12v-5.715M9.429 14.571v-2.857a2.571 2.571 0 115.142 0v2.857" /> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21.429c-5.714 0-10.286-4.571-10.286-10.286S6.286.857 12 .857s10.286 4.571 10.286 10.286c0 2.38-.821 4.578-2.207 6.286" />
                                </svg>
                                Stadiums
                            </a>

                            <!-- Manage Matches -->
                             <a href="{{ url('/admin/matches') }}" class="{{ request()->is('admin/matches*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Matches
                            </a>

                            <!-- Manage Articles/News -->
                            <a href="{{ url('/admin/articles') }}" class="{{ request()->is('admin/articles*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h6m-4 8H7" />
                                </svg>
                                Articles & News
                            </a>

                            <!-- Manage Accommodations -->
                            <a href="{{ url('/admin/accommodations') }}" class="{{ request()->is('admin/accommodations*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M5 10v11h14V10M9 21v-6a2 2 0 012-2h2a2 2 0 012 2v6" />
                                </svg>
                                Accommodations
                            </a>

                            {{-- Optional: Manage Users (If implemented according to specs) --}}
                            {{-- <a href="{{ url('/admin/users') }}" class="{{ request()->is('admin/users*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                Users
                            </a> --}}

                            {{-- Optional: Settings --}}
                            {{-- <a href="{{ url('/admin/settings') }}" class="{{ request()->is('admin/settings*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Settings
                            </a> --}}
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            {{-- Top Bar Component --}}
            <div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow">
                <button type="button" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary md:hidden" @click="sidebarOpen = true"> {{-- Alpine.js example for mobile toggle --}}
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </button>
                <div class="flex-1 px-4 flex justify-between">
                    <div class="flex-1 flex">
                        {{-- Search (Functionality to be implemented) --}}
                        <form class="w-full flex md:ml-0" action="#" method="GET">
                            <label for="search-field" class="sr-only">Search</label>
                            <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                                <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input id="search-field" class="block w-full h-full pl-8 pr-3 py-2 border-transparent text-gray-900 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-0 focus:border-transparent sm:text-sm" placeholder="Search content..." type="search">
                            </div>
                        </form>
                    </div>
                    <div class="ml-4 flex items-center md:ml-6">
                        {{-- Notifications (Functionality to be implemented) --}}
                        <button type="button" class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            <span class="sr-only">View notifications</span>
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>

                        <!-- Profile dropdown -->
                        <div class="ml-3 relative" x-data="{ open: false }">
                            <div>
                                <button @click="open = !open" type="button" class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    {{-- Replace with dynamic user avatar if available --}}
                                    <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                </button>
                            </div>
                            {{-- Dropdown menu --}}
                            <div x-show="open" @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                 role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
                                 style="display: none;"> {{-- style="display: none;" prevents flash of unstyled content --}}
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                                {{-- Add Logout Form/Link --}}
                                <form method="POST" action="{{ route('logout') }}"> {{-- Example Logout Route --}}
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-2">
                                        Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <main class="flex-1 relative overflow-y-auto focus:outline-none">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        <h1 class="text-2xl font-semibold text-gray-900">Admin Dashboard</h1>
                    </div>
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        <!-- Dashboard Content (Updated for Project) -->
                        <div class="py-4">
                            <!-- Stats cards -->
                            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4"> {{-- Added 4th column --}}
                                <!-- Card 1: Host Cities -->
                                <div class="bg-white overflow-hidden shadow rounded-lg">
                                    <div class="px-4 py-5 sm:p-6">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </div>
                                            <div class="ml-5 w-0 flex-1">
                                                <dl>
                                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                                        Total Host Cities
                                                    </dt>
                                                    <dd>
                                                        <div class="text-lg font-medium text-gray-900">
                                                            {{ $cityCount ?? '0' }} {{-- Replace with dynamic data --}}
                                                        </div>
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-4 sm:px-6">
                                        <div class="text-sm">
                                            <a href="{{ url('/admin/cities') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                                Manage Cities
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 2: Stadiums -->
                                <div class="bg-white overflow-hidden shadow rounded-lg">
                                    <div class="px-4 py-5 sm:p-6">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                                 <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 11.714L12 4.286l-7.428 7.428M6 14.571v5.715h12v-5.715M9.429 14.571v-2.857a2.571 2.571 0 115.142 0v2.857" /> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21.429c-5.714 0-10.286-4.571-10.286-10.286S6.286.857 12 .857s10.286 4.571 10.286 10.286c0 2.38-.821 4.578-2.207 6.286" />
                                                 </svg>
                                            </div>
                                            <div class="ml-5 w-0 flex-1">
                                                <dl>
                                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                                        Total Stadiums
                                                    </dt>
                                                    <dd>
                                                        <div class="text-lg font-medium text-gray-900">
                                                            {{ $stadiumCount ?? '0' }} {{-- Replace with dynamic data --}}
                                                        </div>
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-4 sm:px-6">
                                        <div class="text-sm">
                                            <a href="{{ url('/admin/stadiums') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                                Manage Stadiums
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 3: Matches Scheduled -->
                                <div class="bg-white overflow-hidden shadow rounded-lg">
                                    <div class="px-4 py-5 sm:p-6">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div class="ml-5 w-0 flex-1">
                                                <dl>
                                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                                        Matches Scheduled
                                                    </dt>
                                                    <dd>
                                                        <div class="text-lg font-medium text-gray-900">
                                                            {{ $matchCount ?? '0' }} {{-- Replace with dynamic data --}}
                                                        </div>
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-4 sm:px-6">
                                        <div class="text-sm">
                                            <a href="{{ url('/admin/matches') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                                Manage Matches
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 4: Articles Published -->
                                <div class="bg-white overflow-hidden shadow rounded-lg">
                                    <div class="px-4 py-5 sm:p-6">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3"> {{-- Changed color --}}
                                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h6m-4 8H7" />
                                                </svg>
                                            </div>
                                            <div class="ml-5 w-0 flex-1">
                                                <dl>
                                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                                        Articles Published
                                                    </dt>
                                                    <dd>
                                                        <div class="text-lg font-medium text-gray-900">
                                                             {{ $articleCount ?? '0' }} {{-- Replace with dynamic data --}}
                                                        </div>
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-4 sm:px-6">
                                        <div class="text-sm">
                                            <a href="{{ url('/admin/articles') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                                Manage Articles
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Recent Activity / Content Updates -->
                            <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2"> {{-- Example: 2 columns layout --}}

                                <!-- Recent Content Updates Table -->
                                <div class="bg-white shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">Recent Content Updates</h3>
                                        {{-- Optional: Link to a full activity log --}}
                                        {{-- <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View all</a> --}}
                                    </div>
                                    <ul class="divide-y divide-gray-200">
                                        {{-- Loop through recent items (e.g., $recentUpdates) --}}
                                        {{-- Example Item 1: New Article --}}
                                        <li>
                                            <a href="#" class="block hover:bg-gray-50"> {{-- Link to the item or edit page --}}
                                                <div class="px-4 py-4 sm:px-6">
                                                    <div class="flex items-center justify-between">
                                                        <p class="text-sm font-medium text-indigo-600 truncate">
                                                            New Article: "Marrakech Stadium Nears Completion"
                                                        </p>
                                                        <div class="ml-2 flex-shrink-0 flex">
                                                            <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                                Article
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-2 sm:flex sm:justify-between">
                                                        <div class="sm:flex items-center text-sm text-gray-500">
                                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                                            </svg>
                                                            <p>Admin User</p> {{-- Show who made the change --}}
                                                        </div>
                                                        <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                                            </svg>
                                                            <p>
                                                                Published <time datetime="2023-10-26">Oct 26, 2023</time> {{-- Show timestamp --}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        {{-- Example Item 2: City Update --}}
                                         <li>
                                            <a href="#" class="block hover:bg-gray-50">
                                                <div class="px-4 py-4 sm:px-6">
                                                    <div class="flex items-center justify-between">
                                                        <p class="text-sm font-medium text-indigo-600 truncate">
                                                            City Updated: Casablanca details revised
                                                        </p>
                                                        <div class="ml-2 flex-shrink-0 flex">
                                                            <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                                                City
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-2 sm:flex sm:justify-between">
                                                        <div class="sm:flex items-center text-sm text-gray-500">
                                                             <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                                            </svg>
                                                            <p>Another Admin</p>
                                                        </div>
                                                        <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                 <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                                             </svg>
                                                            <p>
                                                                Updated <time datetime="2023-10-25">Oct 25, 2023</time>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        {{-- Add more items here dynamically --}}
                                         @if(false) {{-- Replace false with check if $recentUpdates is empty --}}
                                         <li>
                                             <div class="px-4 py-4 sm:px-6 text-center text-gray-500">
                                                 No recent updates found.
                                             </div>
                                         </li>
                                         @endif
                                    </ul>
                                </div>

                                <!-- Quick Stats / Other Info -->
                                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                    <div class="px-4 py-5 sm:px-6">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">Quick Stats</h3>
                                        <p class="mt-1 max-w-2xl text-sm text-gray-500">Overview of site content.</p>
                                    </div>
                                    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                                        <dl class="sm:divide-y sm:divide-gray-200">
                                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">Total Accommodations Listed</dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $accommodationCount ?? '0' }}</dd>
                                            </div>
                                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">Registered Users (If applicable)</dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $userCount ?? 'N/A' }}</dd>
                                            </div>
                                             <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">Pending Items (Example)</dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $pendingCount ?? '0' }}</dd>
                                            </div>
                                            {{-- Add more relevant quick stats --}}
                                        </dl>
                                    </div>
                                </div>

                            </div>
                            <!-- End Dashboard Content -->
                        </div>
                    </div>
                </div>
            </main>

            {{-- Footer (Consider if needed in admin panel, maybe simpler) --}}
            <footer class="bg-white border-t border-gray-200">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <p class="text-center text-sm text-gray-500">
                       © {{ date('Y') }} Morocco 2030 Admin Panel. All rights reserved.
                    </p>
                </div>
            </footer>
        </div>
        <!-- End Main Content -->
    </div>
</div>

@endsection

@push('scripts')
{{-- Add Alpine.js if you haven't included it globally via Vite --}}
{{-- <script src="//unpkg.com/alpinejs" defer></script> --}}

{{-- Basic JS for profile dropdown (if not using Alpine) and mobile sidebar --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Profile dropdown toggle (Example without Alpine.js)
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = userMenuButton?.closest('.relative')?.querySelector('div[role="menu"]'); // Select the dropdown menu itself

        // Check if elements exist before adding listeners
        if (userMenuButton && userMenu) {
             // Initial setup if not using Alpine which handles this via x-show
            userMenu.style.display = 'none';
            userMenuButton.setAttribute('aria-expanded', 'false');

            userMenuButton.addEventListener('click', (event) => {
                const isExpanded = userMenuButton.getAttribute('aria-expanded') === 'true';
                userMenuButton.setAttribute('aria-expanded', !isExpanded);
                userMenu.style.display = isExpanded ? 'none' : 'block'; // Toggle display
                event.stopPropagation();
            });

            // Close dropdown if clicking outside (if not using Alpine's @click.away)
            document.addEventListener('click', (event) => {
                if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
                    if (userMenuButton.getAttribute('aria-expanded') === 'true') {
                         userMenuButton.setAttribute('aria-expanded', 'false');
                         userMenu.style.display = 'none';
                    }
                }
            });
        }

        // Mobile sidebar toggle (Requires more setup for overlay)
        const mobileMenuButton = document.querySelector('.md\\:hidden button[aria-label="Open sidebar"]');
        // You'll need to target the sidebar container and add/remove classes for visibility & overlay
        // Example using Alpine.js: Add x-data="{ sidebarOpen: false }" to the parent div (e.g., <div class="flex" x-data...> )
        // Then toggle `sidebarOpen` on button click (@click="sidebarOpen = true")
        // And bind sidebar visibility: <div class="hidden md:flex..." :class="{ 'fixed inset-0 flex z-40 md:hidden': sidebarOpen }">...
        // Add overlay: <div x-show="sidebarOpen" class="fixed inset-0 bg-gray-600 bg-opacity-75" @click="sidebarOpen = false"></div>
        // Add close button inside mobile sidebar: <button @click="sidebarOpen = false">...</button>

        if (mobileMenuButton) {
             mobileMenuButton.addEventListener('click', () => {
                 console.warn('Mobile sidebar toggle needs full implementation (overlay, class toggling, potentially using Alpine.js).');
                 // Example (won't work correctly without full setup):
                 // const sidebar = document.querySelector('.hidden.md\\:flex.md\\:flex-shrink-0');
                 // if (sidebar) sidebar.classList.toggle('hidden'); // Incorrect way for mobile overlay
             });
        }
    });
</script>
@endpush
