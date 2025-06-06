@php
    $bgColor = match($type ?? 'success') {
        'success' => 'bg-green-100 border-green-500 text-green-700',
        'error' => 'bg-red-100 border-red-500 text-red-700',
        'warning' => 'bg-yellow-100 border-yellow-500 text-yellow-800',
        'info' => 'bg-blue-100 border-blue-500 text-blue-700',
        default => 'bg-green-100 border-green-500 text-green-700'
    };
@endphp

<div class="flash-message {{ $bgColor }} border-l-4 p-4 mb-6 relative" role="alert">
    <button class="flash-close absolute top-0 right-0 mt-2 mr-2 text-gray-600 hover:text-gray-800 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </button>
    <p>{{ $message }}</p>
</div>
