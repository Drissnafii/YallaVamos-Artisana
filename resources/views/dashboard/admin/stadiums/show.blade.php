@extends('layouts.admin')

@section('title', $stadium->name)

@section('header', 'Stadium Details')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        .map-container {
            height: 100%;
            width: 100%;
            position: relative;
        }
        #map {
            height: 100%;
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }
    </style>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section with Gradient Overlay -->
    <div class="relative h-96 bg-gradient-to-br from-green-800 to-green-600">
        @if($stadium->image)
            <img src="{{ asset('storage/' . $stadium->image) }}" 
                 alt="{{ $stadium->name }}" 
                 class="absolute inset-0 w-full h-full object-cover opacity-30">
        @endif
        
        <!-- Floating Back Button -->
        <a href="{{ route('admin.stadiums.index') }}" 
           class="absolute top-6 left-6 inline-flex items-center px-4 py-2 bg-white/90 backdrop-blur text-gray-700 rounded-full hover:bg-white transition-all duration-200 shadow-lg group">
            <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span class="font-medium">Back</span>
        </a>

        <!-- Action Buttons -->
        <div class="absolute top-6 right-6 flex space-x-3">
            <a href="{{ route('admin.stadiums.edit', $stadium) }}" 
               class="inline-flex items-center px-4 py-2 bg-white/90 backdrop-blur text-green-700 rounded-full hover:bg-white transition-all duration-200 shadow-lg">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit
            </a>
            <form action="{{ route('admin.stadiums.destroy', $stadium) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 bg-red-500/90 backdrop-blur text-white rounded-full hover:bg-red-600 transition-all duration-200 shadow-lg"
                        onclick="return confirm('Are you sure you want to delete this stadium?')">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Delete
                </button>
            </form>
        </div>

        <!-- Stadium Name and Status -->
        <div class="absolute bottom-0 left-0 right-0 p-8">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-4xl font-bold text-white mb-3">{{ $stadium->name }}</h1>
                <div class="flex items-center space-x-4">
                    <span class="px-4 py-2 rounded-full text-sm font-medium 
                        {{ $stadium->status == 'active' ? 'bg-green-500 text-white' :
                           ($stadium->status == 'under_construction' ? 'bg-blue-500 text-white' :
                           ($stadium->status == 'renovation' ? 'bg-yellow-500 text-white' : 'bg-gray-500 text-white')) }}">
                        {{ ucfirst(str_replace('_', ' ', $stadium->status)) }}
                    </span>
                    <span class="text-white/80">
                        <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        {{ $stadium->city ? $stadium->city->name : 'N/A' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 -mt-16 relative z-10">
        <!-- Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-lg p-6 transform hover:scale-105 transition-transform duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Capacity</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stadium->capacity) }}</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 transform hover:scale-105 transition-transform duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Year Built</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stadium->year_built ?? 'Unknown' }}</p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 transform hover:scale-105 transition-transform duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Matches</p>
                        <p class="text-2xl font-bold text-gray-900">{{ isset($stats) && isset($stats->total_matches) ? $stats->total_matches : 0 }}</p>
                    </div>
                    <div class="p-3 bg-purple-100 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 transform hover:scale-105 transition-transform duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Upcoming</p>
                        <p class="text-2xl font-bold text-gray-900">{{ isset($stats) && isset($stats->upcoming_matches) ? $stats->upcoming_matches : 0 }}</p>
                    </div>
                    <div class="p-3 bg-yellow-100 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="border-b border-gray-200">
                <nav class="flex -mb-px">
                    <button onclick="switchTab('info')" id="info-tab" 
                            class="tab-btn px-6 py-4 text-sm font-medium text-green-600 border-b-2 border-green-600 focus:outline-none">
                        Information
                    </button>
                    <button onclick="switchTab('matches')" id="matches-tab"
                            class="tab-btn px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none">
                        Upcoming Matches
                    </button>
                    <button onclick="switchTab('location')" id="location-tab"
                            class="tab-btn px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none">
                        Location
                    </button>
                </nav>
            </div>

            <!-- Tab Content -->
            <div class="p-8">
                <!-- Information Tab -->
                <div id="info-content" class="tab-content">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Stadium Details</h3>
                            <dl class="space-y-4">
                                <div>
                                    <dt class="text-sm text-gray-500">Address</dt>
                                    <dd class="mt-1 text-base text-gray-900">{{ $stadium->address ?? 'Not specified' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm text-gray-500">City</dt>
                                    <dd class="mt-1 text-base text-gray-900">{{ $stadium->city ? $stadium->city->name : 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm text-gray-500">Status</dt>
                                    <dd class="mt-1 text-base text-gray-900">{{ ucfirst(str_replace('_', ' ', $stadium->status)) }}</dd>
                                </div>
                            </dl>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Description</h3>
                            <p class="text-gray-700 leading-relaxed">
                                {{ $stadium->description ?? 'No description available.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Matches Tab -->
                <div id="matches-content" class="tab-content hidden">
                    @if(isset($upcomingMatches) && $upcomingMatches->count() > 0)
                        <div class="space-y-4">
                            @foreach($upcomingMatches as $match)
                            <div class="bg-gray-50 rounded-xl p-6 hover:bg-gray-100 transition-colors duration-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-500">{{ $match->date ? $match->date->format('M d, Y H:i') : 'TBD' }}</p>
                                        <p class="text-lg font-medium text-gray-900 mt-1">
                                            {{ $match->team1 ? $match->team1->name : 'TBD' }} vs {{ $match->team2 ? $match->team2->name : 'TBD' }}
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span class="px-3 py-1 text-xs font-medium rounded-full 
                                            {{ $match->status == 'scheduled' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                            {{ ucfirst($match->status) }}
                                        </span>
                                        <a href="{{ route('admin.matches.show', $match) }}" 
                                           class="text-green-600 hover:text-green-700 font-medium">
                                            View
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-gray-500">No upcoming matches scheduled</p>
                            <a href="{{ route('admin.matches.create') }}" 
                               class="inline-flex items-center text-green-600 hover:text-green-700 font-medium mt-4">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Schedule a match
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Location Tab -->
                <div id="location-content" class="tab-content hidden">
                    @if($stadium->latitude && $stadium->longitude)
                        <div class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-sm text-gray-500">Latitude</p>
                                    <p class="text-lg font-medium text-gray-900">{{ $stadium->latitude }}</p>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-sm text-gray-500">Longitude</p>
                                    <p class="text-lg font-medium text-gray-900">{{ $stadium->longitude }}</p>
                                </div>
                            </div>
                            <div class="h-96 bg-gray-100 rounded-lg overflow-hidden">
                                <div class="map-container">
                                    <div id="map"></div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <p class="text-gray-500">No location data available</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function switchTab(tabName) {
    // Hide all content
    document.querySelectorAll('.tab-content').forEach(el => {
        el.classList.add('hidden');
    });
    
    // Reset all tabs
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('text-green-600', 'border-b-2', 'border-green-600');
        btn.classList.add('text-gray-500');
    });
    
    // Show selected content
    document.getElementById(tabName + '-content').classList.remove('hidden');
    
    // Highlight selected tab
    const selectedTab = document.getElementById(tabName + '-tab');
    selectedTab.classList.remove('text-gray-500');
    selectedTab.classList.add('text-green-600', 'border-b-2', 'border-green-600');
}
</script>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize the map with stadium's location
        const lat = {{ $stadium->latitude ?? 34.0209 }};
        const lng = {{ $stadium->longitude ?? -6.8416 }};
        const map = L.map('map', {
            center: [lat, lng],
            zoom: 15,
            scrollWheelZoom: true
        });

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 19
        }).addTo(map);

        // Add marker for stadium location
        L.marker([lat, lng])
            .addTo(map)
            .bindPopup("{{ $stadium->name }}")
            .openPopup();

        // Fix map display issues by triggering a resize after the tab becomes visible
        document.getElementById('location-tab').addEventListener('click', function() {
            setTimeout(function() {
                map.invalidateSize();
            }, 100);
        });
    });
</script>
@endpush