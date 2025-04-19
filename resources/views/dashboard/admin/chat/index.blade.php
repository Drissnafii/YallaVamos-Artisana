@extends('layouts.admin')

@section('title', 'AI Assistant')
@section('header', 'AI Assistant')

@section('content')
<div class="h-full w-full flex flex-col">
    <!-- Main chat container with simplified design and smooth edges -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden flex flex-col h-[calc(100vh-275px)]">
        <!-- Header -->
        <div class="bg-primary p-3 flex items-center gap-3 rounded-t-2xl z-5">
            <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center flex-shrink-0">
                <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
            </div>
            <h3 class="font-medium text-white">Morocco 2030 World Cup Assistant</h3>
        </div>

        <!-- Chat messages container - Fixed scrollable container with flex-grow -->
        <div id="chat-output" class="flex-1 p-4 space-y-4 bg-gray-50 overflow-y-auto" style="height: calc(100vh - 380px); min-height: 300px;">
            <!-- Bot message - Welcome -->
            <div class="message bot-message">
                <div class="flex items-start gap-3 max-w-[85%]">
                    <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white flex-shrink-0">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </div>
                    <div class="bg-white rounded-2xl py-2 px-3 shadow-sm border border-gray-200">
                        <p class="text-gray-800">Hello! I'm your AI assistant for the Morocco 2030 World Cup project. How can I help you today?</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick reply suggestions -->
        <div class="px-4 py-3 bg-white border-t border-gray-200 flex flex-wrap gap-2 justify-center">
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
    </div>

    <!-- New Tailwind Chat Input - Positioned below the main chat window -->
    <div class="mt-10 flex justify-center relative">
        <!-- Typing indicator positioned above the input -->
        <div id="typing-indicator" class="hidden items-center gap-2 mb-2 px-3 py-2 bg-white rounded-lg shadow-sm border border-gray-200 w-fit absolute -top-10 left-1/2 transform -translate-x-1/2">
            <div class="flex space-x-1">
                <div class="w-2 h-2 bg-primary rounded-full animate-bounce" style="animation-delay: 0ms"></div>
                <div class="w-2 h-2 bg-primary rounded-full animate-bounce" style="animation-delay: 150ms"></div>
                <div class="w-2 h-2 bg-primary rounded-full animate-bounce" style="animation-delay: 300ms"></div>
            </div>
            <span class="text-xs font-medium text-primary">Typing a response...</span>
        </div>

        <!-- Chat input form - Simplified without emoji buttons, width reduced by 50% -->
        <form id="chat-form" class="flex items-center w-1/2">
            <div class="flex items-center w-full bg-white rounded-full border border-gray-200 shadow-sm overflow-hidden">
                <!-- Chat input field with auto-height adjustment -->
                <div class="flex-1 px-4 py-2 min-h-[40px] max-h-[120px] relative">
                    <textarea
                        id="chat-input"
                        rows="1"
                        class="block w-full bg-transparent border-none focus:outline-none focus:ring-0 text-gray-700 text-sm resize-none overflow-hidden py-0 m-0 h-auto"
                        placeholder="Ask me anything about the World Cup 2030..."
                        style="height: 24px; max-height: 100px; min-height: 24px;"
                    ></textarea>
                </div>

                <!-- Send button -->
                <button
                    type="submit"
                    id="send-button"
                    class="bg-primary hover:bg-primary-dark text-white rounded-full w-8 h-8 flex items-center justify-center transition-colors mr-1"
                    disabled
                >
                    <svg
                        class="h-4 w-4 transform rotate-90"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                        />
                    </svg>
                </button>
            </div>
        </form>
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

    // Auto-resize textarea logic
    function autoResizeTextarea() {
        // Reset height to auto to calculate the new height based on content
        chatInput.style.height = '24px';

        // Calculate new height (scrollHeight is content height + padding)
        const newHeight = Math.min(chatInput.scrollHeight, 100); // Maximum height is 100px

        // Set the new height
        chatInput.style.height = newHeight + 'px';

        // Enable/disable send button based on content
        sendButton.disabled = chatInput.value.trim() === '';
    }

    // Apply auto-resize on input
    chatInput.addEventListener('input', autoResizeTextarea);

    // Get CSRF token from meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    // Function to display messages in the chat
    function appendMessage(message, sender = 'Bot') {
        const messageElement = document.createElement('div');
        messageElement.classList.add('message', 'transition-opacity', 'duration-300', 'opacity-0');

        if (sender === 'You') {
            messageElement.classList.add('user-message');
            messageElement.innerHTML = `
                <div class="flex items-start gap-3 flex-row-reverse max-w-[85%] ml-auto">
                    <div class="w-8 h-8 rounded-full bg-green-600 flex items-center justify-center text-white flex-shrink-0">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="bg-green-600 text-white rounded-2xl py-2 px-3 shadow-sm">
                        <p>${message}</p>
                    </div>
                </div>
            `;
        } else if (sender === 'System') {
            messageElement.classList.add('system-message');
            messageElement.innerHTML = `
                <div class="flex justify-center">
                    <div class="bg-yellow-50 border border-yellow-200 rounded-xl py-2 px-4 text-yellow-800 text-sm inline-flex items-center">
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
                    <div class="bg-white rounded-2xl py-2 px-3 shadow-sm border border-gray-200">
                        <p class="text-gray-800">${message}</p>
                    </div>
                </div>
            `;
        }

        // Add to the chat container
        chatOutput.appendChild(messageElement);

        // Show message with fade in
        setTimeout(() => {
            messageElement.classList.remove('opacity-0');
            messageElement.classList.add('opacity-100');
        }, 10);

        // Scroll to the bottom of the chat output
        setTimeout(() => {
            chatOutput.scrollTop = chatOutput.scrollHeight;
        }, 50);
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

        // Reset textarea height
        chatInput.style.height = '24px';

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
            sendButton.disabled = true; // Button remains disabled until text is entered
            chatInput.focus(); // Focus back on the input field
        }
    }

    // Quick reply buttons handling
    document.querySelectorAll('.px-3.py-1\\.5').forEach(button => {
        button.addEventListener('click', function() {
            const buttonText = this.textContent.trim();
            chatInput.value = buttonText;
            // Trigger the autoResize for the new content
            autoResizeTextarea();
            sendMessage();
        });
    });

    // Event Listeners
    sendButton.addEventListener('click', function(e) {
        e.preventDefault();
        sendMessage();
    });

    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        sendMessage();
    });

    chatInput.addEventListener('keydown', function(event) {
        // Allow Enter to send, but Shift+Enter for new line
        if (event.key === 'Enter' && !event.shiftKey) {
            event.preventDefault();
            sendMessage();
        }
    });

    // Initialize - disable send button until text is entered
    sendButton.disabled = true;

    // Initial focus
    chatInput.focus();
});
</script>
@endpush
