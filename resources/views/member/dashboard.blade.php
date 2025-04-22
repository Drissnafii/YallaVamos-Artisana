@extends('layouts.member')

@section('title', 'Member Dashboard')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-2">Welcome, {{ Auth::user()->name }}!</h1>
    <p class="text-gray-600">Access your personalized Morocco 2030 World Cup experience.</p>
</div>

<!-- Quick Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-md p-5 flex items-center justify-between">
        <div>
            <h2 class="text-sm font-medium text-gray-500">Favorite Matches</h2>
            <p class="text-2xl font-semibold text-gray-800 mt-1">{{ isset($favoriteMatches) ? $favoriteMatches->count() : 0 }}</p>
        </div>
        <div class="h-12 w-12 bg-primary/10 rounded-full flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5" />
            </svg>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-md p-5 flex items-center justify-between">
        <div>
            <h2 class="text-sm font-medium text-gray-500">Favorite Cities</h2>
            <p class="text-2xl font-semibold text-gray-800 mt-1">{{ isset($favoriteCities) ? $favoriteCities->count() : 0 }}</p>
        </div>
        <div class="h-12 w-12 bg-blue-50 rounded-full flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-md p-5 flex items-center justify-between">
        <div>
            <h2 class="text-sm font-medium text-gray-500">Favorite Stadiums</h2>
            <p class="text-2xl font-semibold text-gray-800 mt-1">{{ isset($favoriteStadiums) ? $favoriteStadiums->count() : 0 }}</p>
        </div>
        <div class="h-12 w-12 bg-green-50 rounded-full flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-md p-5 flex items-center justify-between">
        <div>
            <h2 class="text-sm font-medium text-gray-500">My Articles</h2>
            <p class="text-2xl font-semibold text-gray-800 mt-1">{{ isset($userArticles) ? $userArticles->count() : 0 }}</p>
        </div>
        <div class="h-12 w-12 bg-purple-50 rounded-full flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
            </svg>
        </div>
    </div>
</div>

<!-- Upcoming Matches -->
<div class="mb-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Upcoming Matches</h2>
        <a href="{{ route('member.matches.index') }}" class="text-primary hover:text-primary/80 transition-colors text-sm font-medium">View All</a>
    </div>
    
    @if(isset($upcomingMatches) && $upcomingMatches->count() > 0)
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="divide-y divide-gray-200">
            @foreach($upcomingMatches->take(3) as $match)
            <div class="p-4 hover:bg-gray-50 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="flex flex-col md:flex-row items-center md:space-x-6 w-full">
                        <!-- Match Date -->
                        <div class="text-center mb-3 md:mb-0 md:w-24">
                            <div class="text-sm font-medium text-gray-500">{{ \Carbon\Carbon::parse($match->date)->format('M d') }}</div>
                            <div class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($match->date)->format('H:i') }}</div>
                        </div>
                        
                        <!-- Teams -->
                        <div class="flex flex-1 items-center justify-center space-x-3">
                            <!-- Team 1 -->
                            <div class="flex flex-col items-center w-24">
                                <div class="w-10 h-10 bg-gray-200 rounded-full overflow-hidden mb-1">
                                    @if($match->team1 && $match->team1->logo_path)
                                    <img src="{{ asset('storage/' . $match->team1->logo_path) }}" alt="{{ $match->team1->name }} logo" class="w-full h-full object-cover">
                                    @else
                                    <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                                        <span class="text-xs text-gray-500">No logo</span>
                                    </div>
                                    @endif
                                </div>
                                <span class="text-sm font-medium text-gray-800 text-center">{{ $match->team1 ? $match->team1->name : 'TBD' }}</span>
                            </div>

                            <!-- vs -->
                            <div class="text-gray-500 font-medium">vs</div>

                            <!-- Team 2 -->
                            <div class="flex flex-col items-center w-24">
                                <div class="w-10 h-10 bg-gray-200 rounded-full overflow-hidden mb-1">
                                    @if($match->team2 && $match->team2->logo_path)
                                    <img src="{{ asset('storage/' . $match->team2->logo_path) }}" alt="{{ $match->team2->name }} logo" class="w-full h-full object-cover">
                                    @else
                                    <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                                        <span class="text-xs text-gray-500">No logo</span>
                                    </div>
                                    @endif
                                </div>
                                <span class="text-sm font-medium text-gray-800 text-center">{{ $match->team2 ? $match->team2->name : 'TBD' }}</span>
                            </div>
                        </div>
                        
                        <!-- Stadium and City -->
                        <div class="md:w-48 text-center md:text-right">
                            <p class="text-sm font-medium text-gray-800">{{ $match->stadium ? $match->stadium->name : 'TBD' }}</p>
                            <p class="text-xs text-gray-500">{{ $match->stadium && $match->stadium->city ? $match->stadium->city->name : '-' }}</p>
                        </div>
                    </div>
                    
                    <div class="ml-4">
                        <a href="{{ route('member.matches.show', $match) }}" class="text-primary hover:text-primary/80">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="bg-gray-50 rounded-lg p-6 text-center border border-gray-200">
        <p class="text-gray-600">No upcoming matches at this time.</p>
    </div>
    @endif
</div>

<!-- Quick Access Grid -->
<div class="mb-8">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Quick Access</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- My Travel Plans -->
        <a href="{{ route('member.travel.index') }}" class="bg-white rounded-lg shadow-md p-5 hover:shadow-lg transition-shadow flex items-center">
            <div class="h-12 w-12 bg-yellow-50 rounded-full flex items-center justify-center mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800">Travel Plans</h3>
                <p class="text-sm text-gray-600">Plan your World Cup journey</p>
            </div>
        </a>
        
        <!-- My Favorites -->
        <a href="{{ route('member.favorites.index') }}" class="bg-white rounded-lg shadow-md p-5 hover:shadow-lg transition-shadow flex items-center">
            <div class="h-12 w-12 bg-red-50 rounded-full flex items-center justify-center mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800">My Favorites</h3>
                <p class="text-sm text-gray-600">Access your saved content</p>
            </div>
        </a>
        
        <!-- My Articles -->
        <a href="{{ route('member.articles.index') }}" class="bg-white rounded-lg shadow-md p-5 hover:shadow-lg transition-shadow flex items-center">
            <div class="h-12 w-12 bg-purple-50 rounded-full flex items-center justify-center mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800">My Articles</h3>
                <p class="text-sm text-gray-600">Create and manage content</p>
            </div>
        </a>
    </div>
</div>

<!-- Member Sections -->
<div class="mb-8">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Explore More</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Cities Section -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="h-32 bg-gray-200 relative">
                <img src="{{ asset('images/host-cities.jpg') }}" alt="Host Cities" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <h3 class="absolute bottom-3 left-4 text-white text-lg font-semibold">Host Cities</h3>
            </div>
            <div class="p-4">
                <p class="text-gray-600 text-sm mb-4">Explore the beautiful cities hosting the 2030 World Cup in Morocco.</p>
                <a href="{{ route('member.cities.index') }}" class="text-primary hover:text-primary/80 transition-colors font-medium text-sm">
                    View All Cities →
                </a>
            </div>
        </div>
        
        <!-- Stadiums Section -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="h-32 bg-gray-200 relative">
                <img src="{{ asset('images/stadiums.jpg') }}" alt="Stadiums" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <h3 class="absolute bottom-3 left-4 text-white text-lg font-semibold">Stadiums</h3>
            </div>
            <div class="p-4">
                <p class="text-gray-600 text-sm mb-4">Discover the world-class stadiums where the matches will take place.</p>
                <a href="{{ route('member.stadiums.index') }}" class="text-primary hover:text-primary/80 transition-colors font-medium text-sm">
                    View All Stadiums →
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Travel Tips -->
<div class="bg-blue-50 border border-blue-100 rounded-lg p-5">
    <div class="flex items-start">
        <div class="mr-4">
            <div class="h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        <div>
            <h2 class="text-xl font-semibold text-blue-800 mb-2">Travel Tips</h2>
            <p class="text-blue-700 mb-4">Make the most of your World Cup experience with these member-exclusive travel tips.</p>
            <a href="{{ route('member.travel.tips') }}" class="inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                View Travel Tips
            </a>
        </div>
    </div>
</div>

@endsection