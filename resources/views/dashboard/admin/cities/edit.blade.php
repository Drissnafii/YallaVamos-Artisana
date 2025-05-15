@extends('layouts.admin')

@section('title', 'Edit City')

@section('header', 'Edit City')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
@endpush

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <!-- Back Button -->
        <a href="{{ route('admin.cities.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-200 mb-8 group">
            <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span class="font-medium">Back to Cities</span>
        </a>

        <!-- Main Card -->
        <div class="bg-white rounded-2xl shadow-sm">
            <!-- Header -->
            <div class="px-8 py-6 border-b border-gray-100">
                <h1 class="text-2xl font-light text-gray-900">Edit City</h1>
                <p class="text-sm text-gray-500 mt-1">Update city information and location</p>
            </div>

            <form action="{{ route('admin.cities.update', $city) }}" method="POST" enctype="multipart/form-data" class="px-8 py-6 space-y-8">
                @csrf
                @method('PUT')

                <!-- City Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        City Name
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name', $city->name) }}" 
                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('name') border-red-300 @enderror" 
                           placeholder="Enter city name"
                           required>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea name="description" 
                              id="description" 
                              rows="4" 
                              class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('description') border-red-300 @enderror"
                              placeholder="Describe the city...">{{ old('description', $city->description) }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- City Image -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                        City Image
                    </label>
                    
                    @if($city->image)
                        <div class="mb-4">
                            <div class="relative inline-block">
                                <img src="{{ $city->image_url }}" alt="{{ $city->name }}" class="h-32 w-auto object-cover rounded-lg shadow-sm">
                                <div class="absolute -top-2 -right-2 bg-green-500 text-white text-xs px-2 py-1 rounded-full">Current</div>
                            </div>
                        </div>
                    @endif
                    
                    <div class="relative">
                        <input type="file" 
                               name="image" 
                               id="image" 
                               class="hidden" 
                               accept="image/*">
                        <label for="image" 
                               class="flex flex-col items-center justify-center w-full px-4 py-3 border-2 border-dashed border-gray-300 rounded-lg hover:border-gray-400 transition-colors duration-200 cursor-pointer">
                            <div id="preview-container" class="hidden w-full mb-3">
                                <img id="preview-image" class="max-h-48 rounded-lg mx-auto" src="" alt="Preview">
                            </div>
                            <div id="upload-icon" class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <span class="text-gray-600" id="fileLabel">Upload new image</span>
                            </div>
                        </label>
                    </div>
                    <p class="mt-2 text-xs text-gray-500">Replace current image (JPEG, PNG, or GIF - Max 2MB)</p>
                    @error('image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location Section -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Location
                    </label>
                    <div id="map" class="w-full h-96 rounded-lg overflow-hidden shadow-sm"></div>
                    <p class="mt-2 text-sm text-gray-500">Click on the map or search to update city location</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label for="latitude" class="block text-sm font-medium text-gray-700 mb-2">
                                Latitude
                            </label>
                            <input type="text" 
                                   name="latitude" 
                                   id="latitude" 
                                   value="{{ old('latitude', $city->latitude) }}" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                   placeholder="Select on map"
                                   readonly>
                            @error('latitude')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="longitude" class="block text-sm font-medium text-gray-700 mb-2">
                                Longitude
                            </label>
                            <input type="text" 
                                   name="longitude" 
                                   id="longitude" 
                                   value="{{ old('longitude', $city->longitude) }}" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                   placeholder="Select on map"
                                   readonly>
                            @error('longitude')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.cities.index') }}" 
                       class="px-8 py-3 text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-gray-50 transition-all duration-200 font-medium">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-8 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-all duration-200 shadow-sm font-medium">
                        Update City
                    </button>
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
        const initialLat = {{ old('latitude', $city->latitude ?? 34.0209) }};
        const initialLng = {{ old('longitude', $city->longitude ?? -6.8416) }};
        const map = L.map('map').setView([initialLat, initialLng], 10);

        // Add OpenStreetMap tiles with custom styling
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Initialize marker with existing location
        let marker = L.marker([initialLat, initialLng]).addTo(map);

        // File input handling
        const fileInput = document.getElementById('image');
        const fileLabel = document.getElementById('fileLabel');
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('preview-image');
        const uploadIcon = document.getElementById('upload-icon');
        
        function handleFileSelect(file) {
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    uploadIcon.classList.add('hidden');
                    fileLabel.textContent = file.name;
                }
                
                reader.readAsDataURL(file);
            }
        }
        
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            handleFileSelect(file);
        });

        // Setup drag and drop
        const dropZone = document.querySelector('label[for="image"]');
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        function highlight(e) {
            dropZone.classList.add('border-blue-400', 'bg-blue-50');
        }

        function unhighlight(e) {
            dropZone.classList.remove('border-blue-400', 'bg-blue-50');
        }

        function handleDrop(e) {
            preventDefaults(e);
            unhighlight(e);
            
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files && files.length > 0) {
                const file = files[0];
                fileInput.files = files;
                handleFileSelect(file);
            }
        }

        // Add event listeners to the drop zone
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });

        dropZone.addEventListener('drop', handleDrop, false);

        // Add geocoder control with custom styling
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

        // End of map functionality
    });
</script>
@endpush