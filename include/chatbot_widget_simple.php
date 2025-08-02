<!-- Simple Chatbot Widget -->
<div id="chatbot-widget" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;">
    <!-- Chatbot Toggle Button -->
    <div id="chatbot-toggle" style="
        width: 60px; 
        height: 60px; 
        background: #1e3a8a; 
        border-radius: 50%; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        cursor: pointer; 
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        color: white;
        font-size: 24px;
    ">
        💬
    </div>

    <!-- Chatbot Box -->
    <div id="chatbot-box" style="
        position: absolute;
        bottom: 70px;
        right: 0;
        width: 350px;
        height: 450px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        display: none;
        flex-direction: column;
        overflow: hidden;
    ">
        <!-- Header -->
        <div style="background: #1e3a8a; color: white; padding: 15px; display: flex; justify-content: space-between; align-items: center;">
            <h4 style="margin: 0; font-size: 16px; color:white;">🏨 Hotel Assistant</h4>
            <span id="chatbot-close" style="cursor: pointer; font-size: 20px;">&times;</span>
        </div>

        <!-- Messages -->
        <div id="chatbot-messages" style="
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            background: #f8f9fa;
        ">
            <!-- Messages will appear here -->
        </div>

        <!-- Input -->
        <div style="padding: 15px; border-top: 1px solid #eee; background: white;">
            <div style="display: flex; gap: 10px;">
                <input type="text" id="chatbot-input" placeholder="Ask about rooms..." style="
                    flex: 1;
                    padding: 10px;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    outline: none;
                ">
                <button id="chatbot-send" style="
                    padding: 10px 15px;
                    background: #1e3a8a;
                    color: white;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                ">Send</button>
            </div>
        </div>
    </div>
</div>

<style>
    .suggestion-chip {
        display: inline-block;
        background-color: #f1f5f9;
        border: 1px solid #cbd5e1;
        border-radius: 15px;
        padding: 5px 10px;
        margin: 5px 5px 0 0;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s;
    }

    .suggestion-chip:hover {
        background-color: #e2e8f0;
    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('chatbot-toggle');
        const box = document.getElementById('chatbot-box');
        const close = document.getElementById('chatbot-close');
        const input = document.getElementById('chatbot-input');
        const send = document.getElementById('chatbot-send');
        const messages = document.getElementById('chatbot-messages');

        // API URL
        const apiUrl = 'http://localhost:5002/api/chat';

        // Toggle chatbot
        toggle.addEventListener('click', function() {
            box.style.display = box.style.display === 'none' ? 'flex' : 'none';
            if (box.style.display === 'flex' && messages.children.length === 0) {
                addWelcomeMessage();
            }
        });

        // Function to add welcome message with suggestions
        function addWelcomeMessage() {
            const welcomeDiv = document.createElement('div');
            welcomeDiv.style.marginBottom = '10px';
            welcomeDiv.style.padding = '8px 12px';
            welcomeDiv.style.borderRadius = '10px';
            welcomeDiv.style.maxWidth = '80%';
            welcomeDiv.style.background = '#e9ecef';
            welcomeDiv.style.color = '#333';
            welcomeDiv.style.marginRight = 'auto';

            welcomeDiv.innerHTML = `<strong>Welcome to IIMS Hotel!</strong><br>
                I'm your AI assistant, ready to help with information about our services, rooms, and amenities.`;
            messages.appendChild(welcomeDiv);

            setTimeout(() => {
                const suggestionsDiv = document.createElement('div');
                suggestionsDiv.style.marginBottom = '10px';
                suggestionsDiv.style.padding = '8px 12px';
                suggestionsDiv.style.borderRadius = '10px';
                suggestionsDiv.style.maxWidth = '80%';
                suggestionsDiv.style.background = '#e9ecef';
                suggestionsDiv.style.color = '#333';
                suggestionsDiv.style.marginRight = 'auto';
                suggestionsDiv.innerHTML = `
                    You can ask me about:<br>
                    <span class="suggestion-chip" onclick="askSuggestion('What are your check-in and check-out times?')">🕒 Check-in/out</span><br>
                    <span class="suggestion-chip" onclick="askSuggestion('What amenities are available?')">🛎️ Amenities</span><br>
                    <span class="suggestion-chip" onclick="askSuggestion('How can I book a room?')">🛏️ Booking</span>
                `;
                messages.appendChild(suggestionsDiv);
                messages.scrollTop = messages.scrollHeight;
            }, 1000);
        }

        // Function to handle suggestion clicks
        window.askSuggestion = function(question) {
            input.value = question;
            sendMessage();
        };



        // Close chatbot
        close.addEventListener('click', function() {
            box.style.display = 'none';
        });

        // Send message
        function sendMessage() {
            const message = input.value.trim();
            if (!message) return;

            addMessage('user', message);
            input.value = '';

            // Show typing indicator
            addMessage('bot', 'Typing...', true);

            // Send to API
            fetch(apiUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        message: message
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Remove typing indicator
                    const lastMessage = messages.lastElementChild;
                    if (lastMessage && lastMessage.textContent.includes('Typing...')) {
                        messages.removeChild(lastMessage);
                    }

                    addMessage('bot', data.response || 'Sorry, I could not process your request.');
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Remove typing indicator
                    const lastMessage = messages.lastElementChild;
                    if (lastMessage && lastMessage.textContent.includes('Typing...')) {
                        messages.removeChild(lastMessage);
                    }

                    addMessage('bot', 'Sorry, I am having trouble connecting to the server. Please try again later.');
                });
        }

        // Add message to chat
        function addMessage(sender, text, isTyping = false) {
            const messageDiv = document.createElement('div');
            messageDiv.style.marginBottom = '10px';
            messageDiv.style.padding = '8px 12px';
            messageDiv.style.borderRadius = '10px';
            messageDiv.style.maxWidth = '80%';

            if (sender === 'user') {
                messageDiv.style.background = '#1e3a8a';
                messageDiv.style.color = 'white';
                messageDiv.style.marginLeft = 'auto';
                messageDiv.style.textAlign = 'right';
            } else {
                messageDiv.style.background = '#e9ecef';
                messageDiv.style.color = '#333';
                messageDiv.style.marginRight = 'auto';
            }

            if (isTyping) {
                messageDiv.style.fontStyle = 'italic';
                messageDiv.style.opacity = '0.7';
            }

            messageDiv.textContent = text;
            messages.appendChild(messageDiv);
            messages.scrollTop = messages.scrollHeight;
        }

        // Send on button click
        send.addEventListener('click', sendMessage);

        // Send on Enter key
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        console.log('Simple chatbot widget loaded successfully!');
    });
</script>