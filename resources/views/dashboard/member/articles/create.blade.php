@extends('layouts.app')

@section('head')
<!-- Include Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="max-w-4xl mx-auto mt-12 bg-white rounded-lg shadow-md p-8">
    <!-- Cover Image Area -->
    <div id="coverImageContainer" class="mb-6">
        <div id="coverImagePlaceholder" class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
            <button type="button" id="coverImageBtn" class="border border-gray-300 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-100">
                Add a cover image
            </button>
            <input type="file" id="image" name="image" class="hidden" accept="image/*">
        </div>
        <div id="coverImagePreview" class="hidden mb-6">
            <div class="relative">
                <img id="previewImage" src="" alt="Cover image" class="w-full h-64 object-cover rounded-lg">
                <button type="button" id="removeImageBtn" class="absolute top-2 right-2 bg-white rounded-full p-1 shadow-md hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <form id="articleForm" action="{{ route('member.my-articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Hidden file input that will be triggered by the button -->
        <input type="hidden" id="imageData" name="imageData">

        <!-- Title -->
        <input
            type="text"
            name="title"
            placeholder="New post title here..."
            class="w-full text-4xl font-bold text-gray-800 placeholder-gray-500 focus:outline-none mb-4"
            required
        />

        <!-- Categories -->
        <div class="flex items-center gap-2 mb-4">
            <select name="category_id" class="text-sm border border-gray-300 rounded-md py-1 px-2 focus:outline-none focus:ring-1 focus:ring-indigo-500" required>
                <option value="">Select category...</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Content Textarea with Summernote -->
        <textarea
            id="summernote"
            name="content"
            class="w-full"
            required
        ></textarea>

        <!-- Footer Actions -->
        <div class="flex items-center justify-between mt-6">
            <div class="flex items-center gap-4">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg">Publish</button>
                <button type="button" id="saveDraft" class="text-gray-500 hover:text-gray-700">Save draft</button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Summernote
        $('#summernote').summernote({
            placeholder: 'Write your post content here...',
            tabsize: 2,
            height: 300,
            toolbar: [
                ['font', ['bold', 'underline', 'italic']],
                ['color', ['color']],
                ['para', ['paragraph']]
            ],
            callbacks: {
                onPaste: function (e) {
                    // Strip all HTML elements except for basic formatting
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                },
                onImageUpload: function(files) {
                    // Disable image upload functionality
                    alert('Image uploads are not allowed in the content editor.');
                }
            }
        });

        // Cover image handling
        const coverImageBtn = document.getElementById('coverImageBtn');
        const imageInput = document.getElementById('image');
        const coverImagePlaceholder = document.getElementById('coverImagePlaceholder');
        const coverImagePreview = document.getElementById('coverImagePreview');
        const previewImage = document.getElementById('previewImage');
        const removeImageBtn = document.getElementById('removeImageBtn');
        const imageDataInput = document.getElementById('imageData');

        // Trigger file selection when button is clicked
        coverImageBtn.addEventListener('click', function() {
            imageInput.click();
        });

        // Handle image selection
        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    coverImagePlaceholder.classList.add('hidden');
                    coverImagePreview.classList.remove('hidden');

                    // Store base64 image data in hidden field
                    imageDataInput.value = e.target.result;
                };

                reader.readAsDataURL(this.files[0]);
            }
        });

        // Remove image
        removeImageBtn.addEventListener('click', function() {
            imageInput.value = '';
            imageDataInput.value = '';
            coverImagePreview.classList.add('hidden');
            coverImagePlaceholder.classList.remove('hidden');
        });

        // Save draft functionality
        $('#saveDraft').click(function() {
            const form = $('#articleForm');
            const draftInput = $('<input>').attr({
                type: 'hidden',
                name: 'published',
                value: '0'
            });
            form.append(draftInput);
            form.submit();
        });
    });
</script>
@endpush
@endsection
