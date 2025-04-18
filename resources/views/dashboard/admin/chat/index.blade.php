@extends('layouts.admin')

@section('title', 'AI Assistant')
@section('header', 'AI Assistant')

@section('content')
<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="p-4 border-b">
        <h2 class="text-lg font-medium text-gray-900">Chat with AI Assistant</h2>
        <p class="text-sm text-gray-500">Ask questions about Morocco, the World Cup, or anything related to the project.</p>
    </div>
    
    <!-- Chat messages container -->
    <div id="chat-output" class="p-4 h-96 overflow-y-auto space-y-4">
        <div class="message bot-message">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-8 w-8 rounded-full bg-primary text-white p-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714a2.25 2.25 0 01-.659 1.591L9.5 14.5m0-9.143c.251.023.501.05.75.082M9.5 14.5h5.25m-5.25 0v-5.5m0 5.5v5.5m0-5.5l5.25 5.5m-10.5 0h5.25m-5.25 0v-5.5m5.25 5.5v-5.5" />
                    </svg>
                </div>
                <div class="ml-3 bg-gray-100 rounded-lg py-2 px-4 max-w-3xl">
                    <p class="text-sm text-gray-700">Hello! I'm your AI assistant. How can I help you with information about Morocco, the 2030 World Cup, or anything else related to the project?</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Chat input form -->
    <div class="border-t p-4 bg-gray-50">
        <div class="flex space-x-3">
            <input 
                type="text" 
                id="chat-input" 
                class="flex-1 focus:ring-primary focus:border-primary block w-full rounded-md sm:text-sm border-gray-300" 
                placeholder="Type your message here..."
            >
            <button 
                type="button" 
                id="send-button"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
            >
                <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
                Send
            </button>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .message {
        margin-bottom: 1rem;
    }
    .user-message .ml-3 {
        background-color: #e9f5ff;
        margin-left: auto;
        margin-right: 0;
    }
    .system-message .ml-3 {
        background-color: #fff0f0;
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('js/chat.js') }}"></script>
@endpush
