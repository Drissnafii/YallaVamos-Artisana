@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">{{ $article->title }}</h1>
        <div class="flex space-x-2">
            <a href="{{ route('member.articles.edit', $article) }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                Edit
            </a>
            <form action="{{ route('member.articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                    Delete
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        @if($article->hasMedia('images'))
            <div class="mb-6">
                <img src="{{ $article->getFirstMediaUrl('images') }}" alt="{{ $article->title }}" class="w-full h-auto rounded-lg">
            </div>
        @endif

        <div class="prose max-w-none">
            {!! $article->content !!}
        </div>

        <div class="mt-6 pt-6 border-t border-gray-200 text-sm text-gray-500">
            Created: {{ $article->created_at->format('M d, Y \\a\\t h:i A') }}
            @if($article->created_at != $article->updated_at)
                <br>Last updated: {{ $article->updated_at->format('M d, Y \\a\\t h:i A') }}
            @endif
        </div>
    </div>
</div>
@endsection
