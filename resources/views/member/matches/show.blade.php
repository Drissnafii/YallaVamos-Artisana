@extends('layouts.member')

@section('title', 'Match Details')

@section('content')
<div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <!-- Back Button with iOS styling -->
    <div class="mb-10">
        <a href="{{ route('member.matches.index') }}" class="inline-flex items-center text-[#E9272E] hover:text-[#C71F25] transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            <span class="text-sm font-medium">Back to Matches</span>
        </a>
    </div>

    <!-- Match Header Card with Apple-inspired design -->
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-12">
        <div class="p-8 md:p-12">
            <div class="flex flex-col md:flex-row justify-between items-center mb-10">
                <div class="flex items-center mb-6 md:mb-0">
                    <div class="px-4 py-2 {{ $match->date->isPast() ? 'bg-gray-100 text-gray-800' : 'bg-[#E9272E]/10 text-[#E9272E]' }} rounded-full text-xs font-medium mr-4">
                        {{ $match->date->isPast() ? 'Completed' : 'Upcoming' }}
                    </div>
                    <span class="text-sm text-gray-500 font-light">{{ $match->date->format('l, d F Y') }} • {{ $match->time }}</span>
                </div>

                <div>
                    <button id="favorite-toggle"
                        class="inline-flex items-center px-6 py-2 rounded-full {{ $isFavorite ? 'bg-[#E9272E] text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition-all duration-300"
                        onclick="toggleMatchFavorite()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="{{ $isFavorite ? 'currentColor' : 'none' }}" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.799-2.034c-.784-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span id="favorite-label" class="text-sm font-medium">{{ $isFavorite ? 'Remove from Favorites' : 'Add to Favorites' }}</span>
                    </button>
                </div>
            </div>

            <div class="flex flex-col items-center">
                <div class="w-full flex flex-col md:flex-row md:items-center md:justify-center gap-8 md:gap-24 mb-10">
                    <!-- Team 1 with iOS styling -->
                    <div class="flex-1 flex flex-col items-center text-center">
                        <div class="w-28 h-28 bg-gray-50 rounded-full flex items-center justify-center mb-4 overflow-hidden shadow-sm">
                            @if($match->team1->flag)
                                <img src="{{ asset('storage/' . $match->team1->flag) }}" alt="{{ $match->team1->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="text-3xl font-light text-gray-400">{{ substr($match->team1->code, 0, 3) }}</div>
                            @endif
                        </div>
                        <h3 class="text-2xl font-medium mb-2">{{ $match->team1->name }}</h3>
                        <span class="text-sm text-gray-500">{{ $match->team1->code }}</span>
                    </div>

                    <!-- Score with iOS styling -->
                    <div class="flex flex-col items-center py-6">
                        <div class="flex items-center bg-gray-50 rounded-2xl px-8 py-4 mb-3 shadow-sm">
                            @if($match->date->isPast() && isset($match->score_team1) && isset($match->score_team2))
                                <span class="text-4xl font-light">{{ $match->score_team1 }}</span>
                                <span class="text-xl mx-4 text-gray-300">-</span>
                                <span class="text-4xl font-light">{{ $match->score_team2 }}</span>
                            @else
                                <span class="text-2xl font-light text-gray-500">VS</span>
                            @endif
                        </div>
                        <span class="text-sm font-medium {{ $match->date->isPast() ? 'text-gray-500' : 'text-[#E9272E]' }}">
                            {{ $match->date->isPast() ? 'Final Score' : 'Match Scheduled' }}
                        </span>
                    </div>

                    <!-- Team 2 with iOS styling -->
                    <div class="flex-1 flex flex-col items-center text-center">
                        <div class="w-28 h-28 bg-gray-50 rounded-full flex items-center justify-center mb-4 overflow-hidden shadow-sm">
                            @if($match->team2->flag)
                                <img src="{{ asset('storage/' . $match->team2->flag) }}" alt="{{ $match->team2->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="text-3xl font-light text-gray-400">{{ substr($match->team2->code, 0, 3) }}</div>
                            @endif
                        </div>
                        <h3 class="text-2xl font-medium mb-2">{{ $match->team2->name }}</h3>
                        <span class="text-sm text-gray-500">{{ $match->team2->code }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stadium and City Information with iOS-style cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
        <!-- Stadium Information -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="p-8">
                <h3 class="text-xl font-medium mb-6 text-gray-900">Stadium Information</h3>

                <div class="flex items-start mb-8">
                    <div class="w-24 h-24 bg-gray-100 rounded-2xl mr-6 flex-shrink-0 overflow-hidden shadow-sm">
                        @if($match->stadium->image)
                            <img src="{{ asset('storage/' . $match->stadium->image) }}" alt="{{ $match->stadium->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-50 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h4 class="text-xl font-medium mb-2">{{ $match->stadium->name }}</h4>
                        <p class="text-gray-600 mb-2">{{ $match->stadium->city->name }}, Morocco</p>
                        <div class="inline-flex items-center px-3 py-1 bg-gray-100 rounded-full text-gray-600 text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Capacity: {{ number_format($match->stadium->capacity) }}
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <p class="text-gray-600 leading-relaxed">{{ $match->stadium->description }}</p>
                </div>

                <a href="{{ route('member.stadiums.show', $match->stadium) }}" class="inline-flex items-center px-6 py-2 bg-gray-100 text-gray-800 rounded-full text-sm font-medium transition-all hover:bg-gray-200">
                    View Stadium Details
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- City Information -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="p-8">
                <h3 class="text-xl font-medium mb-6 text-gray-900">Host City</h3>

                <div class="flex items-start mb-8">
                    <div class="w-24 h-24 bg-gray-100 rounded-2xl mr-6 flex-shrink-0 overflow-hidden shadow-sm">
                        @if($match->stadium->city->image)
                            <img src="{{ asset('storage/' . $match->stadium->city->image) }}" alt="{{ $match->stadium->city->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-50 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h4 class="text-xl font-medium mb-2">{{ $match->stadium->city->name }}</h4>
                        <p class="text-gray-600 mb-2">Morocco</p>
                        <div class="inline-flex items-center px-3 py-1 bg-gray-100 rounded-full text-gray-600 text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Population: {{ number_format($match->stadium->city->population ?? 0) }}
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <p class="text-gray-600 leading-relaxed">{{ Str::limit($match->stadium->city->description ?? 'No description available', 150) }}</p>
                </div>

                <a href="{{ route('member.cities.show', $match->stadium->city) }}" class="inline-flex items-center px-6 py-2 bg-[#E9272E] text-white rounded-full text-sm font-medium transition-all hover:bg-[#C71F25]">
                    Explore {{ $match->stadium->city->name }}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Nearby Accommodations with iOS-style cards -->
    @if(isset($nearbyAccommodations) && $nearbyAccommodations->count() > 0)
    <div class="mb-16">
        <h3 class="text-2xl font-light mb-8 text-gray-900">Nearby Accommodations</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($nearbyAccommodations->take(3) as $accommodation)
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-md transition-all">
                <div class="h-48 bg-gray-200 overflow-hidden">
                    @if($accommodation->image)
                        <img src="{{ asset('storage/' . $accommodation->image) }}" alt="{{ $accommodation->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <h4 class="text-lg font-medium text-gray-900">{{ $accommodation->name }}</h4>
                        <span class="bg-gray-100 text-gray-800 text-xs px-3 py-1 rounded-full">{{ $accommodation->type }}</span>
                    </div>
                    <p class="text-gray-500 text-sm mb-4">{{ $accommodation->address }}</p>
                    <div class="flex items-center text-sm text-gray-600 mb-6">
                        <div class="flex items-center mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-[#E9272E]" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.799-2.034c-.784-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span>{{ number_format($accommodation->rating ?? 0, 1) }}</span>
                        </div>

                        <div>
                            <span>{{ number_format($accommodation->price ?? 0) }} MAD/night</span>
                        </div>
                    </div>
                    <a href="#" class="inline-flex items-center px-5 py-2 rounded-full bg-gray-100 text-gray-800 text-sm font-medium transition-all hover:bg-gray-200">
                        View Details
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('member.travel.accommodations') }}" class="inline-flex items-center px-8 py-3 bg-[#E9272E] text-white rounded-full text-sm font-medium transition-all hover:bg-[#C71F25]">
                View All Accommodations
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>
    @endif

    <!-- Team Information with iOS-style cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
        <!-- Team 1 Information -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="p-8">
                <h3 class="text-xl font-medium mb-6 text-gray-900">{{ $match->team1->name }}</h3>

                <div class="flex items-start mb-8">
                    <div class="w-20 h-20 bg-gray-100 rounded-full mr-6 flex-shrink-0 overflow-hidden shadow-sm">
                        @if($match->team1->flag)
                            <img src="{{ asset('storage/' . $match->team1->flag) }}" alt="{{ $match->team1->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="text-2xl font-light text-gray-400">{{ substr($match->team1->code, 0, 3) }}</div>
                        @endif
                    </div>
                    <div>
                        <p class="text-gray-600 mb-3">{{ $match->team1->code }}</p>
                        <div class="flex items-center gap-2">
                            <span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">Group {{ $match->team1->group ?: 'N/A' }}</span>
                            @if($match->team1->is_qualified)
                                <span class="px-3 py-1 bg-[#E9272E]/10 text-[#E9272E] text-xs rounded-full">Qualified</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div>
                    <p class="text-gray-600 leading-relaxed">{{ $match->team1->description ?? 'No team description available.' }}</p>
                </div>
            </div>
        </div>

        <!-- Team 2 Information -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="p-8">
                <h3 class="text-xl font-medium mb-6 text-gray-900">{{ $match->team2->name }}</h3>

                <div class="flex items-start mb-8">
                    <div class="w-20 h-20 bg-gray-100 rounded-full mr-6 flex-shrink-0 overflow-hidden shadow-sm">
                        @if($match->team2->flag)
                            <img src="{{ asset('storage/' . $match->team2->flag) }}" alt="{{ $match->team2->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="text-2xl font-light text-gray-400">{{ substr($match->team2->code, 0, 3) }}</div>
                        @endif
                    </div>
                    <div>
                        <p class="text-gray-600 mb-3">{{ $match->team2->code }}</p>
                        <div class="flex items-center gap-2">
                            <span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">Group {{ $match->team2->group ?: 'N/A' }}</span>
                            @if($match->team2->is_qualified)
                                <span class="px-3 py-1 bg-[#E9272E]/10 text-[#E9272E] text-xs rounded-full">Qualified</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div>
                    <p class="text-gray-600 leading-relaxed">{{ $match->team2->description ?? 'No team description available.' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Share Options -->
    <div class="text-center mt-16">
        <p class="text-sm text-gray-500 mb-4">Share this match</p>
        <div class="flex justify-center gap-4">
            <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook">
                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                </svg>
            </a>
            <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-twitter">
                    <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/>
                </svg>
            </a>
            <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram">
                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                    <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
                </svg>
            </a>
            <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-share-2">
                    <circle cx="18" cy="5" r="3"></circle>
                    <circle cx="6" cy="12" r="3"></circle>
                    <circle cx="18" cy="19" r="3"></circle>
                    <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                    <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                </svg>
            </a>
        </div>
    </div>
</div>

<script>
    function toggleMatchFavorite() {
        const matchId = {{ $match->id }};
        const url = '{{ url("member/matches") }}/' + matchId + '/toggle-favorite';
        const favoriteButton = document.getElementById('favorite-toggle');
        const favoriteLabel = document.getElementById('favorite-label');
        const starIcon = favoriteButton.querySelector('svg');

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            credentials: 'same-origin'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'added') {
                // Match was added to favorites
                favoriteButton.classList.remove('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
                favoriteButton.classList.add('bg-[#E9272E]', 'text-white');
                starIcon.setAttribute('fill', 'currentColor');
                favoriteLabel.textContent = 'Remove from Favorites';

                // Show toast notification
                showNotification('Match added to favorites', 'success');
            } else {
                // Match was removed from favorites
                favoriteButton.classList.remove('bg-[#E9272E]', 'text-white');
                favoriteButton.classList.add('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
                starIcon.setAttribute('fill', 'none');
                favoriteLabel.textContent = 'Add to Favorites';

                // Show toast notification
                showNotification('Match removed from favorites', 'info');
            }
        })
        .catch(error => {
            console.error('Error toggling favorite:', error);
            showNotification('Error updating favorites: ' + error.message, 'error');
        });
    }

    function showNotification(message, type = 'success') {
        // Create notification element with iOS-style design
        const notification = document.createElement('div');
        notification.className = `fixed bottom-4 right-4 z-50 px-6 py-3 rounded-2xl shadow-lg flex items-center ${
            type === 'success' ? 'bg-[#E9272E] text-white' :
            type === 'error' ? 'bg-red-500 text-white' :
            'bg-gray-800 text-white'
        }`;

        // Add icon based on type
        let iconSvg = '';
        if (type === 'success') {
            iconSvg = '<svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
        } else if (type === 'error') {
            iconSvg = '<svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>';
        } else {
            iconSvg = '<svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
        }

        notification.innerHTML = iconSvg + '<span class="text-sm font-medium">' + message + '</span>';

        // Add to DOM
        document.body.appendChild(notification);

        // Add entrance animation
        notification.style.transition = 'all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
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
            }, 400);
        }, 3000);
    }
</script>
@endsection
