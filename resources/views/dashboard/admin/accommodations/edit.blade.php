@extends('layouts.admin')

@section('title', 'Edit Accommodation')

@section('header', 'Edit Accommodation')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-amber-200">
        <div class="bg-amber-500 text-white px-6 py-4 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            <h2 class="text-xl font-semibold">Edit Accommodation: {{ $accommodation->name }}</h2>
        </div>

        <form action="{{ route('admin.accommodations.update', $accommodation->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $accommodation->name) }}" class="form-input rounded-md shadow-sm w-full @error('name') border-red-500 @enderror" required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type <span class="text-red-500">*</span></label>
                        <select name="type" id="type" class="form-select rounded-md shadow-sm w-full @error('type') border-red-500 @enderror" required>
                            <option value="">Select a type</option>
                            <option value="hotel" {{ old('type', $accommodation->type) == 'hotel' ? 'selected' : '' }}>Hotel</option>
                            <option value="apartment" {{ old('type', $accommodation->type) == 'apartment' ? 'selected' : '' }}>Apartment</option>
                            <option value="riad" {{ old('type', $accommodation->type) == 'riad' ? 'selected' : '' }}>Riad</option>
                            <option value="guesthouse" {{ old('type', $accommodation->type) == 'guesthouse' ? 'selected' : '' }}>Guesthouse</option>
                            <option value="other" {{ old('type', $accommodation->type) == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('type')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="city_id" class="block text-sm font-medium text-gray-700 mb-1">City <span class="text-red-500">*</span></label>
                        <select name="city_id" id="city_id" class="form-select rounded-md shadow-sm w-full @error('city_id') border-red-500 @enderror" required>
                            <option value="">Select a city</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ old('city_id', $accommodation->city_id) == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('city_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address <span class="text-red-500">*</span></label>
                        <input type="text" name="address" id="address" value="{{ old('address', $accommodation->address) }}" class="form-input rounded-md shadow-sm w-full @error('address') border-red-500 @enderror" required>
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="price_range" class="block text-sm font-medium text-gray-700 mb-1">Price Range <span class="text-red-500">*</span></label>
                        <select name="price_range" id="price_range" class="form-select rounded-md shadow-sm w-full @error('price_range') border-red-500 @enderror" required>
                            <option value="">Select a price range</option>
                            <option value="budget" {{ old('price_range', $accommodation->price_range) == 'budget' ? 'selected' : '' }}>Budget</option>
                            <option value="mid-range" {{ old('price_range', $accommodation->price_range) == 'mid-range' ? 'selected' : '' }}>Mid-Range</option>
                            <option value="luxury" {{ old('price_range', $accommodation->price_range) == 'luxury' ? 'selected' : '' }}>Luxury</option>
                        </select>
                        @error('price_range')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="price_min" class="block text-sm font-medium text-gray-700 mb-1">Minimum Price <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>
                                <input type="number" name="price_min" id="price_min" value="{{ old('price_min', $accommodation->price_min) }}" min="0" step="0.01" class="form-input pl-7 rounded-md shadow-sm w-full @error('price_min') border-red-500 @enderror" required>
                            </div>
                            @error('price_min')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="price_max" class="block text-sm font-medium text-gray-700 mb-1">Maximum Price <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>
                                <input type="number" name="price_max" id="price_max" value="{{ old('price_max', $accommodation->price_max) }}" min="0" step="0.01" class="form-input pl-7 rounded-md shadow-sm w-full @error('price_max') border-red-500 @enderror" required>
                            </div>
                            @error('price_max')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" id="description" rows="5" class="form-textarea rounded-md shadow-sm w-full @error('description') border-red-500 @enderror">{{ old('description', $accommodation->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Current Image</label>
                        @if($accommodation->image)
                            <div class="mt-2 relative">
                                <img src="{{ asset('storage/' . $accommodation->image) }}" alt="{{ $accommodation->name }}" class="h-32 w-auto object-cover rounded-md">
                                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                                    <button type="button" onclick="document.getElementById('remove_image').value = 1; this.closest('.relative').classList.add('hidden');" class="text-white bg-red-600 rounded-full p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="remove_image" id="remove_image" value="0">
                        @else
                            <p class="text-sm text-gray-500">No image uploaded</p>
                        @endif
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Update Image</label>
                        <div id="dropzone" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-amber-600 hover:text-amber-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-amber-500">
                                        <span>Upload a file</span>
                                        <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG, GIF up to 10MB
                                </p>
                            </div>
                            <div id="image-preview" class="hidden absolute inset-0 flex items-center justify-center">
                                <img src="" alt="Preview" class="max-h-full max-w-full object-contain">
                            </div>
                        </div>
                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $accommodation->phone) }}" class="form-input rounded-md shadow-sm w-full @error('phone') border-red-500 @enderror">
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $accommodation->email) }}" class="form-input rounded-md shadow-sm w-full @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                        <input type="url" name="website" id="website" value="{{ old('website', $accommodation->website) }}" class="form-input rounded-md shadow-sm w-full @error('website') border-red-500 @enderror" placeholder="https://example.com">
                        @error('website')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200 mt-6">
                <a href="{{ route('admin.accommodations.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition duration-150 ease-in-out flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 bg-amber-600 text-white rounded-md hover:bg-amber-700 transition duration-150 ease-in-out flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    Update Accommodation
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropzone = document.getElementById('dropzone');
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');
        const previewImage = imagePreview.querySelector('img');

        // Handle drag and drop events
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        // Add visual feedback when dragging
        ['dragenter', 'dragover'].forEach(eventName => {
            dropzone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, unhighlight, false);
        });

        function highlight() {
            dropzone.classList.add('border-amber-500', 'bg-amber-50');
        }

        function unhighlight() {
            dropzone.classList.remove('border-amber-500', 'bg-amber-50');
        }

        // Handle dropped files
        dropzone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;

            if (files.length) {
                imageInput.files = files;
                updateImagePreview(files[0]);
            }
        }

        // Handle file input change
        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                updateImagePreview(this.files[0]);
            }
        });

        function updateImagePreview(file) {
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    imagePreview.classList.remove('hidden');

                    // Add remove button
                    const removeButton = document.createElement('button');
                    removeButton.type = 'button';
                    removeButton.className = 'absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600';
                    removeButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>';
                    removeButton.addEventListener('click', function() {
                        imageInput.value = '';
                        imagePreview.classList.add('hidden');
                        this.remove();
                    });

                    // Remove existing button if any
                    const existingButton = imagePreview.querySelector('button');
                    if (existingButton) {
                        existingButton.remove();
                    }

                    imagePreview.appendChild(removeButton);
                };

                reader.readAsDataURL(file);
            }
        }
    });
</script>
@endpush
