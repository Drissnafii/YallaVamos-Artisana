@extends('layouts.admin')

@section('title', 'Add New Stadium')

@section('header', 'Add New Stadium')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
@endpush

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Back Button -->
        <div class="mb-8">
            <a href="{{ route('admin.stadiums.index') }}" class="inline-flex items-center text-green-600 hover:text-green-800 font-medium transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back to Stadiums
            </a>
        </div>

        <!-- Main Form Card -->
        <div class="bg-gradient-to-b from-white to-green-50 shadow-lg rounded-xl overflow-hidden border border-gray-100">
            <!-- Header -->
            <div class="p-8 border-b border-gray-100 bg-white bg-opacity-70">
                <h2 class="text-2xl font-semibold text-gray-800">Stadium Information</h2>
                <p class="mt-2 text-sm text-gray-600">Fill in the details below to add a new stadium</p>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.stadiums.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
                @csrf

                <!-- Stadium Name and City -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Stadium Name <span class="text-red-600">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               value="{{ old('name') }}" 
                               class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-white text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition-all duration-200 @error('name') border-red-300 ring-red-100 @enderror" 
                               required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="city_id" class="block text-sm font-medium text-gray-700">
                            City <span class="text-red-600">*</span>
                        </label>
                        <select name="city_id" 
                                id="city_id" 
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-white text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition-all duration-200 @error('city_id') border-red-300 ring-red-100 @enderror" 
                                required>
                            <option value="">Select a city</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ (old('city_id', $selectedCityId ?? '') == $city->id) ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('city_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Capacity, Year Built, Status -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="space-y-2">
                        <label for="capacity" class="block text-sm font-medium text-gray-700">
                            Capacity <span class="text-red-600">*</span>
                        </label>
                        <input type="number" 
                               name="capacity" 
                               id="capacity" 
                               value="{{ old('capacity') }}" 
                               class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-white text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition-all duration-200 @error('capacity') border-red-300 ring-red-100 @enderror" 
                               required>
                        @error('capacity')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="year_built" class="block text-sm font-medium text-gray-700">
                            Year Built
                        </label>
                        <input type="number" 
                               name="year_built" 
                               id="year_built" 
                               value="{{ old('year_built') }}" 
                               class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-white text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition-all duration-200 @error('year_built') border-red-300 ring-red-100 @enderror">
                        @error('year_built')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="status" class="block text-sm font-medium text-gray-700">
                            Status <span class="text-red-600">*</span>
                        </label>
                        <select name="status" 
                                id="status" 
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-white text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition-all duration-200 @error('status') border-red-300 ring-red-100 @enderror" 
                                required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="under_construction" {{ old('status') == 'under_construction' ? 'selected' : '' }}>Under Construction</option>
                            <option value="renovation" {{ old('status') == 'renovation' ? 'selected' : '' }}>Under Renovation</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="space-y-2">
                    <label for="address" class="block text-sm font-medium text-gray-700">
                        Address
                    </label>
                    <input type="text" 
                           name="address" 
                           id="address" 
                           value="{{ old('address') }}" 
                           class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-white text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition-all duration-200 @error('address') border-red-300 ring-red-100 @enderror">
                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="space-y-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">
                        Description
                    </label>
                    <textarea name="description" 
                              id="description" 
                              rows="4" 
                              class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-white text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition-all duration-200 @error('description') border-red-300 ring-red-100 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image Upload Section -->
                <div class="space-y-2">
                    <label for="image" class="block text-sm font-medium text-gray-700">
                        Stadium Image
                    </label>
                    <div class="mt-2">
                        <label for="image" class="cursor-pointer flex items-center justify-center px-4 py-4 border-2 border-dashed border-gray-300 rounded-lg text-center hover:bg-white/50 transition-colors">
                            <div class="space-y-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <div class="text-sm font-medium text-gray-600">Click to upload an image</div>
                                <p class="text-xs text-gray-500">(JPEG, PNG, or GIF)</p>
                            </div>
                            <input type="file" 
                                   name="image" 
                                   id="image" 
                                   class="sr-only" 
                                   accept="image/*">
                        </label>
                    </div>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <div id="imagePreview" class="mt-4 hidden">
                        <img id="previewImage" class="h-52 w-auto mx-auto object-cover rounded-xl shadow-md" alt="Stadium preview">
                    </div>
                </div>

                <!-- Location Section -->
                <div class="bg-white bg-opacity-50 rounded-xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        Stadium Location
                    </h3>
                    
                    <!-- Map -->
                    <div id="map" class="w-full h-96 rounded-xl overflow-hidden shadow-md mb-4 border border-gray-200"></div>
                    <p class="text-sm text-gray-600 mb-4 italic">Click on the map or use the search box to set the stadium location</p>

                    <!-- Coordinates -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label for="latitude" class="block text-sm font-medium text-gray-700">
                                Latitude
                            </label>
                            <input type="text" 
                                   name="latitude" 
                                   id="latitude" 
                                   value="{{ old('latitude') }}" 
                                   class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-gray-50 text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition-all duration-200 @error('latitude') border-red-300 ring-red-100 @enderror" 
                                   readonly>
                            @error('latitude')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="longitude" class="block text-sm font-medium text-gray-700">
                                Longitude
                            </label>
                            <input type="text" 
                                   name="longitude" 
                                   id="longitude" 
                                   value="{{ old('longitude') }}" 
                                   class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-gray-50 text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition-all duration-200 @error('longitude') border-red-300 ring-red-100 @enderror" 
                                   readonly>
                            @error('longitude')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="pt-6 border-t border-gray-200">
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('admin.stadiums.index') }}" 
                           class="px-6 py-3 bg-white border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-all shadow-sm">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-all shadow-sm flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Create Stadium
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize the map
        const map = L.map('map').setView([34.0209, -6.8416], 8); // Default center (Rabat, Morocco)

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Initialize marker variable
        let marker;

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

            // Update or create marker
            if (marker) {
                marker.setLatLng(latlng);
            } else {
                marker = L.marker(latlng).addTo(map);
            }

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

            // Update or create marker
            if (marker) {
                marker.setLatLng(e.latlng);
            } else {
                marker = L.marker(e.latlng).addTo(map);
            }
        });

        // If there are old values (e.g., after validation error), set the marker
        const oldLat = "{{ old('latitude') }}";
        const oldLng = "{{ old('longitude') }}";
        if (oldLat && oldLng) {
            const latlng = L.latLng(parseFloat(oldLat), parseFloat(oldLng));
            marker = L.marker(latlng).addTo(map);
            map.setView(latlng, 13);
        }

        // Image preview functionality
        const imageInput = document.getElementById('image');
        const previewContainer = document.getElementById('imagePreview');
        const previewImage = document.getElementById('previewImage');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                previewContainer.classList.add('hidden');
            }
        });
    });
</script>
@endpush
