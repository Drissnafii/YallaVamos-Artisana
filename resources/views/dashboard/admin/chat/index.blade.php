@extends('layouts.admin')

@section('title', 'AI Assistant')
@section('header', 'AI Assistant')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Main chat container that matches admin template styling -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <!-- Header -->
        <div class="bg-primary p-3 flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center flex-shrink-0">
                <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
            </div>
            <h3 class="font-medium text-white">Morocco 2030 World Cup Assistant</h3>
        </div>

        <!-- Chat messages container -->
        <div id="chat-output" class="h-96 overflow-y-auto p-4 space-y-4 bg-gray-50">
            <!-- Bot message - Welcome -->
            <div class="message bot-message">
                <div class="flex items-start gap-3 max-w-[85%]">
                    <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white flex-shrink-0">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </div>
                    <div class="bg-white rounded-lg py-2 px-3 shadow-sm border border-gray-200">
                        <p class="text-gray-800">Hello! I'm your AI assistant for the Morocco 2030 World Cup project. How can I help you today?</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick reply suggestions -->
        <div class="px-4 py-3 bg-white border-t border-gray-200 flex flex-wrap gap-2">
            <button class="px-3 py-1.5 bg-gray-50 text-gray-700 rounded-full text-sm border border-gray-200 hover:bg-gray-100 transition-colors flex items-center gap-1">
                <span class="text-base">🏟️</span> Host Cities
            </button>
            <button class="px-3 py-1.5 bg-gray-50 text-gray-700 rounded-full text-sm border border-gray-200 hover:bg-gray-100 transition-colors flex items-center gap-1">
                <span class="text-base">⚽</span> Teams
            </button>
            <button class="px-3 py-1.5 bg-gray-50 text-gray-700 rounded-full text-sm border border-gray-200 hover:bg-gray-100 transition-colors flex items-center gap-1">
                <span class="text-base">🏨</span> Accommodations
            </button>
            <button class="px-3 py-1.5 bg-gray-50 text-gray-700 rounded-full text-sm border border-gray-200 hover:bg-gray-100 transition-colors flex items-center gap-1">
                <span class="text-base">✈️</span> Travel Tips
            </button>
            <button class="px-3 py-1.5 bg-gray-50 text-gray-700 rounded-full text-sm border border-gray-200 hover:bg-gray-100 transition-colors flex items-center gap-1">
                <span class="text-base">🍽️</span> Local Cuisine
            </button>
        </div>

        <!-- Chat input -->
        <div class="border-t border-gray-200 p-4 bg-white">
            <form id="chat-form" class="relative">
                <input
                    type="text"
                    id="chat-input"
                    class="w-full bg-gray-50 border border-gray-200 rounded-lg py-2 pl-4 pr-12 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all text-gray-800 placeholder-gray-500"
                    placeholder="Ask something about Morocco or the 2030 World Cup..."
                    autocomplete="off"
                >
                <div class="absolute right-2 top-1/2 transform -translate-y-1/2 flex items-center gap-1">
                    <div id="typing-indicator" class="hidden mr-2">
                        <div class="flex gap-1">
                            <div class="h-2 w-2 bg-primary rounded-full animate-bounce" style="animation-delay: 0s"></div>
                            <div class="h-2 w-2 bg-primary rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                            <div class="h-2 w-2 bg-primary rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                        </div>
                    </div>
                    <button
                        type="button"
                        id="send-button"
                        class="bg-primary text-white p-2 rounded-lg transition-colors hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
                        aria-label="Send message"
                    >
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Usage hint -->
    <div class="mt-4 bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
        <h3 class="font-medium text-gray-800 mb-2">Quick Tips</h3>
        <ul class="text-sm text-gray-600 space-y-1">
            <li class="flex items-start gap-2">
                <svg class="h-5 w-5 text-primary flex-shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Use the AI assistant to answer common user questions about the tournament</span>
            </li>
            <li class="flex items-start gap-2">
                <svg class="h-5 w-5 text-primary flex-shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Quick reply buttons can help guide conversations and showcase available information</span>
            </li>
            <li class="flex items-start gap-2">
                <svg class="h-5 w-5 text-primary flex-shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>The assistant can provide information about cities, stadiums, teams, and more</span>
            </li>
        </ul>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get references to the HTML elements
    const chatInput = document.getElementById('chat-input');
    const sendButton = document.getElementById('send-button');
    const chatOutput = document.getElementById('chat-output');
    const chatForm = document.getElementById('chat-form');
    const typingIndicator = document.getElementById('typing-indicator');

    // Get CSRF token from meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    // Function to display messages in the chat
    function appendMessage(message, sender = 'Bot') {
        const messageElement = document.createElement('div');
        messageElement.classList.add('message', 'transform', 'transition-all', 'duration-300', 'translate-y-4', 'opacity-0');

        if (sender === 'You') {
            messageElement.classList.add('user-message');
            messageElement.innerHTML = `
                <div class="flex items-start gap-3 flex-row-reverse max-w-[85%] ml-auto">
                    <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white flex-shrink-0">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="bg-blue-500 text-white rounded-lg py-2 px-3 shadow-sm">
                        <p>${message}</p>
                    </div>
                </div>
            `;
        } else if (sender === 'System') {
            messageElement.classList.add('system-message');
            messageElement.innerHTML = `
                <div class="flex justify-center">
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg py-2 px-4 text-yellow-800 text-sm inline-flex items-center">
                        <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        ${message}
                    </div>
                </div>
            `;
        } else {
            // Bot message
            messageElement.classList.add('bot-message');
            messageElement.innerHTML = `
                <div class="flex items-start gap-3 max-w-[85%]">
                    <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white flex-shrink-0">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </div>
                    <div class="bg-white rounded-lg py-2 px-3 shadow-sm border border-gray-200">
                        <p class="text-gray-800">${message}</p>
                    </div>
                </div>
            `;
        }

        chatOutput.appendChild(messageElement);

        // Scroll to the bottom of the chat output
        chatOutput.scrollTop = chatOutput.scrollHeight;

        // Animate the message appearance
        setTimeout(() => {
            messageElement.classList.remove('translate-y-4', 'opacity-0');
        }, 10);
    }

    // Function to handle sending the message
    async function sendMessage() {
        const userMessage = chatInput.value.trim();
        if (!userMessage) {
            return; // Don't send empty messages
        }

        // Display user's message immediately
        appendMessage(userMessage, 'You');
        chatInput.value = ''; // Clear the input field
        chatInput.disabled = true; // Disable input while waiting
        sendButton.disabled = true; // Disable button while waiting

        // Show typing indicator
        typingIndicator.classList.remove('hidden');
        typingIndicator.classList.add('flex');

        try {
            const response = await fetch('/api/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    ...(csrfToken && {'X-CSRF-TOKEN': csrfToken})
                },
                body: JSON.stringify({ message: userMessage })
            });

            const data = await response.json();

            // Hide typing indicator
            typingIndicator.classList.add('hidden');
            typingIndicator.classList.remove('flex');

            if (response.ok) {
                // API call was successful
                appendMessage(data.reply, 'Bot');
            } else {
                // API returned an error status
                console.error('API Error Response:', data);
                appendMessage(data.error || 'Sorry, something went wrong.', 'System');
            }

        } catch (error) {
            // Network error or other issue
            console.error('Fetch Error:', error);
            typingIndicator.classList.add('hidden');
            typingIndicator.classList.remove('flex');
            appendMessage('Could not connect to the chat service. Please check your connection.', 'System');
        } finally {
            // Re-enable input/button
            chatInput.disabled = false;
            sendButton.disabled = false;
            chatInput.focus(); // Focus back on the input field
        }
    }

    // Quick reply buttons handling
    document.querySelectorAll('.px-3.py-1\\.5').forEach(button => {
        button.addEventListener('click', function() {
            const buttonText = this.textContent.trim();
            chatInput.value = buttonText;
            sendMessage();
        });
    });

    // Event Listeners
    sendButton.addEventListener('click', function() {
        sendMessage();
    });

    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        sendMessage();
    });

    chatInput.addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            sendMessage();
        }
    });

    // Initial focus
    chatInput.focus();
});
</script>
@endpush
