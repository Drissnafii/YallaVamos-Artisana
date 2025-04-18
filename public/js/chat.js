// Chat functionality for the admin dashboard
document.addEventListener('DOMContentLoaded', function() {
    // Get references to the HTML elements
    const chatInput = document.getElementById('chat-input');
    const sendButton = document.getElementById('send-button');
    const chatOutput = document.getElementById('chat-output');
    
    // Get CSRF token from meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    // Function to display messages in the chat
    function appendMessage(message, sender = 'Bot') {
        const messageElement = document.createElement('div');
        messageElement.classList.add('message', sender.toLowerCase() + '-message');
        
        let messageHTML = '';
        if (sender === 'You') {
            messageHTML = `
                <div class="flex items-start justify-end">
                    <div class="ml-3 bg-blue-50 rounded-lg py-2 px-4 max-w-3xl">
                        <p class="text-sm text-gray-700">${message}</p>
                    </div>
                    <div class="flex-shrink-0 ml-3">
                        <div class="h-8 w-8 rounded-full bg-blue-500 text-white flex items-center justify-center">
                            <span class="text-sm font-medium">You</span>
                        </div>
                    </div>
                </div>
            `;
        } else if (sender === 'System') {
            messageHTML = `
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 rounded-full bg-red-100 text-red-500 p-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="ml-3 bg-red-50 rounded-lg py-2 px-4 max-w-3xl">
                        <p class="text-sm text-gray-700">${message}</p>
                    </div>
                </div>
            `;
        } else {
            // Bot message
            messageHTML = `
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 rounded-full bg-primary text-white p-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714a2.25 2.25 0 01-.659 1.591L9.5 14.5m0-9.143c.251.023.501.05.75.082M9.5 14.5h5.25m-5.25 0v-5.5m0 5.5v5.5m0-5.5l5.25 5.5m-10.5 0h5.25m-5.25 0v-5.5m5.25 5.5v-5.5" />
                        </svg>
                    </div>
                    <div class="ml-3 bg-gray-100 rounded-lg py-2 px-4 max-w-3xl">
                        <p class="text-sm text-gray-700">${message}</p>
                    </div>
                </div>
            `;
        }
        
        messageElement.innerHTML = messageHTML;
        chatOutput.appendChild(messageElement);
        
        // Scroll to the bottom of the chat output
        chatOutput.scrollTop = chatOutput.scrollHeight;
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

        try {
            const response = await fetch('/api/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    // Include CSRF token if needed
                    ...(csrfToken && {'X-CSRF-TOKEN': csrfToken})
                },
                body: JSON.stringify({ message: userMessage })
            });

            const data = await response.json(); // Parse JSON response

            if (response.ok) {
                // API call was successful
                appendMessage(data.reply, 'Bot');
            } else {
                // API returned an error status
                console.error('API Error Response:', data);
                appendMessage(data.error || 'Sorry, something went wrong.', 'System');
            }

        } catch (error) {
            // Network error or other issue with the fetch call
            console.error('Fetch Error:', error);
            appendMessage('Could not connect to the chat service. Please check your connection.', 'System');
        } finally {
            // Re-enable input/button regardless of success or failure
            chatInput.disabled = false;
            sendButton.disabled = false;
            chatInput.focus(); // Focus back on the input field
        }
    }

    // Event Listeners
    // Send when the button is clicked
    sendButton.addEventListener('click', sendMessage);

    // Send when Enter is pressed in the input field
    chatInput.addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent default form submission
            sendMessage();
        }
    });

    // Initial focus
    chatInput.focus();
});
