@extends('layouts.member')

@section('title', 'Match Schedule')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-2">World Cup Match Schedule</h1>
    <p class="text-gray-600">Explore all scheduled matches for the Morocco 2030 World Cup with enhanced member features.</p>
</div>

<!-- Filters Section -->
<div class="bg-white rounded-lg shadow-md p-5 mb-6">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Filter Matches</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label for="stadium-filter" class="block text-sm font-medium text-gray-700 mb-1">Stadium</label>
            <select id="stadium-filter" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20">
                <option value="">All Stadiums</option>
                <!-- Stadium options would be populated here -->
            </select>
        </div>
        <div>
            <label for="city-filter" class="block text-sm font-medium text-gray-700 mb-1">City</label>
            <select id="city-filter" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20">
                <option value="">All Cities</option>
                <!-- City options would be populated here -->
            </select>
        </div>
        <div>
            <label for="team-filter" class="block text-sm font-medium text-gray-700 mb-1">Team</label>
            <select id="team-filter" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20">
                <option value="">All Teams</option>
                <!-- Team options would be populated here -->
            </select>
        </div>
        <div>
            <label for="date-filter" class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
            <select id="date-filter" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/20">
                <option value="">All Dates</option>
                <option value="group">Group Stage</option>
                <option value="knockout">Knockout Stage</option>
                <option value="finals">Finals</option>
            </select>
        </div>
    </div>
</div>

<!-- Match Listing -->
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-5 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-800">All Matches</h2>
    </div>
    <div class="divide-y divide-gray-200">
        @forelse($matches as $match)
        <div class="p-5 hover:bg-gray-50 transition-colors">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <!-- Match Details -->
                    <div class="flex flex-col md:flex-row items-center md:space-x-6 w-full">
                        <!-- Match Date -->
                        <div class="text-center mb-3 md:mb-0 md:w-24">
                            <div class="text-sm font-medium text-gray-500">{{ \Carbon\Carbon::parse($match->match_date)->format('M d') }}</div>
                            <div class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($match->match_time)->format('H:i') }}</div>
                        </div>

                        <!-- Teams -->
                        <div class="flex flex-1 items-center justify-center space-x-3">
                            <!-- Home Team -->
                            <div class="flex flex-col items-center w-24">
                                <div class="w-10 h-10 bg-gray-200 rounded-full overflow-hidden mb-1">
                                    @if($match->homeTeam && $match->homeTeam->logo_path)
                                    <img src="{{ asset('storage/' . $match->homeTeam->logo_path) }}" alt="{{ $match->homeTeam->name }} logo" class="w-full h-full object-cover">
                                    @else
                                    <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                                        <span class="text-xs text-gray-500">No logo</span>
                                    </div>
                                    @endif
                                </div>
                                <span class="text-sm font-medium text-gray-800 text-center">{{ $match->homeTeam ? $match->homeTeam->name : 'TBD' }}</span>
                            </div>

                            <!-- Score -->
                            <div class="flex flex-col items-center">
                                <div class="flex items-center justify-center bg-gray-100 rounded-md px-3 py-1 w-16">
                                    <span class="text-lg font-semibold text-gray-800">
                                        {{ $match->home_score !== null ? $match->home_score : '-' }}
                                        <span class="mx-1 text-gray-400">:</span>
                                        {{ $match->away_score !== null ? $match->away_score : '-' }}
                                    </span>
                                </div>
                                <span class="text-xs text-gray-500 mt-1">{{ $match->status ?? 'Scheduled' }}</span>
                            </div>

                            <!-- Away Team -->
                            <div class="flex flex-col items-center w-24">
                                <div class="w-10 h-10 bg-gray-200 rounded-full overflow-hidden mb-1">
                                    @if($match->awayTeam && $match->awayTeam->logo_path)
                                    <img src="{{ asset('storage/' . $match->awayTeam->logo_path) }}" alt="{{ $match->awayTeam->name }} logo" class="w-full h-full object-cover">
                                    @else
                                    <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                                        <span class="text-xs text-gray-500">No logo</span>
                                    </div>
                                    @endif
                                </div>
                                <span class="text-sm font-medium text-gray-800 text-center">{{ $match->awayTeam ? $match->awayTeam->name : 'TBD' }}</span>
                            </div>
                        </div>

                        <!-- Stadium and City -->
                        <div class="md:w-48 text-center md:text-right">
                            <p class="text-sm font-medium text-gray-800">{{ $match->stadium ? $match->stadium->name : 'TBD' }}</p>
                            <p class="text-xs text-gray-500">{{ $match->stadium && $match->stadium->city ? $match->stadium->city->name : '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <!-- Favorite Button -->
                    <button
                        class="rounded-full p-2 hover:bg-gray-100 favorite-btn"
                        data-match-id="{{ $match->id }}"
                        data-is-favorite="{{ in_array($match->id, $favoriteMatches) ? 'true' : 'false' }}"
                        onclick="toggleFavorite({{ $match->id }})"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ in_array($match->id, $favoriteMatches) ? 'text-red-500' : 'text-gray-400' }}" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Details Link -->
                    <a href="{{ route('member.matches.show', $match) }}" class="text-primary hover:text-primary/80 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="p-5 text-center">
            <p class="text-gray-600">No matches available at this time.</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Member Exclusive Section -->
<div class="mt-8 bg-blue-50 border border-blue-100 rounded-lg p-5">
    <h2 class="text-xl font-semibold text-blue-800 mb-3">Member Benefits</h2>
    <p class="text-blue-700 mb-4">As a member, you have access to these exclusive match features:</p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Personalized Alerts</h3>
            <p class="text-gray-600 text-sm">Get notified about your favorite matches and teams</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Match Predictions</h3>
            <p class="text-gray-600 text-sm">Participate in prediction contests with other members</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Transportation Info</h3>
            <p class="text-gray-600 text-sm">Access special transportation options to match venues</p>
        </div>
    </div>
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
                icon.classList.add('text-red-500');
            } else {
                button.setAttribute('data-is-favorite', 'false');
                icon.classList.remove('text-red-500');
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
