@extends('layouts.admin')

@section('title', 'Create New Article')

@section('header', 'Create New Article')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-5xl">
    <!-- Top action bar with back button and page title -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center">
            <a href="{{ route('admin.articles.index') }}" class="mr-4 p-2 rounded-full hover:bg-gray-100 transition-colors duration-200" title="Back to Articles">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h1 class="text-xl font-medium text-gray-800">Create New Article</h1>
        </div>
    </div>

    <!-- Main content card with shadow -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-8">
        <div class="border-b border-gray-200">
            <div class="px-6 py-4">
                <h2 class="text-lg font-medium text-gray-800">Article Information</h2>
                <p class="text-sm text-gray-500">Fill in the details to create a new article</p>
            </div>
        </div>

        <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Form content -->
            <div class="p-6 space-y-6">
                <!-- Title Field - Material Design style -->
                <div class="relative">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content Field -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                    <textarea name="content" id="content" rows="10" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Two column layout for smaller fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left column -->
                    <div class="space-y-6">
                        <!-- Slug Field -->
                        <div>
                            <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">URL Slug</label>
                            <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 @error('slug') border-red-500 @enderror">
                            <p class="mt-1 text-xs text-gray-500">Generated automatically if left empty</p>
                            @error('slug')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Publication Date Field -->
                        <div>
                            <label for="publication_date" class="block text-sm font-medium text-gray-700 mb-1">Publication Date</label>
                            <input type="date" name="publication_date" id="publication_date"
                                value="{{ old('publication_date') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 @error('publication_date') border-red-500 @enderror">
                            @error('publication_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Published Status Switch -->
                        <div>
                            <span class="block text-sm font-medium text-gray-700 mb-2">Publication Status</span>
                            <div class="flex items-center">
                                <div class="relative inline-block w-12 mr-2 align-middle select-none">
                                    <input type="checkbox" name="published" id="published" value="1"
                                        {{ old('published') ? 'checked' : '' }}
                                        class="absolute block w-6 h-6 bg-white border-4 border-gray-300 rounded-full appearance-none cursor-pointer checked:right-0 checked:border-blue-500 focus:outline-none transition-all duration-200"/>
                                    <label for="published" class="block h-6 overflow-hidden bg-gray-300 rounded-full cursor-pointer"></label>
                                </div>
                                <span id="published-status" class="text-sm font-medium {{ old('published') ? 'text-blue-600' : 'text-gray-700' }}">
                                    {{ old('published') ? 'Published' : 'Draft' }}
                                </span>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Make this article visible to the public</p>
                            @error('published')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Right column -->
                    <div>
                        <!-- Featured Image with drag & drop -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Featured Image</label>

                            <div id="dropzone" class="mt-2 border-2 border-gray-300 border-dashed rounded-md relative transition-all duration-200">
                                <!-- Default upload state -->
                                <div id="upload-prompt" class="py-8 flex flex-col items-center justify-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="mt-2 flex items-center justify-center text-sm text-gray-600">
                                        <label for="image" class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none mr-2">
                                            <span>Upload a file</span>
                                            <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                                        </label>
                                        <p>or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">
                                        PNG, JPG, GIF up to 10MB
                                    </p>
                                </div>

                                <!-- Image preview state (hidden initially) -->
                                <div id="image-preview-container" class="hidden relative overflow-hidden rounded-md">
                                    <img id="preview-image" src="#" alt="Preview" class="w-full h-64 object-cover">

                                    <!-- Image overlay with info and actions -->
                                    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-between p-4 text-white opacity-0 hover:opacity-100 transition-opacity duration-200">
                                        <div class="flex justify-end">
                                            <button type="button" id="remove-image-btn" class="bg-red-600 rounded-full p-1 hover:bg-red-700 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="mt-auto">
                                            <p id="image-name" class="text-sm truncate"></p>
                                            <button type="button" onclick="document.getElementById('image').click()" class="mt-2 bg-white bg-opacity-20 hover:bg-opacity-30 text-white text-xs rounded px-3 py-1 transition-colors">
                                                Change Image
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Recommended: 1200 × 630 pixels, JPG or PNG format</p>
                        </div>

                        <!-- Category Field (if you have categories) -->
                        <div class="mt-6">
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select id="category_id" name="category_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200">
                                <option value="">Select a category</option>
                                @foreach($categories ?? [] as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer with action buttons -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
                <div class="flex space-x-3">
                    <a href="{{ route('admin.articles.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white rounded-full border border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-full hover:bg-blue-700 transition-colors duration-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Create Article
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-generate slug from title if slug is empty
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');

        if (titleInput && slugInput) {
            titleInput.addEventListener('blur', function() {
                if (slugInput.value === '') {
                    // Simple slug generation
                    slugInput.value = this.value
                        .toLowerCase()
                        .replace(/[^\w\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-')
                        .trim();
                }
            });
        }

        // Toggle published switch label
        const publishedSwitch = document.getElementById('published');
        const publishedStatus = document.getElementById('published-status');

        if (publishedSwitch && publishedStatus) {
            publishedSwitch.addEventListener('change', function() {
                if (this.checked) {
                    publishedStatus.textContent = 'Published';
                    publishedStatus.classList.remove('text-gray-700');
                    publishedStatus.classList.add('text-blue-600');
                } else {
                    publishedStatus.textContent = 'Draft';
                    publishedStatus.classList.remove('text-blue-600');
                    publishedStatus.classList.add('text-gray-700');
                }
            });
        }

        // Image upload with preview and drag & drop functionality
        const dropzone = document.getElementById('dropzone');
        const imageInput = document.getElementById('image');
        const uploadPrompt = document.getElementById('upload-prompt');
        const previewContainer = document.getElementById('image-preview-container');
        const previewImage = document.getElementById('preview-image');
        const imageName = document.getElementById('image-name');
        const removeImageBtn = document.getElementById('remove-image-btn');

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
            dropzone.classList.add('border-blue-500', 'bg-blue-50');
        }

        function unhighlight() {
            dropzone.classList.remove('border-blue-500', 'bg-blue-50');
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

        // Remove image button click handler
        if (removeImageBtn) {
            removeImageBtn.addEventListener('click', function() {
                removeImage();
            });
        }

        function updateImagePreview(file) {
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    uploadPrompt.classList.add('hidden');
                    previewContainer.classList.remove('hidden');

                    // Update image name
                    if (imageName) {
                        imageName.textContent = file.name;
                    }
                };

                reader.readAsDataURL(file);
            }
        }

        function removeImage() {
            // Clear the file input
            imageInput.value = '';

            // Hide preview and show upload prompt
            previewContainer.classList.add('hidden');
            uploadPrompt.classList.remove('hidden');
        }
    });
</script>
@endpush

@endsection
