@extends('layouts.admin')

@section('title', 'Test Accommodation Form')

@section('header', 'Test Form')

@section('content')
    <div class="min-h-screen bg-gray-50 p-8">
        <div class="max-w-2xl mx-auto bg-white shadow-md rounded p-8">
            <h1 class="text-2xl font-bold mb-6">Direct Form Test</h1>

            <form action="{{ route('admin.accommodations.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <p class="font-bold">Please correct the following errors:</p>
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                        <input type="text" name="name" id="name" value="Test Accommodation"
                            class="w-full p-2 border rounded" required>
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type *</label>
                        <select name="type" id="type" class="w-full p-2 border rounded" required>
                            <option value="hotel" selected>Hotel</option>
                            <option value="apartment">Apartment</option>
                            <option value="riad">Riad</option>
                            <option value="guesthouse">Guesthouse</option>
                        </select>
                    </div>

                    <div>
                        <label for="city_id" class="block text-sm font-medium text-gray-700 mb-1">City *</label>
                        <select name="city_id" id="city_id" class="w-full p-2 border rounded" required>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address *</label>
                        <input type="text" name="address" id="address" value="123 Test Street"
                            class="w-full p-2 border rounded" required>
                    </div>

                    <div>
                        <label for="price_range" class="block text-sm font-medium text-gray-700 mb-1">Price Range *</label>
                        <select name="price_range" id="price_range" class="w-full p-2 border rounded" required>
                            <option value="budget" selected>Budget</option>
                            <option value="mid-range">Mid-Range</option>
                            <option value="luxury">Luxury</option>
                        </select>
                    </div>

                    <div>
                        <label for="price_min" class="block text-sm font-medium text-gray-700 mb-1">Min Price *</label>
                        <input type="number" name="price_min" id="price_min" value="50" class="w-full p-2 border rounded"
                            required>
                    </div>

                    <div>
                        <label for="price_max" class="block text-sm font-medium text-gray-700 mb-1">Max Price *</label>
                        <input type="number" name="price_max" id="price_max" value="200" class="w-full p-2 border rounded"
                            required>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" id="description"
                            class="w-full p-2 border rounded">This is a test accommodation.</textarea>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <input type="text" name="phone" id="phone" value="123-456-7890" class="w-full p-2 border rounded">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email" value="test@example.com"
                            class="w-full p-2 border rounded">
                    </div>

                    <div>
                        <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                        <input type="url" name="website" id="website" value="https://example.com"
                            class="w-full p-2 border rounded">
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Submit Test Form
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection