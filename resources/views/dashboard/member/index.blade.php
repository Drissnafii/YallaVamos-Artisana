@extends('layouts.member')

@section('title', 'Member Dashboard')

@section('content')
<div class="bg-[#FAF9F5] text-gray-800 min-h-screen pb-12">
    <!-- Hero Section with Background Image -->
    <div class="relative bg-gradient-to-r from-amber-500 to-amber-600 h-64 overflow-hidden">
        <div class="absolute inset-0 bg-pattern opacity-10"></div>
        <img src="{{ asset('images/world-cup-pattern.png') }}" alt="World Cup Pattern" class="absolute inset-0 object-cover mix-blend-overlay opacity-20 w-full h-full">
        <div class="absolute inset-0 bg-gradient-to-t from-[#FAF9F5] via-transparent to-transparent"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative h-full flex items-end pb-16">
            <div>
                <p class="text-white/80 text-sm font-medium mb-1">{{ now()->format('l, d F Y') }}</p>
                <h1 class="text-4xl font-bold text-white mb-2">Bonjour, {{ Auth::user()->name }}</h1>
                <p class="text-white/90">Bienvenue sur votre tableau de bord Coupe du Monde 2030</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20">
        <!-- Quick Stats Cards Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Favorites Card -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 -mr-8 -mt-8 bg-[#FFF7E1] rounded-full opacity-70 transition-transform duration-300 group-hover:scale-110"></div>
                <div class="relative">
                    <div class="flex items-center mb-4">
                        <div class="p-3 rounded-full bg-[#FFF7E1] mr-4 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Favoris</p>
                            <p class="text-3xl font-bold">{{ $favoriteCount ?? 0 }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-2 mb-4">
                        <div class="bg-[#FFF7E1] bg-opacity-50 p-2 rounded-lg text-center">
                            <p class="text-xs text-gray-600">Villes</p>
                            <p class="font-bold text-amber-600">{{ $favoriteCitiesCount ?? 0 }}</p>
                        </div>
                        <div class="bg-[#FFF7E1] bg-opacity-50 p-2 rounded-lg text-center">
                            <p class="text-xs text-gray-600">Stades</p>
                            <p class="font-bold text-amber-600">{{ $favoriteStadiumsCount ?? 0 }}</p>
                        </div>
                        <div class="bg-[#FFF7E1] bg-opacity-50 p-2 rounded-lg text-center">
                            <p class="text-xs text-gray-600">Matchs</p>
                            <p class="font-bold text-amber-600">{{ $favoriteMatchesCount ?? 0 }}</p>
                        </div>
                    </div>

                    <a href="{{ route('member.favorites.index') }}" class="inline-flex items-center text-sm font-medium text-amber-600 hover:text-amber-700">
                        Gérer vos favoris
                        <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Articles Card -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 -mr-8 -mt-8 bg-[#F2F1EC] rounded-full opacity-70 transition-transform duration-300 group-hover:scale-110"></div>
                <div class="relative">
                    <div class="flex items-center mb-4">
                        <div class="p-3 rounded-full bg-[#F2F1EC] mr-4 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Articles</p>
                            <p class="text-3xl font-bold">{{ $articleCount ?? 0 }}</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-xs text-gray-600">Articles publiés ce mois</span>
                            <span class="text-xs font-medium">{{ $monthlyArticleCount ?? 0 }}/5</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: {{ min(($monthlyArticleCount ?? 0) / 5 * 100, 100) }}%"></div>
                        </div>
                    </div>

                    <div class="flex space-x-3">
                        <a href="{{ route('member.articles.index') }}" class="inline-flex items-center text-sm font-medium text-green-600 hover:text-green-700">
                            Voir mes articles
                            <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <span class="text-gray-300">|</span>
                        <a href="{{ route('member.articles.create') }}" class="inline-flex items-center text-sm font-medium text-green-600 hover:text-green-700">
                            Créer
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Upcoming Matches Card -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 -mr-8 -mt-8 bg-[#F2F2F2] rounded-full opacity-70 transition-transform duration-300 group-hover:scale-110"></div>
                <div class="relative">
                    <div class="flex items-center mb-4">
                        <div class="p-3 rounded-full bg-[#F2F2F2] mr-4 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Matchs à venir</p>
                            <p class="text-3xl font-bold">{{ $upcomingMatchCount ?? 0 }}</p>
                        </div>
                    </div>

                    @if(isset($nextMatch))
                    <div class="bg-[#F2F2F2] bg-opacity-60 p-3 rounded-lg mb-4">
                        <div class="text-xs font-medium text-gray-500 mb-1">Prochain match</div>
                        <div class="flex items-center justify-between mb-1">
                            <div class="font-bold text-gray-800">{{ $nextMatch->team1 }} vs {{ $nextMatch->team2 }}</div>
                            <div class="text-xs font-medium text-blue-600 px-2 py-1 bg-blue-100 rounded-full">{{ $nextMatch->date->format('d M') }}</div>
                        </div>
                        <div class="text-xs text-gray-600">{{ $nextMatch->stadium->name }}, {{ $nextMatch->stadium->city->name }}</div>
                    </div>
                    @endif

                    <a href="{{ route('member.favorites.matches') }}" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700">
                        Voir tous les matchs
                        <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content Columns -->
        <div class="grid grid-cols-1 lg:grid-cols-7 gap-6">
            <!-- Left Column - Primary Content -->
            <div class="lg:col-span-5">
                <!-- Quick Actions -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 mb-6">
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Actions rapides</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <!-- Create Article -->
                        <a href="{{ route('member.articles.create') }}" class="group bg-gradient-to-br from-green-50 to-green-100 hover:from-green-100 hover:to-green-200 transition-all duration-300 rounded-xl overflow-hidden border border-green-200 p-4 flex flex-col items-center justify-center text-center h-28">
                            <div class="rounded-full bg-white p-2 shadow-sm mb-2 group-hover:scale-110 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <span class="font-medium text-gray-800 text-sm">Créer un article</span>
                        </a>

                        <!-- Manage Favorites -->
                        <a href="{{ route('member.favorites.index') }}" class="group bg-gradient-to-br from-amber-50 to-amber-100 hover:from-amber-100 hover:to-amber-200 transition-all duration-300 rounded-xl overflow-hidden border border-amber-200 p-4 flex flex-col items-center justify-center text-center h-28">
                            <div class="rounded-full bg-white p-2 shadow-sm mb-2 group-hover:scale-110 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            </div>
                            <span class="font-medium text-gray-800 text-sm">Gérer les favoris</span>
                        </a>

                        <!-- Edit Profile -->
                        <a href="{{ route('member.profile.edit') }}" class="group bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 transition-all duration-300 rounded-xl overflow-hidden border border-blue-200 p-4 flex flex-col items-center justify-center text-center h-28">
                            <div class="rounded-full bg-white p-2 shadow-sm mb-2 group-hover:scale-110 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <span class="font-medium text-gray-800 text-sm">Modifier profil</span>
                        </a>

                        <!-- Browse Matches -->
                        <a href="{{ route('matches.index') }}" class="group bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-100 hover:to-purple-200 transition-all duration-300 rounded-xl overflow-hidden border border-purple-200 p-4 flex flex-col items-center justify-center text-center h-28">
                            <div class="rounded-full bg-white p-2 shadow-sm mb-2 group-hover:scale-110 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span class="font-medium text-gray-800 text-sm">Explorer les matchs</span>
                        </a>
                    </div>
                </div>

                <!-- Upcoming Matches Section -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold text-gray-800">Matchs à venir</h2>
                        <a href="{{ route('matches.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center">
                            Voir tous
                            <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
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
                            <div class="bg-white rounded-lg overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition-all cursor-pointer relative group flex"
                                 onclick="window.location.href='{{ route('matches.show', $match) }}'">
                                <div class="w-1.5 {{ in_array($match->id, $favoriteMatchIds ?? []) ? 'bg-amber-500' : 'bg-gray-200 group-hover:bg-amber-200' }}"></div>
                                <div class="p-4 flex-grow">
                                    <div class="flex justify-between mb-2">
                                        <div class="flex items-center">
                                            <span class="w-8 h-8 flex items-center justify-center rounded-full {{ $loop->index % 2 == 0 ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }} font-bold text-sm mr-3">{{ $loop->index + 1 }}</span>
                                            <div>
                                                <div class="text-xs font-medium text-gray-500">{{ $match->date->format('d M Y') }} - {{ $match->time }}</div>
                                                <div class="font-bold">{{ $match->team1 }} vs {{ $match->team2 }}</div>
                                            </div>
                                        </div>
                                        <div class="flex flex-col items-end">
                                            <div class="text-xs mb-1 px-2 py-1 {{ $match->date->isPast() ? 'bg-gray-100 text-gray-800' : 'bg-blue-100 text-blue-800' }} rounded-full">
                                                {{ $match->date->isPast() ? 'Terminé' : 'À venir' }}
                                            </div>
                                            <div class="text-sm">{{ $match->stadium->name }}</div>
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-center text-xs text-gray-500">
                                        <div>{{ $match->stadium->city->name }}</div>
                                        <div class="flex items-center {{ in_array($match->id, $favoriteMatchIds ?? []) ? 'text-amber-500' : 'text-gray-400' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="{{ in_array($match->id, $favoriteMatchIds ?? []) ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            {{ in_array($match->id, $favoriteMatchIds ?? []) ? 'Dans vos favoris' : 'Ajouter aux favoris' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-[#F2F1EC] rounded-lg p-5 text-center">
                            <p class="text-gray-600">Aucun match à venir dans vos favoris.</p>
                            <a href="{{ route('matches.index') }}" class="inline-block mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition">Parcourir les matchs</a>
                        </div>
                    @endif
                </div>

                <!-- Recently Added Articles -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold text-gray-800">Articles récents</h2>
                        <a href="{{ route('articles.index') }}" class="text-sm font-medium text-green-600 hover:text-green-700 flex items-center">
                            Voir tous
                            <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>

                    @if(isset($recentArticles) && count($recentArticles) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($recentArticles as $article)
                            <a href="{{ route('articles.show', $article) }}" class="flex bg-white rounded-lg overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                                <div class="w-1/3 bg-gray-200 relative">
                                    @if($article->image)
                                        <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-green-100 text-green-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="w-2/3 p-4">
                                    <div class="flex justify-between items-start mb-1">
                                        <h3 class="font-bold text-gray-800 line-clamp-1">{{ $article->title }}</h3>
                                        <span class="ml-2 bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full whitespace-nowrap">
                                            {{ $article->created_at->diffForHumans() }}
                                        </span>
                                    </div>

                                    <p class="text-sm text-gray-600 line-clamp-2 mb-2">{{ Str::limit($article->content, 80) }}</p>

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
                        <p class="text-gray-600">Aucun article récent.</p>
                        <a href="{{ route('member.articles.create') }}" class="inline-block mt-2 px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition">Créer un article</a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Column - Secondary Content -->
        <div class="lg:col-span-2">
            <!-- User Profile Card -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 mb-6">
                <div class="flex flex-col items-center text-center">
                    <div class="relative mb-4">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" class="w-20 h-20 rounded-full object-cover">
                        @else
                            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-xl font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="absolute bottom-0 right-0 bg-green-500 w-5 h-5 rounded-full border-2 border-white"></div>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-1">{{ Auth::user()->name }}</h3>
                    <p class="text-sm text-gray-500 mb-3">{{ Auth::user()->email }}</p>

                    <div class="flex space-x-2 mb-4">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                            Membre
                        </span>
                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">
                            Depuis {{ Auth::user()->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <a href="{{ route('member.profile.edit') }}" class="w-full px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        Modifier le profil
                    </a>
                </div>
            </div>

            <!-- Official News -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 mb-6">
                <h3 class="font-bold text-gray-800 mb-4">Actualités officielles</h3>

                <div class="space-y-4">
                    @foreach($officialNews ?? [] as $news)
                    <div class="border-b border-gray-100 pb-4 last:border-0 last:pb-0">
                        <span class="text-xs font-medium text-blue-600 mb-1 block">
                            @if(isset($news) && is_object($news) && isset($news->created_at))
                                {{ $news->created_at->format('d M Y') }}
                            @else
                                -
                            @endif
                        </span>
                        <h4 class="text-sm font-bold text-gray-800 mb-1">{{ $news->title }}</h4>
                        <p class="text-xs text-gray-600 mb-2 line-clamp-2">{{ Str::limit($news->content, 100) }}</p>
                        <a href="{{ route('news.show', $news) }}" class="text-xs font-medium text-blue-600 hover:text-blue-700">Lire la suite</a>
                    </div>
                    @endforeach

                    @if(empty($officialNews))
                    <div class="text-center py-4">
                        <p class="text-gray-500 text-sm">Aucune actualité disponible.</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- World Cup Countdown -->
            <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl p-6 shadow-sm text-white relative overflow-hidden mb-6">
                <div class="absolute inset-0 bg-pattern opacity-10"></div>

                <h3 class="font-bold mb-4 relative">Compte à rebours</h3>

                <div class="relative">
                    <div class="text-2xl font-bold mb-2" id="countdown">
                        {{ $daysToWorldCup ?? '365' }} jours
                    </div>
                    <p class="text-white/80 text-sm mb-3">avant la Coupe du Monde 2030</p>

                    <div class="w-full bg-white/20 rounded-full h-2 mb-4">
                        <div class="bg-white h-2 rounded-full" style="width: {{ 100 - min(($daysToWorldCup ?? 365) / 365 * 100, 100) }}%"></div>
                    </div>

                    <a href="{{ route('cities.index') }}" class="inline-block px-4 py-2 bg-white text-amber-600 rounded-lg text-sm font-medium hover:bg-gray-100 transition">
                        Découvrir les villes hôtes
                    </a>
                </div>
            </div>

            <!-- World Cup Cities Preview -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-gray-800">Villes hôtes</h3>
                    <a href="{{ route('cities.index') }}" class="text-sm font-medium text-amber-600 hover:text-amber-700 flex items-center">
                        Voir toutes
                        <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
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
                                <div class="w-full h-full flex items-center justify-center bg-amber-100 text-
                        </div>
                        <div class="flex-grow">
                            <h4 class="font-bold text-gray-800 text-sm">{{ $city->name }}</h4>
                            <p class="text-xs text-gray-500">{{ $city->stadiums_count ?? 0 }} stades</p>
                        </div>
                        <div class="flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
</div>

<!-- Initialize JS for the page -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add subtle hover effects to cards
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

    // Add any other necessary JavaScript for enhancing the dashboard
});
</script>
@endsection
