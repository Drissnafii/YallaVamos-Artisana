@extends('layouts.admin')

@section('title', 'Edit Team')

@section('header', 'Edit Team')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <a href="{{ route('admin.teams.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Teams
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden" style="background: linear-gradient(to bottom, white, #f5f3ff);">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Edit Team: {{ $team->name }}</h2>
        </div>

        <form action="{{ route('admin.teams.update', $team) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Team Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $team->name) }}" class="form-input rounded-md shadow-sm w-full @error('name') border-red-500 @enderror" required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Team Code <span class="text-red-500">*</span></label>
                    <input type="text" name="code" id="code" value="{{ old('code', $team->code) }}" maxlength="3" class="form-input rounded-md shadow-sm w-full @error('code') border-red-500 @enderror" required>
                    <p class="text-xs text-gray-500 mt-1">3-letter country code (e.g., MAR, USA, FRA)</p>
                    @error('code')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="group" class="block text-sm font-medium text-gray-700 mb-1">Team Group</label>
                    <select name="group" id="group" class="form-select rounded-md shadow-sm w-full @error('group') border-red-500 @enderror">
                        <option value="">No Group</option>
                        @foreach(['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $group)
                            <option value="{{ $group }}" {{ old('group', $team->group) == $group ? 'selected' : '' }}>Group {{ $group }}</option>
                        @endforeach
                    </select>
                    @error('group')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="is_qualified" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="is_qualified" id="is_qualified" class="form-select rounded-md shadow-sm w-full @error('is_qualified') border-red-500 @enderror">
                        <option value="1" {{ old('is_qualified', $team->is_qualified) == '1' ? 'selected' : '' }}>Qualified</option>
                        <option value="0" {{ old('is_qualified', $team->is_qualified) == '0' ? 'selected' : '' }}>Pending</option>
                    </select>
                    @error('is_qualified')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="4" class="form-textarea rounded-md shadow-sm w-full @error('description') border-red-500 @enderror">{{ old('description', $team->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="flag" class="block text-sm font-medium text-gray-700 mb-1">Team Flag</label>

                @if($team->flag)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $team->flag) }}" alt="{{ $team->name }}" class="h-24 w-auto object-cover rounded-md shadow">
                    <p class="text-xs text-gray-500 mt-1">Current flag</p>
                </div>
                @endif

                <input type="file" name="flag" id="flag" class="form-input rounded-md shadow-sm w-full @error('flag') border-red-500 @enderror" accept="image/*">
                <p class="text-xs text-gray-500 mt-1">Upload a new flag to replace the current one (JPEG, PNG, or GIF).</p>
                @error('flag')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4 border-t border-gray-200">
                <div class="flex justify-end">
                    <a href="{{ route('admin.teams.index') }}" class="bg-gray-200 text-gray-800 hover:bg-gray-300 px-4 py-2 rounded shadow mr-2">Cancel</a>
                    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-4 rounded shadow">Update Team</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image preview functionality for new uploads
        const flagInput = document.getElementById('flag');
        const previewContainer = document.createElement('div');
        previewContainer.className = 'mt-2 hidden';

        const previewImage = document.createElement('img');
        previewImage.className = 'h-24 w-auto object-cover rounded-md shadow';

        previewContainer.appendChild(previewImage);
        flagInput.parentNode.appendChild(previewContainer);

        flagInput.addEventListener('change', function() {
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
