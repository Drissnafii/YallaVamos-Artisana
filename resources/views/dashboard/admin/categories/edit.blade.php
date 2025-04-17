@extends('layouts.admin')

@section('title', 'Edit Category')

@section('header', 'Edit Category')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-3xl">
    <!-- Top action bar with back button and category name -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center">
            <a href="{{ route('admin.categories.index') }}" class="mr-4 p-2 rounded-full hover:bg-gray-100 transition-colors duration-200" title="Back to Categories">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h1 class="text-xl font-medium text-gray-800">{{ $category->name }}</h1>
        </div>
    </div>

    <!-- Main content card with shadow -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-8">
        <div class="border-b border-gray-200">
            <div class="px-6 py-4">
                <h2 class="text-lg font-medium text-gray-800">Edit Category</h2>
                <p class="text-sm text-gray-500">Update the category information</p>
            </div>
        </div>

        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Form content -->
            <div class="p-6 space-y-6">
                <!-- Name Field -->
                <div class="relative">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>



                <!-- Description Field -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 @error('description') border-red-500 @enderror">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Footer with action buttons -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                <button type="button" onclick="confirmDelete()" class="px-4 py-2 text-sm font-medium text-red-600 bg-white rounded-full border border-gray-300 hover:bg-red-50 transition-colors duration-200">
                    Delete Category
                </button>

                <div class="flex space-x-3">
                    <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white rounded-full border border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-full hover:bg-blue-700 transition-colors duration-200">
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Hidden Delete Form -->
<form id="delete-form" action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-generate slug from name if slug is empty
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');

        if (nameInput && slugInput) {
            nameInput.addEventListener('blur', function() {
                if (slugInput.value === '' || slugInput.value === '{{ $category->slug }}') {
                    // Convert name to slug format (lowercase, replace spaces with hyphens, remove special chars)
                    const slug = nameInput.value
                        .toLowerCase()
                        .replace(/[^\w\s-]/g, '') // Remove special characters
                        .replace(/\s+/g, '-')     // Replace spaces with hyphens
                        .replace(/--+/g, '-')     // Replace multiple hyphens with single hyphen
                        .trim();                  // Trim leading/trailing spaces
                    
                    slugInput.value = slug;
                }
            });
        }
    });

    function confirmDelete() {
        if (confirm('Are you sure you want to delete this category? This action cannot be undone.')) {
            document.getElementById('delete-form').submit();
        }
    }
</script>
@endpush

@endsection
