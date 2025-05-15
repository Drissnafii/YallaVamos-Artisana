@extends('layouts.admin')

@section('title', 'Edit City')

@section('header', 'Edit City')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <style>
        .leaflet-control-geocoder {
            width: 100%;
            max-width: 300px;
        }
    </style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <a href="{{ route('admin.cities.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Cities
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden" style="background: linear-gradient(to bottom, white, #f0f7ff);">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Edit City Information</h2>
        </div>

        <form action="{{ route('admin.cities.update', $city) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">City Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $city->name) }}" class="form-input rounded-md shadow-sm w-full @error('name') border-red-500 @enderror" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="4" class="form-textarea rounded-md shadow-sm w-full @error('description') border-red-500 @enderror">{{ old('description', $city->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">City Image</label>
                @if($city->image)
                    <div class="mb-2">
                        <img src="{{ $city->image_url }}" alt="{{ $city->name }}" class="h-32 object-cover rounded-md">
                    </div>
                @endif
                <input type="file" name="image" id="image" class="form-input rounded-md shadow-sm w-full @error('image') border-red-500 @enderror" accept="image/*">
                <p class="text-xs text-gray-500 mt-1">Upload a new image to replace the current one (JPEG, PNG, or GIF).</p>
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                <div id="map" class="w-full h-96 rounded-lg border border-gray-300 mb-2"></div>
                <p class="text-sm text-gray-500 mb-2">Click on the map to update the city location or search for a place.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="latitude" class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
                        <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $city->latitude) }}" class="form-input rounded-md shadow-sm w-full @error('latitude') border-red-500 @enderror" readonly>
                        @error('latitude')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="longitude" class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                        <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $city->longitude) }}" class="form-input rounded-md shadow-sm w-full @error('longitude') border-red-500 @enderror" readonly>
                        @error('longitude')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-gray-200">
                <div class="flex justify-end">
                    <a href="{{ route('admin.cities.index') }}" class="bg-gray-200 text-gray-800 hover:bg-gray-300 px-4 py-2 rounded shadow mr-2">Cancel</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded shadow">Update City</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize the map
        const initialLat = {{ old('latitude', $city->latitude ?? 25.276987) }};
        const initialLng = {{ old('longitude', $city->longitude ?? 55.296249) }};
        const map = L.map('map').setView([initialLat, initialLng], 8);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Initialize marker with existing location
        let marker = L.marker([initialLat, initialLng]).addTo(map);

        // Add geocoder control
        const geocoder = L.Control.geocoder({
            defaultMarkGeocode: false,
            placeholder: 'Search for a location...',
            errorMessage: 'Nothing found.',
            showResultIcons: true
        })
        .on('markgeocode', function(e) {
            const latlng = e.geocode.center;
            
            // Update form inputs
            document.getElementById('latitude').value = latlng.lat.toFixed(7);
            document.getElementById('longitude').value = latlng.lng.toFixed(7);

            // Update marker position
            marker.setLatLng(latlng);

            // Center map on result
            map.setView(latlng, 13);
        })
        .addTo(map);

        // Handle map click events
        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;

            // Update form inputs
            document.getElementById('latitude').value = lat.toFixed(7);
            document.getElementById('longitude').value = lng.toFixed(7);

            // Update marker position
            marker.setLatLng(e.latlng);
        });
    });
</script>
@endpush
