@extends('layouts.admin')

@section('title', $accommodation->name)

@section('header', 'Accommodation Details')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6 flex justify-between">
        <a href="{{ route('admin.accommodations.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Accommodations
        </a>
        <div class="flex space-x-2">
            <a href="{{ route('admin.accommodations.edit', $accommodation) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
                Edit
            </a>
            <form action="{{ route('admin.accommodations.destroy', $accommodation) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md shadow transition duration-150 ease-in-out" onclick="return confirm('Are you sure you want to delete this accommodation?')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    Delete
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="md:flex">
            <!-- Accommodation Image -->
            <div class="md:w-1/3 bg-blue-50">
                @if($accommodation->image)
                    <div class="relative h-full min-h-[250px]">
                        <img src="{{ asset('storage/' . $accommodation->image) }}" alt="{{ $accommodation->name }}" class="w-full h-full object-cover absolute inset-0">
                    </div>
                @else
                    <div class="h-full min-h-[250px] flex items-center justify-center p-8 bg-blue-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Accommodation Information -->
            <div class="md:w-2/3 p-6">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-800">{{ $accommodation->name }}</h1>
                    <div class="flex space-x-2">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ ucfirst($accommodation->type) }}
                        </span>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full
                            {{ $accommodation->price_range === 'luxury' ? 'bg-purple-100 text-purple-800' :
                               ($accommodation->price_range === 'mid-range' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ ucfirst($accommodation->price_range) }}
                        </span>
                    </div>
                </div>

                <div class="mt-4 prose max-w-none text-gray-700">
                    {{ $accommodation->description ?? 'No description available.' }}
                </div>

                <div class="mt-6 space-y-4">
                    <div>
                        <h2 class="text-sm font-medium text-gray-500">Location</h2>
                        <div class="mt-1">
                            <p class="text-gray-900">{{ $accommodation->address }}</p>
                            <p class="text-gray-600">{{ $accommodation->city->name }}</p>
                        </div>
                    </div>

                    @if($accommodation->phone || $accommodation->email || $accommodation->website)
                    <div>
                        <h2 class="text-sm font-medium text-gray-500">Contact Information</h2>
                        <div class="mt-1 space-y-1">
                            @if($accommodation->phone)
                                <p class="text-gray-900">Phone: {{ $accommodation->phone }}</p>
                            @endif
                            @if($accommodation->email)
                                <p class="text-gray-900">Email: <a href="mailto:{{ $accommodation->email }}" class="text-blue-600 hover:text-blue-800">{{ $accommodation->email }}</a></p>
                            @endif
                            @if($accommodation->website)
                                <p class="text-gray-900">Website: <a href="{{ $accommodation->website }}" target="_blank" class="text-blue-600 hover:text-blue-800">{{ $accommodation->website }}</a></p>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
