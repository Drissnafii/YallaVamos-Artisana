@extends('layouts.admin')

@section('title', $article->title)

@section('header', 'Article Details')

@push('styles')
<style>
    [x-cloak] { display: none !important; }
</style>
@endpush

@section('content')
<div class="container mx-auto px-0 md:px-4 py-0 md:py-4 max-w-5xl">
    <!-- Material Design Card with Hero Image -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-4">
        <!-- Header Image with Title Overlay -->
        <div class="relative overflow-hidden">
            <div class="h-64 md:h-80">
                @if($article->image)
                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-white opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif
            </div>
            <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/60 to-transparent h-1/2"></div>
            <div class="absolute bottom-0 left-0 w-full p-6">
                <!-- Status Badge - Following Google's Material Design -->
                <div class="flex mb-3">
                    <span class="px-3 py-1 text-xs font-medium rounded-full
                        {{ $article->published ? 'bg-green-100 text-green-800' : 'bg-amber-100 text-amber-800' }}">
                        {{ $article->published ? 'Published' : 'Draft' }}
                    </span>
                    @if($article->category)
                    <span class="ml-2 px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                        {{ $article->category->name }}
                    </span>
                    @endif
                </div>
                <h1 class="text-white text-2xl md:text-3xl font-normal leading-tight">{{ $article->title }}</h1>
            </div>
        </div>

        <!-- Quick Action Bar - Google Style -->
        <div id="quickActionBar" class="flex justify-between items-center px-4 py-2 border-b border-gray-100">
            <a href="{{ route('admin.articles.index') }}" class="flex items-center p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-full transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
            </a>

            <div class="flex space-x-1">
                <a href="{{ route('admin.articles.edit', $article) }}" class="p-2 rounded-full text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-colors duration-200" title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </a>

                <button type="button" id="shareButton" class="p-2 rounded-full text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-colors duration-200" title="Share">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div class="relative" id="dropdown-menu">
                    <button type="button" id="dropdown-button" class="p-2 rounded-full text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-colors duration-200" title="More options">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu Content -->
                    <div id="dropdown-content" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 hidden">
                        <div class="py-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Preview</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Print</a>
                            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline-block w-full">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this article?')" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Article Overview Card - Google-style information density -->
        <div class="px-6 py-4">
            <div class="flex items-center mb-4">
                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-medium mr-3">
                    {{ substr($article->user ? $article->user->name : 'A', 0, 1) }}
                </div>
                <div>
                    <div class="text-sm font-medium text-gray-900">{{ $article->user ? $article->user->name : 'Unknown author' }}</div>
                    <div class="text-xs text-gray-500 flex items-center">
                        <span>{{ $article->created_at ? $article->created_at->format('M d, Y') : 'N/A' }}</span>
                        @if($article->readtime)
                        <span class="mx-1">•</span>
                        <span>{{ $article->readtime }} min read</span>
                        @endif
                        @if($article->views)
                        <span class="mx-1">•</span>
                        <span>{{ number_format($article->views) }} views</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Article Content - Clean Google-style layout -->
        <div class="px-6 py-4 border-t border-gray-100">
            <div class="prose max-w-none prose-blue prose-img:rounded-lg prose-headings:font-normal prose-headings:text-gray-800">
                {!! $article->content !!}
            </div>
        </div>

        <!-- Tags Section -->
        @if($article->tags && count($article->tags) > 0)
        <div class="px-6 py-4 border-t border-gray-100">
            <div class="text-sm text-gray-500 mb-2">Tags</div>
            <div class="flex flex-wrap gap-2">
                @foreach($article->tags as $tag)
                <span class="px-3 py-1 text-sm font-medium rounded-full bg-gray-100 text-gray-800 hover:bg-gray-200 transition-colors duration-150 cursor-pointer">
                    {{ $tag->name }}
                </span>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Article Stats Card - Material Design -->
    <div class="bg-white rounded-lg shadow-sm mb-4 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-normal text-gray-800">Article Details</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-0 divide-x divide-y divide-gray-100">
            <div class="p-4 flex flex-col justify-center items-center">
                <div class="text-sm text-gray-500 mb-1">Status</div>
                <div class="text-lg font-normal text-gray-900 flex items-center">
                    <div class="w-3 h-3 rounded-full mr-2 {{ $article->published ? 'bg-green-500' : 'bg-amber-500' }}"></div>
                    {{ $article->published ? 'Published' : 'Draft' }}
                </div>
            </div>

            <div class="p-4 flex flex-col justify-center items-center">
                <div class="text-sm text-gray-500 mb-1">Created</div>
                <div class="text-lg font-normal text-gray-900">
                    {{ $article->created_at ? $article->created_at->format('M d, Y') : 'N/A' }}
                </div>
            </div>

            @if($article->publication_date)
            <div class="p-4 flex flex-col justify-center items-center">
                <div class="text-sm text-gray-500 mb-1">Published</div>
                <div class="text-lg font-normal text-gray-900">
                    {{ \Carbon\Carbon::parse($article->publication_date)->format('M d, Y') }}
                </div>
            </div>
            @else
            <div class="p-4 flex flex-col justify-center items-center">
                <div class="text-sm text-gray-500 mb-1">URL</div>
                <div class="text-sm font-mono text-gray-900 truncate max-w-full">
                    {{ $article->slug }}
                </div>
            </div>
            @endif

            @if($article->views)
            <div class="p-4 flex flex-col justify-center items-center">
                <div class="text-sm text-gray-500 mb-1">Views</div>
                <div class="text-lg font-normal text-gray-900">
                    {{ number_format($article->views) }}
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Quick Actions Card - Google Material Design -->
    <div class="bg-white rounded-lg shadow-sm mb-8 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-normal text-gray-800">Quick Actions</h2>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-1 p-4">
            <!-- Quick action buttons in Material Design style -->
            <button class="flex flex-col items-center justify-center p-4 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <span class="text-sm text-gray-800">Preview</span>
            </button>

            <button class="flex flex-col items-center justify-center p-4 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="text-sm text-gray-800">Publish</span>
            </button>

            <button class="flex flex-col items-center justify-center p-4 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <span class="text-sm text-gray-800">Analytics</span>
            </button>

            <button class="flex flex-col items-center justify-center p-4 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                    </svg>
                </div>
                <span class="text-sm text-gray-800">Share</span>
            </button>
        </div>
    </div>
</div>

<!-- Google-style FAB -->
<div class="fixed bottom-8 right-8 z-10">
    <div class="group relative">
        <button class="w-14 h-14 rounded-full bg-blue-600 text-white flex items-center justify-center shadow-lg hover:bg-blue-700 hover:shadow-xl transition-all duration-200 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
        </button>

        <!-- Speed Dial Menu -->
        <div class="absolute bottom-16 right-0 mb-2 scale-0 transition-transform duration-150 ease-in-out origin-bottom group-hover:scale-100">
            <div class="flex flex-col items-end space-y-2">
                <div class="flex items-center">
                    <span class="bg-white text-gray-800 px-2 py-1 rounded-lg text-sm shadow mr-2">Edit</span>
                    <a href="{{ route('admin.articles.edit', $article) }}" class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shadow-md hover:bg-blue-200 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>
                </div>


            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Google-style smooth scrolling effect for the quick action bar
        const quickActionBar = document.getElementById('quickActionBar');
        let lastScrollTop = 0;

    // Alternative approach
    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const adminHeaderHeight = 64; // 16 * 4 = 64px typically

        if (scrollTop > 200) {
            // Position it with a margin from the top that clears the admin header
            quickActionBar.classList.add('sticky', 'z-9', 'shadow-sm', 'bg-white/95', 'backdrop-blur-md');
            quickActionBar.style.top = adminHeaderHeight + 'px';

            // Rest of your code
        } else {
            quickActionBar.classList.remove('sticky', 'z-9', 'shadow-sm', 'bg-white/95', 'backdrop-blur-md', '-translate-y-full');
            quickActionBar.style.top = '';
        }

        lastScrollTop = scrollTop;
    });

        // Share functionality example
        const shareButton = document.getElementById('shareButton');
        if (shareButton) {
            shareButton.addEventListener('click', function() {
                // Google-style share dialog simulation
                const url = window.location.href;
                const title = "{{ $article->title }}";

                if (navigator.share) {
                    navigator.share({
                        title: title,
                        url: url
                    }).catch(console.error);
                } else {
                    // Fallback - copy to clipboard
                    navigator.clipboard.writeText(url).then(function() {
                        // Show toast notification (simplified)
                        const toast = document.createElement('div');
                        toast.className = 'fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-4 py-2 rounded-full text-sm shadow-lg';
                        toast.textContent = 'Link copied to clipboard';
                        document.body.appendChild(toast);

                        setTimeout(function() {
                            toast.remove();
                        }, 3000);
                    });
                }
            });
        }
        // Dropdown menu functionality
        const dropdownButton = document.getElementById('dropdown-button');
        const dropdownContent = document.getElementById('dropdown-content');
        const dropdownMenu = document.getElementById('dropdown-menu');

        if (dropdownButton && dropdownContent) {
            // Toggle dropdown when button is clicked
            dropdownButton.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdownContent.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!dropdownMenu.contains(e.target)) {
                    dropdownContent.classList.add('hidden');
                }
            });

            // Close dropdown when pressing escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    dropdownContent.classList.add('hidden');
                }
            });
        }
    });
</script>
@endpush

@endsection
