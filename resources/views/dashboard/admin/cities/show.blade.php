@extends('layouts.admin')

@section('title', $city->name)

@section('header', 'City Details')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="mb-8 flex justify-between items-center">
            <a href="{{ route('admin.cities.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-200 group">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="font-medium">Back to Cities</span>
            </a>
            <div class="flex space-x-3">
                <a href="{{ route('admin.cities.edit', $city) }}" 
                   class="inline-flex items-center px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-full transition-all duration-200 shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                <form action="{{ route('admin.cities.destroy', $city) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-full transition-all duration-200 shadow-sm"
                            onclick="return confirm('Are you sure you want to delete this city?')">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <!-- Hero Section with Image -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-8">
            <!-- Image Container -->
            <div class="h-96 bg-gray-100 overflow-hidden">
                @if($city->image)
                    <img src="{{ asset('storage/' . $city->image) }}" 
                         alt="{{ $city->name }}" 
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gray-50">
                        <svg class="w-32 h-32 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                @endif
            </div>

            <!-- City Information -->
            <div class="p-8">
                <h1 class="text-3xl font-light text-gray-900">{{ $city->name }}</h1>
                <div class="mt-6 text-gray-600 leading-relaxed max-w-4xl">
                    {{ $city->description ?? 'No description available.' }}
                </div>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Location Map -->
            @if($city->latitude && $city->longitude)
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Location</h2>
                <div id="map" class="w-full h-64 rounded-lg shadow-sm overflow-hidden mb-4"></div>
                <div class="flex space-x-6 text-sm text-gray-600">
                    <div>
                        <span class="font-medium">Latitude:</span>
                        <span class="ml-1">{{ $city->latitude }}</span>
                    </div>
                    <div>
                        <span class="font-medium">Longitude:</span>
                        <span class="ml-1">{{ $city->longitude }}</span>
                    </div>
                </div>
            </div>
            @endif

            <!-- City Statistics -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">City Statistics</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-xl text-center">
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Stadiums</h3>
                        <p class="text-3xl font-light text-gray-900 mt-2">{{ $city->stadiums->count() }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl text-center">
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Accommodations</h3>
                        <p class="text-3xl font-light text-gray-900 mt-2">{{ $city->accommodations->count() }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl text-center">
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Capacity</h3>
                        <p class="text-3xl font-light text-gray-900 mt-2">{{ number_format($city->stadiums->sum('capacity')) }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl text-center">
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Favorites</h3>
                        <p class="text-3xl font-light text-gray-900 mt-2">{{ $city->favoriteCities->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stadiums Section -->
        <div class="bg-white rounded-2xl shadow-sm p-8 mt-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-light text-gray-900">Stadiums in {{ $city->name }}</h2>
                <a href="{{ route('admin.stadiums.create', ['city_id' => $city->id, 'from_city' => true]) }}" 
                   class="inline-flex items-center text-sm text-green-600 hover:text-green-700 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Stadium
                </a>
            </div>

            @if($city->stadiums->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($city->stadiums as $stadium)
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-200">
                        <div class="aspect-video bg-gray-100 overflow-hidden">
                            @if($stadium->image)
                                <img src="{{ asset('storage/' . $stadium->image) }}" 
                                     alt="{{ $stadium->name }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-green-50">
                                    <svg class="w-12 h-12 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-medium text-gray-900">{{ $stadium->name }}</h3>
                            <p class="text-sm text-gray-500 mt-1">Capacity: {{ number_format($stadium->capacity) }}</p>
                            <div class="mt-4 flex justify-between items-center">
                                <span class="px-3 py-1 text-xs font-medium rounded-full
                                    {{ $stadium->status == 'active' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($stadium->status) }}
                                </span>
                                <a href="{{ route('admin.stadiums.show', $stadium) }}" 
                                   class="text-blue-600 hover:text-blue-700 text-sm font-medium transition-colors duration-200">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="bg-gray-50 rounded-lg p-8 text-center">
                    <p class="text-gray-500">No stadiums in this city yet.</p>
                    <a href="{{ route('admin.stadiums.create', ['city_id' => $city->id, 'from_city' => true]) }}" 
                       class="text-blue-600 hover:text-blue-700 font-medium mt-2 inline-block">
                        Add the first stadium
                    </a>
                </div>
            @endif
        </div>

        <!-- Accommodations Section -->
        <div class="bg-white rounded-2xl shadow-sm p-8 mt-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-light text-gray-900">Accommodations in {{ $city->name }}</h2>
                <a href="{{ route('admin.accommodations.create') }}" 
                   class="inline-flex items-center text-sm text-blue-600 hover:text-blue-700 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Accommodation
                </a>
            </div>

            @if($city->accommodations->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($city->accommodations as $accommodation)
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-200">
                        <div class="aspect-video bg-gray-100 overflow-hidden">
                            @if(isset($accommodation->image))
                                <img src="{{ asset('storage/' . $accommodation->image) }}" 
                                     alt="{{ $accommodation->name }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-blue-50">
                                    <svg class="w-12 h-12 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-medium text-gray-900">{{ $accommodation->name }}</h3>
                            <p class="text-sm text-gray-500 mt-1">
                                {{ isset($accommodation->type) ? ucfirst($accommodation->type) : 'Accommodation' }}
                            </p>
                            <div class="mt-4 text-right">
                                <a href="{{ route('admin.accommodations.show', $accommodation) }}" 
                                   class="text-blue-600 hover:text-blue-700 text-sm font-medium transition-colors duration-200">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="bg-gray-50 rounded-lg p-8 text-center">
                    <p class="text-gray-500">No accommodations in this city yet.</p>
                    <a href="{{ route('admin.accommodations.create') }}" 
                       class="text-blue-600 hover:text-blue-700 font-medium mt-2 inline-block">
                        Add the first accommodation
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if($city->latitude && $city->longitude)
            // Initialize the map
            const map = L.map('map').setView([{{ $city->latitude }}, {{ $city->longitude }}], 13);

            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Custom marker
            const marker = L.marker([{{ $city->latitude }}, {{ $city->longitude }}])
                .addTo(map)
                .bindPopup("<strong>{{ $city->name }}</strong>");
            
            // Open popup by default
            marker.openPopup();
        @endif
    });
</script>
@endpush