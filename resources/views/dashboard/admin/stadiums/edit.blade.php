@extends('layouts.admin')

@section('title', 'Edit Stadium')

@section('header', 'Edit Stadium')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
@endpush

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <a href="{{ route('admin.stadiums.index') }}" class="inline-flex items-center text-green-600 hover:text-green-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Stadiums
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden" style="background: linear-gradient(to bottom, white, #f0fdf4);">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-800">Edit Stadium: {{ $stadium->name }}</h2>
            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $stadium->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                {{ ucfirst($stadium->status) }}
            </span>
        </div>

        <form action="{{ route('admin.stadiums.update', $stadium) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Stadium Name <span class="text-red-500">*</span></label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name', $stadium->name) }}" 
                           class="w-full rounded-lg border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-300 @enderror" 
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="city_id" class="block text-sm font-medium text-gray-700 mb-1">City <span class="text-red-500">*</span></label>
                    <select name="city_id" 
                            id="city_id" 
                            class="w-full rounded-lg border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('city_id') border-red-300 @enderror" 
                            required>
                        <option value="">Select a city</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ old('city_id', $stadium->city_id) == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                        @endforeach
                    </select>
                    @error('city_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="capacity" class="block text-sm font-medium text-gray-700 mb-1">Capacity <span class="text-red-500">*</span></label>
                    <input type="number" 
                           name="capacity" 
                           id="capacity" 
                           value="{{ old('capacity', $stadium->capacity) }}" 
                           class="w-full rounded-lg border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('capacity') border-red-300 @enderror" 
                           required>
                    @error('capacity')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="year_built" class="block text-sm font-medium text-gray-700 mb-1">Year Built</label>
                    <input type="number" 
                           name="year_built" 
                           id="year_built" 
                           value="{{ old('year_built', $stadium->year_built) }}" 
                           class="w-full rounded-lg border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('year_built') border-red-300 @enderror">
                    @error('year_built')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                    <select name="status" 
                            id="status" 
                            class="w-full rounded-lg border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-300 @enderror" 
                            required>
                        <option value="active" {{ old('status', $stadium->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="under_construction" {{ old('status', $stadium->status) == 'under_construction' ? 'selected' : '' }}>Under Construction</option>
                        <option value="renovation" {{ old('status', $stadium->status) == 'renovation' ? 'selected' : '' }}>Under Renovation</option>
                        <option value="inactive" {{ old('status', $stadium->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                <input type="text" 
                       name="address" 
                       id="address" 
                       value="{{ old('address', $stadium->address) }}" 
                       class="w-full rounded-lg border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('address') border-red-300 @enderror">
                @error('address')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" 
                          id="description" 
                          rows="4" 
                          class="w-full rounded-lg border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-300 @enderror">{{ old('description', $stadium->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Stadium Image</label>

                @if($stadium->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $stadium->image) }}" alt="{{ $stadium->name }}" class="h-32 object-cover rounded-md shadow">
                    <p class="text-xs text-gray-500 mt-1">Current image</p>
                </div>
                @endif

                <input type="file" name="image" id="image" class="form-input rounded-md shadow-sm w-full @error('image') border-red-500 @enderror" accept="image/*">
                <p class="text-xs text-gray-500 mt-1">Upload a new image to replace the current one (JPEG, PNG, or GIF).</p>
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                <div id="map" class="w-full h-96 rounded-lg overflow-hidden shadow-sm mb-4"></div>
                <p class="text-sm text-gray-500 mb-4">Click on the map or use the search box to update the stadium location</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="latitude" class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
                        <input type="text" 
                               name="latitude" 
                               id="latitude" 
                               value="{{ old('latitude', $stadium->latitude) }}" 
                               class="w-full rounded-lg border-gray-200 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('latitude') border-red-300 @enderror" 
                               readonly>
                        @error('latitude')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="longitude" class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                        <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $stadium->longitude) }}" class="form-input rounded-md shadow-sm w-full @error('longitude') border-red-500 @enderror" readonly>
                        @error('longitude')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-gray-200">
                <div class="flex justify-end">
                    <a href="{{ route('admin.stadiums.index') }}" class="bg-gray-200 text-gray-800 hover:bg-gray-300 px-4 py-2 rounded shadow mr-2">Cancel</a>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded shadow">Update Stadium</button>
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
        // Initialize the map with stadium's location
        const initialLat = {{ old('latitude', $stadium->latitude ?? 34.0209) }};
        const initialLng = {{ old('longitude', $stadium->longitude ?? -6.8416) }};
        const map = L.map('map').setView([initialLat, initialLng], 13);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Initialize marker with stadium's location
        let marker = L.marker([initialLat, initialLng]).addTo(map);

        // Add geocoder control
        const geocoder = L.Control.geocoder({
            defaultMarkGeocode: false,
            placeholder: 'Search for a location...',
            errorMessage: 'Nothing found.',
            showResultIcons: true,
            collapsed: false
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

        // Image preview functionality for new uploads
        const imageInput = document.getElementById('image');
        const previewContainer = document.createElement('div');
        previewContainer.className = 'mt-2 hidden';

        const previewImage = document.createElement('img');
        previewImage.className = 'h-32 object-cover rounded-md shadow';

        previewContainer.appendChild(previewImage);
        imageInput.parentNode.appendChild(previewContainer);

        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endpush
