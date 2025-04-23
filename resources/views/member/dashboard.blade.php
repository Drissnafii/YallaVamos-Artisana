@extends('layouts.member')

@section('title', 'Member Dashboard')

@section('full-width-content')
<!-- Hero Section with Background Image -->
<div class="relative bg-gradient-to-r from-gray-800 to-gray-900 h-80 overflow-hidden w-full">
    <div class="absolute inset-0 bg-pattern opacity-10"></div>
    @if(Auth::user()->background_image)
        <img src="{{ Storage::url(Auth::user()->background_image) }}" alt="Profile Background" class="absolute inset-0 object-cover w-full h-full">
        <div class="absolute inset-0 backdrop-blur-sm bg-gray-900/40"></div>
    @else
        <img src="{{ asset('images/world-cup-pattern.png') }}" alt="World Cup Pattern" class="absolute inset-0 object-cover mix-blend-overlay opacity-20 w-full h-full">
    @endif
    <div class="absolute inset-0 w-screen bg-gradient-to-t from-[#FAF9F5] via-transparent to-transparent"></div>

    <!-- Full-width greeting div -->
    <div class="w-full h-full flex items-end z-10 relative">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8" style="padding-left: 120px; padding-bottom: 150px; padding-top: 60px;">
            <p class="text-white/90 text-sm font-medium mb-1 drop-shadow-md">{{ now()->format('l, d F Y') }}</p>
            <h1 class="text-4xl font-bold text-white mb-2 drop-shadow-lg">Bonjour, {{ Auth::user()->name }}</h1>
            <p class="text-white/90 drop-shadow-md">Bienvenue sur votre tableau de bord Coupe du Monde 2030</p>
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Main Content -->
</div> <!-- Closing the container div from the hero section -->

<!-- Quick Actions - Simplified container with gradient blur effects -->
<div class="relative z-30 mt-20">
    <!-- Top gradient blur -->
    <div class="absolute inset-x-0 top-0 h-8 bg-gradient-to-b from-red-400/30 via-red-500/40 to-transparent" style="filter: blur(0.5rem);"></div>
    
    <!-- Content container -->
    <div class="relative z-10 grid grid-cols-2 sm:grid-cols-4 gap-5 py-2 w-[calc(100%-2rem)] max-w-5xl mx-auto">
        <!-- Create Article - Green -->
        <a href="http://127.0.0.1:8000/member/articles/create" class="group relative flex items-center justify-center h-24" title="Créer un article">
            <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-green-100 rounded-full transform transition-all duration-300 group-hover:scale-110"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-green-100 to-green-200 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <!-- Label that appears on hover -->
            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 bg-green-600 text-white text-xs font-medium px-3 py-1 rounded-full whitespace-nowrap opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-10 transition-all duration-300 shadow-md">
                Créer un article
            </div>
            <div class="relative z-10 h-16 w-16 rounded-full bg-white shadow-md flex items-center justify-center group-hover:shadow-lg transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
        </a>

        <!-- Manage Favorites - Amber -->
        <a href="http://127.0.0.1:8000/member/favorites" class="group relative flex items-center justify-center h-24" title="Gérer les favoris">
            <div class="absolute inset-0 bg-gradient-to-br from-amber-50 to-amber-100 rounded-full transform transition-all duration-300 group-hover:scale-110"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-amber-100 to-amber-200 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <!-- Label that appears on hover -->
            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 bg-amber-500 text-white text-xs font-medium px-3 py-1 rounded-full whitespace-nowrap opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-10 transition-all duration-300 shadow-md">
                Gérer les favoris
            </div>
            <div class="relative z-10 h-16 w-16 rounded-full bg-white shadow-md flex items-center justify-center group-hover:shadow-lg transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                </svg>
            </div>
        </a>

        <!-- Edit Profile - Blue -->
        <a href="http://127.0.0.1:8000/member/profile" class="group relative flex items-center justify-center h-24" title="Modifier profil">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-blue-100 rounded-full transform transition-all duration-300 group-hover:scale-110"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <!-- Label that appears on hover -->
            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 bg-blue-600 text-white text-xs font-medium px-3 py-1 rounded-full whitespace-nowrap opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-10 transition-all duration-300 shadow-md">
                Modifier profil
            </div>
            <div class="relative z-10 h-16 w-16 rounded-full bg-white shadow-md flex items-center justify-center group-hover:shadow-lg transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
        </a>

        <!-- Browse Matches - Purple -->
        <a href="http://127.0.0.1:8000/member/matches" class="group relative flex items-center justify-center h-24" title="Match Schedule">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-50 to-purple-100 rounded-full transform transition-all duration-300 group-hover:scale-110"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-purple-100 to-purple-200 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <!-- Label that appears on hover -->
            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 bg-purple-600 text-white text-xs font-medium px-3 py-1 rounded-full whitespace-nowrap opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-10 transition-all duration-300 shadow-md">
                Match Schedule
            </div>
            <div class="relative z-10 h-16 w-16 rounded-full bg-white shadow-md flex items-center justify-center group-hover:shadow-lg transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-purple-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polygon points="10 8 16 12 10 16 10 8"></polygon>
                </svg>
            </div>
        </a>
    </div>

    <!-- Bottom gradient blur -->
    <div class="absolute inset-x-0 bottom-0 h-8 bg-gradient-to-t from-red-400/30 via-red-500/40 to-transparent" style="filter: blur(0.5rem);"></div>
</div>

<!-- Add padding to the bottom of your content to make room for the fixed quick actions -->
<div class="pb-24">
    <!-- This padding should be approximately the height of your quick actions bar -->
</div>

<div class="max-w-7xl mx-auto"> <!-- Re-opening the container div for the rest of the content -->
    <!-- Quick Stats Cards Row - Styled with yellow and mauve colors -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Favorites Card -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 relative overflow-hidden group">
            <!-- Enhanced background effect -->
            <div class="absolute top-0 right-0 w-40 h-40 -mr-12 -mt-12 bg-amber-100/30 rounded-full opacity-70 transition-all duration-500 group-hover:bg-amber-200/60 group-hover:scale-125"></div>

            <div class="relative">
                <!-- Improved header section with better spacing -->
                <div class="flex items-center mb-5">
                    <div class="p-3 rounded-full bg-amber-50 mr-4 shadow-sm group-hover:bg-amber-100 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Favoris</p>
                        <p class="text-3xl font-bold text-gray-800">0</p>
                    </div>
                </div>

                <!-- Enhanced stat cards with hover effects -->
                <div class="grid grid-cols-3 gap-3 mb-5">
                    <div class="bg-gray-50 p-2.5 rounded-lg text-center hover:bg-amber-50 transition-colors duration-300">
                        <p class="text-xs text-gray-600 mb-1">Villes</p>
                        <p class="font-bold text-gray-800 text-lg">0</p>
                    </div>
                    <div class="bg-gray-50 p-2.5 rounded-lg text-center hover:bg-amber-50 transition-colors duration-300">
                        <p class="text-xs text-gray-600 mb-1">Stades</p>
                        <p class="font-bold text-gray-800 text-lg">0</p>
                    </div>
                    <div class="bg-gray-50 p-2.5 rounded-lg text-center hover:bg-amber-50 transition-colors duration-300">
                        <p class="text-xs text-gray-600 mb-1">Matchs</p>
                        <p class="font-bold text-gray-800 text-lg">0</p>
                    </div>
                </div>

                <!-- Improved action button -->
                <a href="http://127.0.0.1:8000/member/favorites" class="inline-flex items-center px-4 py-2 bg-amber-50 text-amber-700 rounded-lg hover:bg-amber-100 transition-colors duration-300 font-medium text-sm">
                    Gérer vos favoris
                    <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Articles Card -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 relative overflow-hidden group">
            <!-- Enhanced background effect -->
            <div class="absolute top-0 right-0 w-40 h-40 -mr-12 -mt-12 bg-green-100/30 rounded-full opacity-70 transition-all duration-500 group-hover:bg-green-200/60 group-hover:scale-125"></div>

            <div class="relative">
                <!-- Improved header section -->
                <div class="flex items-center mb-5">
                    <div class="p-3 rounded-full bg-green-50 mr-4 shadow-sm group-hover:bg-green-100 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Articles</p>
                        <p class="text-3xl font-bold text-gray-800">0</p>
                    </div>
                </div>

                <!-- Enhanced progress indicator -->
                <div class="mb-5 bg-green-50 p-3 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-600 font-medium">Articles publiés ce mois</span>
                        <span class="text-sm font-bold text-green-700 bg-green-100 px-2 py-0.5 rounded-md">0/5</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-green-600 h-2.5 rounded-full" style="width: 0%; transition: width 1.5s ease-in-out;"></div>
                    </div>
                </div>

                <!-- Improved action buttons -->
                <div class="flex space-x-3">
                    <a href="http://127.0.0.1:8000/member/articles" class="flex-1 flex justify-center items-center px-3 py-2 bg-gray-50 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors duration-300 text-sm font-medium">
                        Voir mes articles
                        <svg class="ml-1.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a href="http://127.0.0.1:8000/member/articles/create" class="flex-1 flex justify-center items-center px-3 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors duration-300 text-sm font-medium">
                        Créer
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Upcoming Matches Card -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 relative overflow-hidden group">
            <!-- Enhanced background effect -->
            <div class="absolute top-0 right-0 w-40 h-40 -mr-12 -mt-12 bg-purple-100/30 rounded-full opacity-70 transition-all duration-500 group-hover:bg-purple-200/60 group-hover:scale-125"></div>

            <div class="relative">
                <!-- Improved header section -->
                <div class="flex items-center mb-5">
                    <div class="p-3 rounded-full bg-purple-50 mr-4 shadow-sm group-hover:bg-purple-100 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Matchs à venir</p>
                        <p class="text-3xl font-bold text-gray-800">0</p>
                    </div>
                </div>

                <!-- No matches message -->
                <div class="bg-gray-50 p-4 rounded-lg mb-5 text-center">
                    <p class="text-gray-600">Aucun match à venir dans votre calendrier</p>
                </div>

                <!-- Improved action button -->
                <a href="http://127.0.0.1:8000/member/favorites/matches" class="w-full flex justify-center items-center px-4 py-2.5 bg-purple-50 text-purple-700 rounded-lg hover:bg-purple-100 transition-colors duration-300 font-medium text-sm">
                    Voir tous les matchs
                    <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content Columns - Spotify-inspired two-column layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Left Column - Primary Content (9/12) -->
        <div class="lg:col-span-9 space-y-6">
            <!-- Upcoming Matches Section - With enhanced card design -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
                <div class="flex justify-between items-center mb-5">
                    <h2 class="text-xl font-bold text-gray-800">Matchs à venir</h2>
                    <a href="{{ route('member.matches.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center">
                        View All Matches
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>

                <div class="mb-4">
                    <div class="bg-[#F2F1EC] bg-opacity-50 px-3 py-2 rounded-lg text-sm font-medium text-gray-600 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Cliquez sur un match pour l'ajouter à vos favoris
                    </div>
                </div>

                @if(isset($upcomingMatches) && count($upcomingMatches) > 0)
                    <div class="space-y-3">
                        @foreach($upcomingMatches as $match)
                        <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition-all cursor-pointer relative group flex">
                            <div class="w-1.5 {{ in_array($match->id, $favoriteMatchIds ?? []) ? 'bg-amber-500' : 'bg-gray-200 group-hover:bg-amber-200' }}"></div>
                            <div class="p-4 flex-grow" onclick="window.location.href='{{ route('member.matches.show', $match) }}'">
                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2">
                                    <div class="flex items-center">
                                        <span class="w-10 h-10 flex items-center justify-center rounded-full {{ $loop->index % 2 == 0 ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }} font-bold text-sm mr-3 flex-shrink-0">{{ $loop->index + 1 }}</span>
                                        <div>
                                            <div class="text-xs font-medium text-gray-500">{{ $match->date->format('d M Y') }} - {{ $match->time }}</div>
                                            <div class="font-bold text-base">{{ $match->team1->name }} vs {{ $match->team2->name }}</div>
                                        </div>
                                    </div>
                                    <div class="flex flex-row sm:flex-col items-start sm:items-end">
                                        <div class="text-xs mb-1 px-2 py-1 {{ $match->date->isPast() ? 'bg-gray-100 text-gray-800' : 'bg-blue-100 text-blue-800' }} rounded-full">
                                            {{ $match->date->isPast() ? 'Terminé' : 'À venir' }}
                                        </div>
                                        <div class="text-sm ml-2 sm:ml-0">{{ $match->stadium->name }}</div>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center text-xs text-gray-500 mt-2">
                                    <div>{{ $match->stadium->city->name }}</div>
                                    <div class="favorite-toggle flex items-center {{ in_array($match->id, $favoriteMatchIds ?? []) ? 'text-amber-500' : 'text-gray-400 group-hover:text-amber-400' }} transition-colors"
                                         onclick="event.stopPropagation(); toggleFavorite({{ $match->id }}, this, {{ in_array($match->id, $favoriteMatchIds ?? []) ? 'true' : 'false' }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 favorite-icon" fill="{{ in_array($match->id, $favoriteMatchIds ?? []) ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                        </svg>
                                        <span class="favorite-text">{{ in_array($match->id, $favoriteMatchIds ?? []) ? 'Dans vos favoris' : 'Ajouter aux favoris' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-[#F2F1EC] rounded-lg p-5 text-center">
                        <p class="text-gray-600 mb-3">Aucun match à venir dans vos favoris.</p>
                        <a href="{{ route('matches.index') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition">Parcourir les matchs</a>
                    </div>
                @endif
            </div>

            <!-- Recently Added Articles - With enhanced card design -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
                <div class="flex justify-between items-center mb-5">
                    <h2 class="text-xl font-bold text-gray-800">Articles récents</h2>
                    <a href="{{ route('articles.index') }}" class="text-sm font-medium text-green-600 hover:text-green-700 flex items-center">
                        Voir tous
                        <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>

                @if(isset($recentArticles) && count($recentArticles) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($recentArticles as $article)
                        <a href="{{ route('articles.show', $article) }}" class="flex flex-col sm:flex-row bg-white rounded-lg overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 h-full group">
                            <div class="w-full sm:w-1/3 h-32 sm:h-auto bg-gray-200 relative overflow-hidden">
                                @if($article->image)
                                    <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-green-100 text-green-500 group-hover:bg-green-200 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="w-full sm:w-2/3 p-4 flex flex-col">
                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-1 mb-1">
                                    <h3 class="font-bold text-gray-800 line-clamp-1 group-hover:text-green-700 transition-colors">{{ $article->title }}</h3>
                                    <span class="sm:ml-2 inline-block bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full whitespace-nowrap">
                                        {{ $article->created_at->diffForHumans() }}
                                    </span>
                                </div>

                                <p class="text-sm text-gray-600 line-clamp-2 mb-2 flex-grow">{{ Str::limit($article->content, 80) }}</p>

                                <div class="flex items-center text-xs text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ $article->user->name }}

                                    @if($article->user_id == Auth::id())
                                    <span class="ml-2 px-1.5 py-0.5 bg-gray-100 text-gray-600 rounded text-xs">Vous</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>

                    @if(count($recentArticles) > 6)
                    <div class="text-center mt-6">
                        <a href="{{ route('articles.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition">
                            Voir plus d'articles
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </a>
                    </div>
                    @endif
                @else
                    <div class="bg-[#F2F1EC] rounded-lg p-5 text-center">
                        <p class="text-gray-600 mb-3">Aucun article récent.</p>
                        <a href="{{ route('member.articles.create') }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition">Créer un article</a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Column - Secondary Content (3/12) -->
        <div class="lg:col-span-3 space-y-6">
            <!-- User Profile Card - Spotify-style clean profile -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
                <div class="flex flex-col items-center text-center">
                    <div class="relative mb-4">
                        @if(Auth::user()->avatar)
                            <div class="w-20 h-20 rounded-full overflow-hidden ring-2 ring-amber-500 p-0.5">
                                <img src="{{ asset(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" class="w-full h-full rounded-full object-cover">
                            </div>
                        @else
                            <div class="w-20 h-20 rounded-full overflow-hidden ring-2 ring-amber-500 p-0.5">
                                <img src="{{ Auth::user()->profile_photo_url ?? asset('images/default-avatar.png') }}" alt="{{ Auth::user()->name }}" class="w-full h-full rounded-full object-cover">
                            </div>
                        @endif
                        <div class="absolute bottom-0 right-0 bg-green-500 w-5 h-5 rounded-full border-2 border-white"></div>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-1">{{ Auth::user()->name }}</h3>
                    <p class="text-sm text-gray-500 mb-3">{{ Auth::user()->email }}</p>

                    <div class="flex flex-wrap justify-center gap-2 mb-4">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                            Membre
                        </span>
                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">
                            Depuis {{ Auth::user()->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <a href="{{ route('member.profile.edit') }}" class="w-full px-4 py-2 bg-amber-500 text-white rounded-lg text-sm font-medium hover:bg-amber-600 transition flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        Modifier le profil
                    </a>
                </div>
            </div>

            <!-- World Cup Countdown - More visually appealing -->
            <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl p-6 shadow-sm text-white relative overflow-hidden group hover:shadow-md transition-all duration-300">
                <div class="absolute inset-0 bg-pattern opacity-10 group-hover:opacity-20 transition-opacity"></div>

                <h3 class="font-bold mb-4 relative">Compte à rebours</h3>

                <div class="relative">
                    <div class="text-3xl font-bold mb-2" id="countdown">
                        {{ $daysToWorldCup ?? '365' }} <span class="text-white/80 text-xl">jours</span>
                    </div>
                    <p class="text-white/80 text-sm mb-4">avant la Coupe du Monde 2030</p>

                    <div class="w-full bg-white/20 rounded-full h-2 mb-4">
                        <div class="bg-white h-2 rounded-full transition-all duration-700" style="width: {{ 100 - min(($daysToWorldCup ?? 365) / 365 * 100, 100) }}%"></div>
                    </div>

                    <a href="{{ route('cities.index') }}" class="inline-block w-full px-4 py-2 bg-white text-amber-600 rounded-lg text-sm font-medium hover:bg-gray-100 transition text-center">
                        Découvrir les villes hôtes
                    </a>
                </div>
            </div>

            <!-- Official News - Spotify-style news list -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
                <h3 class="font-bold text-gray-800 mb-4">Actualités officielles</h3>

                <div class="space-y-4">
                    @foreach($officialNews ?? [] as $news)
                    <div class="border-b border-gray-100 pb-4 last:border-0 last:pb-0 hover:bg-gray-50 p-2 rounded-lg transition-colors">
                        <span class="text-xs font-medium text-blue-600 mb-1 block">
                            @if(isset($news) && is_object($news) && isset($news->created_at))
                                {{ $news->created_at->format('d M Y') }}
                            @else
                                -
                            @endif
                        </span>
                        <h4 class="text-sm font-bold text-gray-800 mb-1">{{ $news->title }}</h4>
                        <p class="text-xs text-gray-600 mb-2 line-clamp-2">{{ Str::limit($news->content, 100) }}</p>
                        <a href="{{ route('news.show', $news) }}" class="text-xs font-medium text-blue-600 hover:text-blue-700 flex items-center">
                            Lire la suite
                            <svg class="ml-1 h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                    @endforeach

                    @if(empty($officialNews))
                    <div class="text-center py-4">
                        <p class="text-gray-500 text-sm">Aucune actualité disponible.</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- World Cup Cities Preview - Spotify-style list with improved hover effects -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-gray-800">Villes hôtes</h3>
                    <a href="{{ route('cities.index') }}" class="text-sm font-medium text-amber-600 hover:text-amber-700 flex items-center">
                        Voir toutes
                        <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>

                <div class="space-y-3">
                    @foreach($cities ?? [] as $city)
                    <a href="{{ route('cities.show', $city) }}" class="group flex items-center p-2 rounded-lg hover:bg-amber-50 transition-colors">
                        <div class="w-12 h-12 rounded-lg overflow-hidden mr-3 flex-shrink-0">
                            @if(isset($city) && is_object($city) && isset($city->image))
                                <img src="{{ asset($city->image) }}" alt="{{ $city->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-amber-100 text-amber-500 group-hover:bg-amber-200 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-grow">
                            <h4 class="font-bold text-gray-800 text-sm group-hover:text-amber-700 transition-colors">{{ (is_object($city) && isset($city->name)) ? $city->name : '' }}</h4>
                            <p class="text-xs text-gray-500">{{ $city->stadiums_count ?? 0 }} stades</p>
                        </div>
                        <div class="flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-amber-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Initialize JS for the page -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add subtle hover effects to cards with animation
    const cards = document.querySelectorAll('.hover-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.classList.add('shadow-md');
            this.classList.remove('shadow-sm');
        });
        card.addEventListener('mouseleave', function() {
            this.classList.remove('shadow-md');
            this.classList.add('shadow-sm');
        });
    });

    // Update countdown in real-time if needed
    function updateCountdown() {
        const countdownElement = document.getElementById('countdown');
        if (countdownElement) {
            // This is where you would calculate the remaining time
            // For now, we'll just keep it static
        }
    }

    // Initial call and set interval if needed
    updateCountdown();
    // setInterval(updateCountdown, 86400000); // Update once per day

    // Add smooth scroll behavior
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Add animation to progress bars
    const progressBars = document.querySelectorAll('[style*="width"]');
    setTimeout(() => {
        progressBars.forEach(bar => {
            bar.style.transition = 'width 1s ease-in-out';
        });
    }, 200);

    // AJAX toggle favorite functionality
    window.toggleFavorite = function(matchId, element, isFavorite) {
        // Generate the correct URL with the match ID
        const url = '{{ url("member/matches") }}/' + matchId + '/toggle-favorite';

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            credentials: 'same-origin' // Include cookies for CSRF protection
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            // Make sure the element exists before accessing its properties
            if (!element) {
                console.error('Element is null or undefined');
                showNotification('Error: Could not find the favorite button element', 'error');
                return;
            }

            // Find the icon and text elements inside the provided element
            const icon = element.querySelector('.favorite-icon');
            const text = element.querySelector('.favorite-text');

            if (!icon || !text) {
                console.error('Could not find icon or text elements within the favorite button');
                showNotification('Error: Could not update the favorite button display', 'error');
                return;
            }

            if (data.status === 'added') {
                // Match was added to favorites
                element.classList.remove('text-gray-400');
                element.classList.add('text-amber-500');
                icon.setAttribute('fill', 'currentColor');
                text.textContent = 'Dans vos favoris';

                // Show success notification
                showNotification('Match ajouté aux favoris', 'success');

                // Update the color indicator on the left
                const parentElement = element.closest('.flex');
                if (parentElement) {
                    const colorBar = parentElement.querySelector('div:first-child');
                    if (colorBar) {
                        colorBar.classList.remove('bg-gray-200');
                        colorBar.classList.add('bg-amber-500');
                    }
                }
            } else {
                // Match was removed from favorites
                element.classList.remove('text-amber-500');
                element.classList.add('text-gray-400');
                icon.setAttribute('fill', 'none');
                text.textContent = 'Ajouter aux favoris';

                // Show notification
                showNotification('Match retiré des favoris', 'info');

                // Update the color indicator on the left
                const parentElement = element.closest('.flex');
                if (parentElement) {
                    const colorBar = parentElement.querySelector('div:first-child');
                    if (colorBar) {
                        colorBar.classList.remove('bg-amber-500');
                        colorBar.classList.add('bg-gray-200');
                    }
                }
            }

            // Toggle the onclick handler
            element.setAttribute('onclick', `event.stopPropagation(); toggleFavorite(${matchId}, this, ${data.status === 'added'})`);
        })
        .catch(error => {
            console.error('Error toggling favorite:', error);
            showNotification('Erreur lors de l\'ajout aux favoris: ' + error.message, 'error');
        });
    };

    // Notification system
    function showNotification(message, type = 'success') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `fixed bottom-4 right-4 z-50 px-4 py-2 rounded-lg shadow-lg flex items-center ${
            type === 'success' ? 'bg-green-500 text-white' :
            type === 'error' ? 'bg-red-500 text-white' :
            'bg-blue-500 text-white'
        }`;

        // Add icon based on type
        let iconSvg = '';
        if (type === 'success') {
            iconSvg = '<svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
        } else if (type === 'error') {
            iconSvg = '<svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>';
        } else {
            iconSvg = '<svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
        }

        notification.innerHTML = iconSvg + message;

        // Add to DOM
        document.body.appendChild(notification);

        // Add entrance animation
        notification.style.transition = 'all 0.5s ease-in-out';
        notification.style.transform = 'translateY(20px)';
        notification.style.opacity = '0';

        setTimeout(() => {
            notification.style.transform = 'translateY(0)';
            notification.style.opacity = '1';
        }, 10);

        // Remove after 3 seconds
        setTimeout(() => {
            notification.style.transform = 'translateY(20px)';
            notification.style.opacity = '0';

            // Remove from DOM after animation completes
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 500);
        }, 3000);
    }
});
</script>
@endsection
