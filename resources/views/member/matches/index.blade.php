@extends('layouts.member')

@section('title', 'Match Schedule')

@section('content')
<!-- Header Section with iOS-inspired design -->
<div class="mb-12">
    <h1 class="text-3xl font-light tracking-tight text-gray-900 mb-3">Match Schedule</h1>
    <p class="text-lg text-gray-500 font-light">View all scheduled matches for the Morocco 2030 World Cup</p>
</div>

<!-- Filters Section with iOS-style controls -->
<div class="bg-white rounded-2xl shadow-sm p-8 mb-10">
    <h2 class="text-xl font-medium text-gray-900 mb-6">Filter Matches</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div>
            <label for="stadium-filter" class="block text-sm font-medium text-gray-700 mb-2">Stadium</label>
            <select id="stadium-filter" class="w-full py-3 px-4 rounded-xl border-gray-200 bg-gray-50 text-gray-800 shadow-sm focus:border-[#E9272E] focus:ring focus:ring-[#E9272E]/10 transition-all">
                <option value="">All Stadiums</option>
                <!-- Stadium options would be populated here -->
            </select>
        </div>
        <div>
            <label for="city-filter" class="block text-sm font-medium text-gray-700 mb-2">City</label>
            <select id="city-filter" class="w-full py-3 px-4 rounded-xl border-gray-200 bg-gray-50 text-gray-800 shadow-sm focus:border-[#E9272E] focus:ring focus:ring-[#E9272E]/10 transition-all">
                <option value="">All Cities</option>
                <!-- City options would be populated here -->
            </select>
        </div>
        <div>
            <label for="team-filter" class="block text-sm font-medium text-gray-700 mb-2">Team</label>
            <select id="team-filter" class="w-full py-3 px-4 rounded-xl border-gray-200 bg-gray-50 text-gray-800 shadow-sm focus:border-[#E9272E] focus:ring focus:ring-[#E9272E]/10 transition-all">
                <option value="">All Teams</option>
                <!-- Team options would be populated here -->
            </select>
        </div>
        <div>
            <label for="date-filter" class="block text-sm font-medium text-gray-700 mb-2">Date Range</label>
            <select id="date-filter" class="w-full py-3 px-4 rounded-xl border-gray-200 bg-gray-50 text-gray-800 shadow-sm focus:border-[#E9272E] focus:ring focus:ring-[#E9272E]/10 transition-all">
                <option value="">All Dates</option>
                <option value="group">Group Stage</option>
                <option value="knockout">Knockout Stage</option>
                <option value="finals">Finals</option>
            </select>
        </div>
    </div>
</div>

<!-- Match Listing with iOS-inspired cards -->
<div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-12">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <h2 class="text-xl font-medium text-gray-900">All Matches</h2>
        <button class="px-4 py-2 bg-gray-100 text-gray-800 rounded-full text-sm font-medium transition-all hover:bg-gray-200 flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
            </svg>
            More Filters
        </button>
    </div>
    <div class="divide-y divide-gray-100">
        @forelse($matches as $match)
        <div class="p-6 hover:bg-gray-50 transition-all">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <!-- Match Date in iOS-style pill -->
                <div class="text-center bg-gray-100 rounded-full px-4 py-2 md:w-28">
                    <div class="text-sm font-medium text-gray-700">{{ $match->date->format('M d') }}</div>
                    <div class="text-xs text-gray-500">{{ $match->date->format('H:i') }}</div>
                </div>

                <!-- Teams with modern layout -->
                <div class="flex-1 flex items-center justify-center">
                    <div class="flex items-center justify-between gap-4 max-w-md w-full">
                        <!-- Team 1 -->
                        <div class="flex flex-col items-center w-24">
                            <div class="w-12 h-12 bg-gray-200 rounded-full overflow-hidden shadow-sm mb-2">
                                @if($match->team1 && $match->team1->flag)
                                <img src="{{ asset('storage/' . $match->team1->flag) }}" alt="{{ $match->team1->name }} logo" class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                    <span class="text-xs text-gray-400">TBD</span>
                                </div>
                                @endif
                            </div>
                            <span class="text-sm font-medium text-gray-800 text-center">{{ $match->team1 ? $match->team1->name : 'TBD' }}</span>
                        </div>

                        <!-- Score in iOS-style card -->
                        <div class="flex flex-col items-center">
                            <div class="flex items-center justify-center bg-white border border-gray-200 rounded-xl shadow-sm px-4 py-2 w-24">
                                <span class="text-lg font-medium text-gray-800">
                                    {{ $match->score_team1 !== null ? $match->score_team1 : '-' }}
                                    <span class="mx-1 text-gray-300">:</span>
                                    {{ $match->score_team2 !== null ? $match->score_team2 : '-' }}
                                </span>
                            </div>
                            <span class="text-xs text-gray-500 mt-2">{{ $match->status ?? 'Scheduled' }}</span>
                        </div>

                        <!-- Team 2 -->
                        <div class="flex flex-col items-center w-24">
                            <div class="w-12 h-12 bg-gray-200 rounded-full overflow-hidden shadow-sm mb-2">
                                @if($match->team2 && $match->team2->flag)
                                <img src="{{ asset('storage/' . $match->team2->flag) }}" alt="{{ $match->team2->name }} logo" class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                    <span class="text-xs text-gray-400">TBD</span>
                                </div>
                                @endif
                            </div>
                            <span class="text-sm font-medium text-gray-800 text-center">{{ $match->team2 ? $match->team2->name : 'TBD' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Stadium and City with modern layout -->
                <div class="md:w-48 text-center md:text-right">
                    <p class="text-sm font-medium text-gray-800">{{ $match->stadium ? $match->stadium->name : 'TBD' }}</p>
                    <p class="text-xs text-gray-500">{{ $match->stadium && $match->stadium->city ? $match->stadium->city->name : '-' }}</p>
                </div>

                <!-- Action buttons with iOS style -->
                <div class="flex items-center gap-3">
                    <!-- Favorite Button -->
                    <button
                        class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 transition-all favorite-btn"
                        data-match-id="{{ $match->id }}"
                        data-is-favorite="{{ in_array($match->id, $favoriteMatches) ? 'true' : 'false' }}"
                        onclick="toggleFavorite({{ $match->id }})"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ in_array($match->id, $favoriteMatches) ? 'text-[#E9272E]' : 'text-gray-400' }}" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Details Link -->
                    <a href="{{ route('member.matches.show', $match) }}" class="px-5 py-2 rounded-full bg-[#E9272E] text-white text-sm font-medium transition-all hover:bg-[#C71F25]">
                        Details
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="p-10 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <p class="text-gray-500 font-light text-lg">No matches available at this time.</p>
            <p class="text-gray-400 text-sm mt-2">Please check back later or adjust your filters.</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Member Exclusive Section with iOS design -->
<div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-8">
    <div class="bg-gradient-to-r from-[#E9272E]/10 to-[#E9272E]/5 p-8">
        <h2 class="text-2xl font-light text-gray-900 mb-4">Member Benefits</h2>
        <p class="text-gray-600 mb-8">As a member, you have access to these exclusive match features:</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-md transition-all">
                <div class="w-12 h-12 bg-[#E9272E]/10 rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#E9272E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Personalized Alerts</h3>
                <p class="text-gray-600 text-sm">Get notified about your favorite matches and teams with customizable alerts</p>
            </div>
            <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-md transition-all">
                <div class="w-12 h-12 bg-[#E9272E]/10 rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#E9272E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Match Predictions</h3>
                <p class="text-gray-600 text-sm">Participate in prediction contests with other members and win exclusive prizes</p>
            </div>
            <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-md transition-all">
                <div class="w-12 h-12 bg-[#E9272E]/10 rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#E9272E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Transportation Info</h3>
                <p class="text-gray-600 text-sm">Access special transportation options to match venues with exclusive member discounts</p>
            </div>
        </div>
    </div>
</div>

<!-- Calendar View Option -->
<div class="text-center mb-16">
    <a href="#" class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-800 rounded-full text-sm font-medium transition-all duration-300 hover:bg-gray-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
        </svg>
        View Calendar Format
    </a>
</div>
@endsection

@push('scripts')
<script>
    function toggleFavorite(matchId) {
        const button = document.querySelector(`.favorite-btn[data-match-id="${matchId}"]`);
        const icon = button.querySelector('svg');

        fetch(`/member/matches/${matchId}/toggle-favorite`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ match_id: matchId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'added') {
                button.setAttribute('data-is-favorite', 'true');
                icon.classList.remove('text-gray-400');
                icon.classList.add('text-[#E9272E]');
            } else {
                button.setAttribute('data-is-favorite', 'false');
                icon.classList.remove('text-[#E9272E]');
                icon.classList.add('text-gray-400');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // Filter functionality would be implemented here
    document.addEventListener('DOMContentLoaded', function() {
        const filters = document.querySelectorAll('select[id$="-filter"]');
        filters.forEach(filter => {
            filter.addEventListener('change', function() {
                // This would filter the matches based on the selected options
                // For now, just log the filter change
                console.log('Filter changed:', this.id, this.value);
            });
        });
    });
</script>
@endpush
