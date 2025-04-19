@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50 text-gray-800">
    <!-- Navbar -->
    <nav class="sticky top-0 z-10 bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <img class="h-8 w-auto" src="{{ asset('images/morocco-logo.svg') }}" alt="Morocco 2030">
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="hidden md:flex md:space-x-6">
                        <a href="{{ route('member.dashboard') }}" class="text-green-600 font-medium">
                            Dashboard
                        </a>
                        <a href="#" class="text-gray-600 hover:text-green-600 font-medium">
                            Applications
                        </a>
                        <a href="{{ route('member.my-articles.index') }}" class="text-gray-600 hover:text-green-600 font-medium">
                            My Articles
                        </a>
                        <a href="#" class="text-gray-600 hover:text-green-600 font-medium">
                            Documents
                        </a>
                        <a href="#" class="text-gray-600 hover:text-green-600 font-medium">
                            Support
                        </a>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button type="button" class="relative bg-gray-100 p-1 rounded-full text-gray-500 hover:text-gray-700">
                            <span class="sr-only">View notifications</span>
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="absolute top-0 right-0 h-4 w-4 rounded-full bg-green-500 flex items-center justify-center text-xs text-white">5</span>
                        </button>
                        <div>
                            <button type="button" class="flex items-center space-x-2 bg-gray-100 rounded-full py-1 pl-1 pr-3 hover:bg-gray-200">
                                <img class="h-7 w-7 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                <span class="text-sm font-medium text-gray-700">User</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Search Section -->
        <div class="mb-8 bg-white rounded-lg shadow-md p-4">
            <div class="flex flex-wrap space-x-2 mb-4 border-b">
                <button class="px-4 py-2 text-sm font-medium text-green-600 border-b-2 border-green-600">Tout rechercher</button>
                <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">Hôtels</button>
                <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">Activités</button>
                <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">Restaurants</button>
                <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">Documents</button>
            </div>
            <div class="relative">
                <form role="search" action="/search">
                    <input type="hidden" name="searchSessionId" value="{{ uniqid() }}.ssid">
                    <input type="hidden" name="searchNearby" value="false">
                    <div class="flex items-center w-full">
                        <div class="relative flex-grow flex items-center">
                            <button type="submit" class="absolute left-3 text-gray-500" title="Rechercher" aria-label="Rechercher">
                                <svg viewBox="0 0 24 24" width="24px" height="24px" aria-hidden="true">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.12 4.14a5.99 5.99 0 1 0 0 11.98 5.99 5.99 0 0 0 0-11.98m-7.49 5.99a7.49 7.49 0 1 1 13.299 4.728L21.37 20.3l-1.06 1.061-5.44-5.44A7.49 7.49 0 0 1 2.63 10.13"></path>
                                </svg>
                            </button>
                            <input type="search"
                                autocomplete="off"
                                autocorrect="off"
                                autocapitalize="none"
                                spellcheck="false"
                                required
                                name="q"
                                class="w-full pl-12 pr-3 py-3 border border-gray-300 rounded-l-md focus:ring-green-500 focus:border-green-500 text-gray-700"
                                placeholder="Des endroits à visiter, des activités, des hôtels…"
                                title="Rechercher"
                                role="searchbox"
                                aria-label="Rechercher"
                                aria-autocomplete="list"
                                value="">
                        </div>
                        <button class="px-4 py-3 bg-green-600 text-white font-medium rounded-r-md hover:bg-green-700 whitespace-nowrap" type="button">
                            <span class="text-sm">Recherche</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Recently Used -->
        <div class="mb-8">
            <h2 class="text-xl font-bold mb-4 text-gray-800">Recently Used</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Card 1 -->
                <a href="{{ route('member.my-articles.index') }}" class="group bg-white hover:shadow-md transition-all duration-300 rounded-md overflow-hidden border border-gray-200">
                    <div class="aspect-w-16 aspect-h-9 bg-gray-100 flex items-center justify-center p-4">
                        <svg class="h-12 w-12 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800">My Articles</h3>
                        <p class="text-sm text-gray-600">Manage your content</p>
                    </div>
                </a>

                <!-- Card 2 -->
                <a href="#" class="group bg-white hover:shadow-md transition-all duration-300 rounded-md overflow-hidden border border-gray-200">
                    <div class="aspect-w-16 aspect-h-9 bg-gray-100 flex items-center justify-center p-4">
                        <svg class="h-12 w-12 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800">Documents</h3>
                        <p class="text-sm text-gray-600">View your documents</p>
                    </div>
                </a>

                <!-- Card 3 -->
                <a href="#" class="group bg-white hover:shadow-md transition-all duration-300 rounded-md overflow-hidden border border-gray-200">
                    <div class="aspect-w-16 aspect-h-9 bg-gray-100 flex items-center justify-center p-4">
                        <svg class="h-12 w-12 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800">Appointments</h3>
                        <p class="text-sm text-gray-600">Manage your schedule</p>
                    </div>
                </a>

                <!-- Card 4 -->
                <a href="#" class="group bg-white hover:shadow-md transition-all duration-300 rounded-md overflow-hidden border border-gray-200">
                    <div class="aspect-w-16 aspect-h-9 bg-gray-100 flex items-center justify-center p-4">
                        <svg class="h-12 w-12 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800">Notifications</h3>
                        <p class="text-sm text-gray-600">5 unread messages</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Banner Section -->
        <div class="mb-8 rounded-lg overflow-hidden relative">
            <div class="relative overflow-hidden rounded-lg">
                <img src="https://images.unsplash.com/photo-1579033461380-adb47c3eb938?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Travel banner" class="w-full h-48 object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-green-600/80 to-transparent p-6 flex flex-col justify-center">
                    <span class="bg-gray-800 text-white px-2 py-1 rounded text-xs inline-block mb-2 w-fit">Généré par l'IA (VERSION BÊTA)</span>
                    <h3 class="text-white text-xl font-bold mb-1">Des vacances sur mesure</h3>
                    <p class="text-white text-sm mb-4 max-w-md">Profitez de recommandations adaptées à vos goûts avec l'IA de voyage.</p>
                    <button class="bg-white text-green-700 px-4 py-2 rounded shadow-sm hover:bg-gray-100 text-sm font-medium w-fit">
                        Commencer à créer un voyage avec l'IA
                    </button>
                </div>
            </div>
        </div>

        <!-- Status Cards Row -->
        <div class="mb-8">
            <h2 class="text-xl font-bold mb-4 text-gray-800">Your Activity</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Card 1 -->
                <div class="bg-white rounded-md p-6 shadow-sm border border-gray-200">
                    <div class="flex items-center mb-4">
                        <div class="bg-green-100 rounded-full p-3 mr-4">
                            <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Active Applications</h3>
                            <div class="text-2xl font-bold text-gray-800">3</div>
                        </div>
                    </div>
                    <a href="#" class="text-sm font-medium text-green-600 hover:text-green-700 flex items-center">
                        View all
                        <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-md p-6 shadow-sm border border-gray-200">
                    <div class="flex items-center mb-4">
                        <div class="bg-green-100 rounded-full p-3 mr-4">
                            <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Upcoming Appointments</h3>
                            <div class="text-2xl font-bold text-gray-800">2</div>
                        </div>
                    </div>
                    <a href="#" class="text-sm font-medium text-green-600 hover:text-green-700 flex items-center">
                        View all
                        <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-md p-6 shadow-sm border border-gray-200">
                    <div class="flex items-center mb-4">
                        <div class="bg-green-100 rounded-full p-3 mr-4">
                            <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Notifications</h3>
                            <div class="text-2xl font-bold text-gray-800">5</div>
                        </div>
                    </div>
                    <a href="#" class="text-sm font-medium text-green-600 hover:text-green-700 flex items-center">
                        View all
                        <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
@endsection
