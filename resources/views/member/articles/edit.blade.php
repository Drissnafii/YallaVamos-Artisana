@extends('layouts.member')

@section('title', 'Edit Article')

@section('head')
<!-- Include Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Article</h1>

    <form id="articleForm" action="{{ route('member.articles.update', $article) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                Title
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" type="text" placeholder="Article title" value="{{ old('title', $article->title) }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="category_id">
                Category
            </label>
            <select name="category_id" id="category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="content">
                Content
            </label>
            <textarea id="summernote" name="content" required>{{ old('content', $article->content) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                Featured Image (optional)
            </label>
            @if($article->hasMedia('images'))
                <div class="mb-2">
                    <img src="{{ $article->getFirstMediaUrl('images') }}" alt="Current image" class="h-32 w-auto">
                    <label class="flex items-center mt-2">
                        <input type="checkbox" name="remove_image" class="form-checkbox">
                        <span class="ml-2 text-sm text-gray-600">Remove current image</span>
                    </label>
                </div>
            @endif
            <input type="file" id="image" name="image" class="block w-full text-sm text-gray-500
              file:mr-4 file:py-2 file:px-4
              file:rounded-md file:border-0
              file:text-sm file:font-semibold
              file:bg-blue-50 file:text-blue-700
              hover:file:bg-blue-100">
        </div>

        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Update Article
            </button>
            <a href="{{ route('member.articles.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Cancel
            </a>
        </div>
    </form>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize Summernote with full toolbar options
        $('#summernote').summernote({
            placeholder: 'Write your post content here...',
            tabsize: 2,
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'italic', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                },
                onImageUpload: function(files) {
                    // Disable image upload functionality
                    alert('Image uploads are not allowed in the content editor.');
                }
            }
        });
    });
</script>
@endpush
@endsection
