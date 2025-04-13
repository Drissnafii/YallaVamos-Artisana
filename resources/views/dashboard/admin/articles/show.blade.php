@extends('layouts.admin')

@section('title', 'Manage Articles')

@section('header', 'Article Management')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">{{ $article->title }}</h1>
        <div class="flex space-x-2">
            <a href="{{ route('admin.articles.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded transition duration-150 ease-in-out flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back
            </a>
            <a href="{{ route('admin.articles.edit', $article) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-medium py-2 px-4 rounded transition duration-150 ease-in-out flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
                Edit
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
        <div class="p-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <div class="text-sm text-gray-500 mb-1">
                        {{ $article->user ? 'By ' . $article->user->name : 'Unknown author' }} |
                        {{ $article->created_at ? $article->created_at->format('M d, Y') : 'N/A' }}
                    </div>
                    <div class="flex items-center">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            {{ $article->published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $article->published ? 'Published' : 'Draft' }}
                        </span>
                        @if($article->publication_date)
                        <span class="ml-2 text-sm text-gray-500">
                            Publication date: {{ \Carbon\Carbon::parse($article->publication_date)->format('M d, Y') }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="text-sm text-gray-500">
                    <p>Slug: <span class="font-mono text-gray-700">{{ $article->slug }}</span></p>
                </div>
            </div>

            @if($article->image)
            <div class="mb-6">
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-auto rounded-lg object-cover max-h-96">
            </div>
            @endif

            <div class="prose max-w-none">
                {!! nl2br(e($article->content)) !!}
            </div>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-900">Comments ({{ $article->comments->count() }})</h2>
        </div>

        <div class="divide-y divide-gray-200">
            @forelse($article->comments as $comment)
            <div class="p-6">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500 font-medium">{{ substr($comment->user->name ?? 'A', 0, 1) }}</span>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <div class="flex items-center justify-between">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $comment->user->name ?? 'Anonymous' }}
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ $comment->created_at->format('M d, Y H:i') }}
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-gray-700">
                            {{ $comment->content }}
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-6 text-center text-gray-500">
                No comments yet.
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
