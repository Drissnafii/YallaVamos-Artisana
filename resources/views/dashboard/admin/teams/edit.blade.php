@extends('layouts.admin')

@section('title', 'Edit Team')

@section('header', 'Edit Team')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Top action bar -->
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('admin.teams.index') }}" class="flex items-center p-2 text-purple-600 hover:text-purple-800 rounded-full hover:bg-purple-50 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span class="ml-1">Back</span>
        </a>
    </div>

    <!-- Main content card -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8" style="background: linear-gradient(to bottom, white, #f5f3ff);">
        <!-- Banner header -->
        <div class="relative">
            <div class="h-32 bg-gradient-to-r from-purple-600 to-purple-500"></div>

            <div class="px-6 -mt-16">
                <div class="flex flex-col md:flex-row">
                    <!-- Flag preview card -->
                    <div class="md:w-1/4">
                        <div id="flag-preview-container" class="bg-white rounded-lg shadow-md overflow-hidden p-2 border border-gray-100">
                            @if($team->flag)
                                <img id="flag-preview" src="{{ asset('storage/' . $team->flag) }}" alt="{{ $team->name }}" class="w-full h-auto object-contain">
                            @else
                                <div id="flag-placeholder" class="h-40 flex items-center justify-center bg-purple-100 rounded-md">
                                    <span class="text-purple-300 text-4xl font-bold">{{ $team->code }}</span>
                                </div>
                                <img id="flag-preview" class="hidden w-full h-auto object-contain" alt="Flag preview">
                            @endif
                        </div>
                    </div>

                    <!-- Team basic info heading -->
                    <div class="md:w-3/4 md:pl-6 mt-4 md:mt-16">
                        <h1 class="text-2xl font-bold text-gray-800">Edit {{ $team->name }}</h1>
                        <p class="text-gray-500">Update team information and settings</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit form -->
        <form action="{{ route('admin.teams.update', $team) }}" method="POST" enctype="multipart/form-data" class="p-6 mt-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Left column -->
                <div class="space-y-6">
                    <!-- Team Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Team Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $team->name) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors duration-200 @error('name') border-red-500 @enderror"
                            required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Team Code -->
                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Team Code <span class="text-red-500">*</span></label>
                        <input type="text" name="code" id="code" value="{{ old('code', $team->code) }}" maxlength="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors duration-200 @error('code') border-red-500 @enderror"
                            required>
                        <p class="text-xs text-gray-500 mt-1">3-letter country code (e.g., MAR, USA, FRA)</p>
                        @error('code')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Group -->
                    <div>
                        <label for="group" class="block text-sm font-medium text-gray-700 mb-1">Team Group</label>
                        <div class="relative">
                            <select name="group" id="group"
                                class="appearance-none w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors duration-200 @error('group') border-red-500 @enderror">
                                <option value="">No Group</option>
                                @foreach(['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $group)
                                    <option value="{{ $group }}" {{ old('group', $team->group) == $group ? 'selected' : '' }}>Group {{ $group }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>
                        @error('group')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="is_qualified" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <div class="relative">
                            <select name="is_qualified" id="is_qualified"
                                class="appearance-none w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors duration-200 @error('is_qualified') border-red-500 @enderror">
                                <option value="1" {{ old('is_qualified', $team->is_qualified) == '1' ? 'selected' : '' }}>Qualified</option>
                                <option value="0" {{ old('is_qualified', $team->is_qualified) == '0' ? 'selected' : '' }}>Pending</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>
                        @error('is_qualified')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Right column -->
                <div class="space-y-6">
                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors duration-200 @error('description') border-red-500 @enderror">{{ old('description', $team->description) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Brief description of the team's history and achievements</p>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Flag upload -->
                    <div>
                        <label for="flag" class="block text-sm font-medium text-gray-700 mb-1">Team Flag</label>

                        <div id="dropzone" class="mt-2 border-2 border-gray-300 border-dashed rounded-md relative transition-all duration-200">
                            <!-- Default upload state -->
                            <div id="upload-prompt" class="py-6 flex flex-col items-center justify-center {{ $team->flag ? 'hidden' : '' }}">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="mt-2 flex items-center justify-center text-sm text-gray-600">
                                    <label for="flag" class="relative cursor-pointer rounded-md font-medium text-purple-600 hover:text-purple-500 focus-within:outline-none mr-2">
                                        <span>Upload a file</span>
                                        <input id="flag" name="flag" type="file" class="sr-only" accept="image/*">
                                    </label>
                                    <p>or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">
                                    PNG, JPG, GIF up to 2MB
                                </p>
                            </div>

                            <!-- File selected state -->
                            <div id="file-selected" class="{{ $team->flag ? '' : 'hidden' }} p-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-purple-100 rounded-full flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <p class="text-sm font-medium text-gray-900" id="file-name">
                                            {{ $team->flag ? basename($team->flag) : '' }}
                                        </p>
                                        <p class="text-xs text-gray-500" id="file-size"></p>
                                    </div>
                                    <button type="button" id="change-file" class="ml-4 px-3 py-1 text-xs text-purple-600 hover:text-purple-500 font-medium bg-purple-100 rounded-full hover:bg-purple-200 transition-colors duration-200">
                                        Change
                                    </button>
                                </div>
                            </div>
                        </div>

                        @error('flag')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Form actions -->
            <div class="border-t border-gray-200 pt-6 flex justify-end space-x-3">
                <a href="{{ route('admin.teams.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white rounded-full border border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 text-sm font-medium text-white bg-purple-600 rounded-full hover:bg-purple-700 shadow-sm transition-colors duration-200">
                    Update Team
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const flagInput = document.getElementById('flag');
        const uploadPrompt = document.getElementById('upload-prompt');
        const fileSelected = document.getElementById('file-selected');
        const fileName = document.getElementById('file-name');
        const fileSize = document.getElementById('file-size');
        const changeFileButton = document.getElementById('change-file');
        const flagPreview = document.getElementById('flag-preview');
        const flagPlaceholder = document.getElementById('flag-placeholder');
        const dropzone = document.getElementById('dropzone');

        // Handle file selection
        flagInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const file = this.files[0];

                // Update file info
                fileName.textContent = file.name;
                fileSize.textContent = formatFileSize(file.size);

                // Show file selected state
                uploadPrompt.classList.add('hidden');
                fileSelected.classList.remove('hidden');

                // Update preview image
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (flagPlaceholder) {
                        flagPlaceholder.classList.add('hidden');
                    }
                    flagPreview.src = e.target.result;
                    flagPreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        // Change file button
        if (changeFileButton) {
            changeFileButton.addEventListener('click', function() {
                flagInput.click();
            });
        }

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
            dropzone.classList.add('border-purple-500', 'bg-purple-50');
        }

        function unhighlight() {
            dropzone.classList.remove('border-purple-500', 'bg-purple-50');
        }

        // Handle dropped files
        dropzone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;

            if (files.length) {
                flagInput.files = files;

                // Trigger change event manually
                const event = new Event('change');
                flagInput.dispatchEvent(event);
            }
        }

        // Helper function to format file size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';

            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));

            return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
        }
    });
</script>
@endpush

@endsection
