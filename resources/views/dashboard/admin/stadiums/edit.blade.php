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
        <a href="{{ route('admin.stadiums.index') }}" class="inline-flex items-center text-green-600 hover:text-green-800 font-medium transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Stadiums
        </a>
    </div>

    <div class="bg-gradient-to-b from-white to-green-50 shadow-lg rounded-xl overflow-hidden border border-gray-100">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center bg-white bg-opacity-70">
            <h2 class="text-xl font-bold text-gray-800">Edit Stadium: {{ $stadium->name }}</h2>
            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $stadium->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                {{ ucfirst($stadium->status) }}
            </span>
        </div>

        <form action="{{ route('admin.stadiums.update', $stadium) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-1">
                    <label for="name" class="block text-sm font-medium text-gray-700">Stadium Name <span class="text-red-500">*</span></label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name', $stadium->name) }}" 
                           class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-white text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition-all duration-200 @error('name') border-red-300 ring-red-100 @enderror" 
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label for="city_id" class="block text-sm font-medium text-gray-700">City <span class="text-red-500">*</span></label>
                    <select name="city_id" 
                            id="city_id" 
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-white text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition-all duration-200 @error('city_id') border-red-300 ring-red-100 @enderror" 
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

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="space-y-1">
                    <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity <span class="text-red-500">*</span></label>
                    <input type="number" 
                           name="capacity" 
                           id="capacity" 
                           value="{{ old('capacity', $stadium->capacity) }}" 
                           class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-white text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition-all duration-200 @error('capacity') border-red-300 ring-red-100 @enderror" 
                           required>
                    @error('capacity')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label for="year_built" class="block text-sm font-medium text-gray-700">Year Built</label>
                    <input type="number" 
                           name="year_built" 
                           id="year_built" 
                           value="{{ old('year_built', $stadium->year_built) }}" 
                           class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-white text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition-all duration-200 @error('year_built') border-red-300 ring-red-100 @enderror">
                    @error('year_built')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
                    <select name="status" 
                            id="status" 
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-white text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition-all duration-200 @error('status') border-red-300 ring-red-100 @enderror" 
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

            <div class="space-y-1">
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" 
                       name="address" 
                       id="address" 
                       value="{{ old('address', $stadium->address) }}" 
                       class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-white text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition-all duration-200 @error('address') border-red-300 ring-red-100 @enderror">
                @error('address')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-1">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" 
                          id="description" 
                          rows="4" 
                          class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-white text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition-all duration-200 @error('description') border-red-300 ring-red-100 @enderror">{{ old('description', $stadium->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="image" class="block text-sm font-medium text-gray-700">Stadium Image</label>

                @if($stadium->image)
                <div class="mb-3 p-2 bg-white rounded-lg shadow-sm inline-block">
                    <img src="{{ asset('storage/' . $stadium->image) }}" alt="{{ $stadium->name }}" class="h-36 w-auto object-cover rounded-md">
                    <p class="text-xs text-gray-500 mt-1 text-center">Current image</p>
                </div>
                @endif

                <div class="mt-2">
                    <label for="image" class="cursor-pointer flex items-center justify-center px-4 py-3 border-2 border-dashed border-gray-300 rounded-lg text-center hover:bg-gray-50 transition-colors">
                        <div class="space-y-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <div class="text-sm text-gray-600">Click to upload a new image</div>
                            <p class="text-xs text-gray-500">(JPEG, PNG, or GIF)</p>
                        </div>
                        <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                    </label>
                </div>
                
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Location</label>
                <div id="map" class="w-full h-96 rounded-xl overflow-hidden shadow-md border border-gray-200"></div>
                <p class="text-sm text-gray-500 italic">Click on the map or use the search box to update the stadium location</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-4">
                    <div class="space-y-1">
                        <label for="latitude" class="block text-sm font-medium text-gray-700">Latitude</label>
                        <input type="text" 
                               name="latitude" 
                               id="latitude" 
                               value="{{ old('latitude', $stadium->latitude) }}" 
                               class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-gray-50 text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition-all duration-200 @error('latitude') border-red-300 ring-red-100 @enderror" 
                               readonly>
                        @error('latitude')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="longitude" class="block text-sm font-medium text-gray-700">Longitude</label>
                        <input type="text" 
                               name="longitude" 
                               id="longitude" 
                               value="{{ old('longitude', $stadium->longitude) }}" 
                               class="w-full rounded-lg border border-gray-300 px-4 py-3 bg-gray-50 text-gray-700 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition-all duration-200 @error('longitude') border-red-300 ring-red-100 @enderror" 
                               readonly>
                        @error('longitude')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-200">
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.stadiums.index') }}" class="px-6 py-3 bg-white border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-all shadow-sm">Cancel</a>
                    <button type="submit" class="px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-all shadow-sm">Update Stadium</button>
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

        // Custom file input preview
        const imageInput = document.getElementById('image');
        const previewContainer = document.createElement('div');
        previewContainer.className = 'mt-3 hidden bg-white p-2 rounded-lg shadow-sm inline-block';

        const previewImage = document.createElement('img');
        previewImage.className = 'h-36 w-auto object-cover rounded-md';

        const previewCaption = document.createElement('p');
        previewCaption.className = 'text-xs text-gray-500 mt-1 text-center';
        previewCaption.textContent = 'New image preview';

        previewContainer.appendChild(previewImage);
        previewContainer.appendChild(previewCaption);
        imageInput.parentNode.parentNode.appendChild(previewContainer);

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
