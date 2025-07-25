<!-- Chatbot Widget - Luxury Hotel Theme -->
<div class="chatbot-widget" id="chatbotWidget">
    <div class="chatbot-toggle" id="chatbotToggle">
        <i class="fa fa-comments"></i>
    </div>
    
    <div class="chatbot-box" id="chatbotBox">
        <div class="chatbot-header">
            <h3><i class="fa fa-robot"></i> Hotel Assistant</h3>
            <span class="chatbot-close" id="chatbotClose">&times;</span>
        </div>
        
        <div class="chatbot-messages" id="widgetMessages">
            <!-- Messages will appear here -->
        </div>
        
        <div class="typing-indicator" id="widgetTypingIndicator">
            <span></span>
            <span></span>
            <span></span>
        </div>
        
        <div class="chatbot-input">
            <input type="text" id="widgetUserMessage" placeholder="Ask about our services..." />
            <button id="widgetSendButton">Send <i class="fa fa-paper-plane"></i></button>
        </div>
    </div>
</div>

<!-- Add Font Awesome if not already included -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Add Google Fonts - Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* Chatbot Widget Styles - Modern Luxury Hotel Theme */
    :root {
        --primary-color: #1e3a8a; /* Deep blue */
        --secondary-color: #c8a97e; /* Gold accent */
        --light-color: #f8f9fa;
        --dark-color: #212529;
        --success-color: #28a745;
        --border-radius: 12px;
        --box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        --transition: all 0.3s ease;
    }
    
    .chatbot-widget {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1000;
        font-family: 'Poppins', 'Helvetica Neue', Arial, sans-serif;
    }
    
    .chatbot-toggle {
        width: 65px;
        height: 65px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), #2a4fa8);
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: var(--box-shadow);
        transition: var(--transition);
        border: 2px solid rgba(255,255,255,0.2);
    }
    
    .chatbot-toggle:hover {
        transform: scale(1.05);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }
    
    .chatbot-toggle i {
        font-size: 28px;
    }
    
    .chatbot-box {
        position: fixed;
        bottom: 110px;
        right: 30px;
        width: 380px;
        height: 520px;
        background-color: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        display: none;
        flex-direction: column;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.08);
        transition: var(--transition);
    }
    
    .chatbot-header {
        background: linear-gradient(135deg, var(--primary-color), #2a4fa8);
        color: white;
        padding: 18px 20px;
        font-weight: 600;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid var(--secondary-color);
    }
    
    .chatbot-header h3 {
        margin: 0;
        font-size: 18px;
        display: flex;
        align-items: center;
        color: #fff;
    }
    
    .chatbot-header h3 i {
        margin-right: 8px;
        color: var(--secondary-color);
    }
    
    .chatbot-close {
        cursor: pointer;
        font-size: 22px;
        color: rgba(255,255,255,0.8);
        transition: var(--transition);
    }
    
    .chatbot-close:hover {
        color: white;
        transform: scale(1.1);
    }
    
    .chatbot-messages {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
        background-color: #f8f9fa;
        background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1IiBoZWlnaHQ9IjUiPgo8cmVjdCB3aWR0aD0iNSIgaGVpZ2h0PSI1IiBmaWxsPSIjZmZmIj48L3JlY3Q+CjxyZWN0IHdpZHRoPSIxIiBoZWlnaHQ9IjEiIGZpbGw9IiNmNWY1ZjUiPjwvcmVjdD4KPC9zdmc+');
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
    
    .message {
        margin-bottom: 18px;
        max-width: 85%;
        padding: 12px 16px;
        border-radius: 18px;
        position: relative;
        font-size: 14px;
        line-height: 1.5;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        animation: fadeIn 0.3s ease-out;
        word-wrap: break-word;
        overflow-wrap: break-word;
        white-space: normal;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .welcome-message {
        animation: slideIn 0.5s ease-out forwards;
    }
    
    @keyframes slideIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .suggestion-chip {
        display: inline-block;
        background: linear-gradient(135deg, var(--primary-color), #2a4fa8);
        color: white;
        padding: 8px 15px;
        margin: 5px 5px 5px 0;
        border-radius: 20px;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .suggestion-chip:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    .user-message {
        background: linear-gradient(135deg, #e6f7ff, #cce5ff);
        margin-left: auto;
        border-bottom-right-radius: 4px;
        color: var(--dark-color);
        text-align: right;
    }
    
    .bot-message {
        background: white;
        margin-right: auto;
        border-bottom-left-radius: 4px;
        color: var(--dark-color);
        border-left: 3px solid var(--secondary-color);
        margin-left: 20px;
    }
    
    .bot-message::before {
        content: '';
        position: absolute;
        left: -36px;
        top: 50%;
        transform: translateY(-50%);
        width: 28px;
        height: 28px;
        background-image: url('data:image/svg+xml;base64,PHN2ZyBmaWxsPSIjNDA0MDQwIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgd2lkdGg9IjI0IiBoZWlnaHQ9IjI0Ij48cGF0aCBkPSJNMjAgMmgtMTRjLTEuMTA0IDAtMiAuODk2LTIgMnYxMmMwIDEuMTA0Ljg5NiAyIDIgMmg0djRMMTggMTZoMnYtMTBjMC0xLjEwNC0uODk2LTItMi0yek0xMiAxMmg4di0yaC04djJ6TTQgMTBoMnYtMmgtMnYyeiIvPjwvc3ZnPg==');
        background-size: contain;
        background-repeat: no-repeat;
        opacity: 0.7;
    }
    
    .chatbot-input {
        display: flex;
        padding: 15px;
        border-top: 1px solid rgba(0,0,0,0.08);
        background-color: white;
    }
    
    .chatbot-input input {
        flex: 1;
        padding: 12px 20px;
        border: 1px solid #e1e5eb;
        border-radius: 30px;
        outline: none;
        font-size: 14px;
        transition: var(--transition);
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
    }
    
    .chatbot-input input:focus {
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 3px rgba(200, 169, 126, 0.2);
    }
    
    .chatbot-input button {
        background: linear-gradient(135deg, var(--primary-color), #2a4fa8);
        color: white;
        border: none;
        padding: 12px 20px;
        margin-left: 10px;
        border-radius: 30px;
        cursor: pointer;
        font-weight: 600;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .chatbot-input button i {
        margin-left: 5px;
    }
    
    .chatbot-input button:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(30, 58, 138, 0.2);
    }
    
    .typing-indicator {
        display: none;
        background-color: #e5e5ea;
        padding: 10px 15px;
        border-radius: 20px;
        margin-bottom: 15px;
        max-width: 75%;
        border-bottom-left-radius: 5px;
    }
    
    .typing-indicator span {
        height: 8px;
        width: 8px;
        float: left;
        margin: 0 1px;
        background-color: #9E9EA1;
        display: block;
        border-radius: 50%;
        opacity: 0.4;
    }
    
    .typing-indicator span:nth-of-type(1) {
        animation: 1s blink infinite 0.3333s;
    }
    
    .typing-indicator span:nth-of-type(2) {
        animation: 1s blink infinite 0.6666s;
    }
    
    .typing-indicator span:nth-of-type(3) {
        animation: 1s blink infinite 0.9999s;
    }
    
    @keyframes blink {
        50% {
            opacity: 1;
        }
    }
</style>

<script>
    // DOM elements
    const chatbotToggle = document.getElementById('chatbotToggle');
    const chatbotBox = document.getElementById('chatbotBox');
    const chatbotClose = document.getElementById('chatbotClose');
    const messagesContainer = document.getElementById('widgetMessages');
    const userInput = document.getElementById('widgetUserMessage');
    const sendButton = document.getElementById('widgetSendButton');
    const typingIndicator = document.getElementById('widgetTypingIndicator');
    
    // API endpoint - points to our Python server
    const apiUrl = 'http://localhost:5001';
    
    // Toggle chatbot
    chatbotToggle.addEventListener('click', function() {
        chatbotBox.style.display = 'flex';
        chatbotToggle.style.display = 'none';
        
        // If this is the first time opening, add welcome message
        if (messagesContainer.children.length === 0) {
            setTimeout(() => {
                addWelcomeMessage();
            }, 500);
        }
    });
    
    chatbotClose.addEventListener('click', function() {
        chatbotBox.style.display = 'none';
        chatbotToggle.style.display = 'flex';
    });
    
    // Send message when button is clicked
    sendButton.addEventListener('click', sendMessage);
    
    // Send message when Enter key is pressed
    userInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });
    
    // Function to add welcome message sequence
    function addWelcomeMessage() {
        // Add bot welcome message with animation
        const welcomeDiv = document.createElement('div');
        welcomeDiv.classList.add('message', 'bot-message', 'welcome-message');
        welcomeDiv.innerHTML = `<strong>Welcome to IIMS Hotel!</strong><br>I'm your AI assistant, ready to help with information about our services, rooms, and amenities.`;
        messagesContainer.appendChild(welcomeDiv);
        
        // Add suggestion prompts after a delay
        setTimeout(() => {
            const suggestionsDiv = document.createElement('div');
            suggestionsDiv.classList.add('message', 'bot-message', 'welcome-message');
            suggestionsDiv.innerHTML = `You can ask me about:<br>
                <span class="suggestion-chip" onclick="askSuggestion('What are the check-in and check-out times?')">Check-in/out times</span>
                <span class="suggestion-chip" onclick="askSuggestion('What amenities are available?')">Hotel amenities</span>
                <span class="suggestion-chip" onclick="askSuggestion('How can I book a room?')">Booking info</span>`;
            messagesContainer.appendChild(suggestionsDiv);
            
            // Scroll to bottom
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }, 1000);
    }
    
    // Function to handle suggestion clicks
    window.askSuggestion = function(question) {
        userInput.value = question;
        sendMessage();
    }
    
    // Function to send message
    function sendMessage() {
        const message = userInput.value.trim();
        if (message === '') return;
        
        // Add user message to chat
        addMessage(message, true);
        
        // Clear input
        userInput.value = '';
        
        // Show typing indicator
        typingIndicator.style.display = 'block';
        
        // Scroll to bottom to show typing indicator
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
        
        // Send message to API
        fetch(apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
            // Log the full response from the server
            console.log('Server response:', data);
            
            // Hide typing indicator after a realistic delay
            setTimeout(() => {
                typingIndicator.style.display = 'none';
                
                // Add bot response to chat - ensure we have the full response
                if (data && data.response) {
                    addMessage(data.response, false);
                } else {
                    addMessage('Sorry, I could not process your request properly.', false);
                }
            }, 700 + Math.random() * 1000); // Random delay between 700-1700ms for realism
        })
        .catch(error => {
            // Hide typing indicator
            typingIndicator.style.display = 'none';
            
            // Add error message
            addMessage('Sorry, I\'m having trouble connecting to the server. Please try again later.', false);
            console.error('Error:', error);
        });
    }
    
    // Function to add message to chat
    function addMessage(text, isUser) {
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('message');
        messageDiv.classList.add(isUser ? 'user-message' : 'bot-message');
        
        // Process message text to handle URLs and formatting
        const processedText = text
            .replace(/\n/g, '<br>')
            .replace(/(https?:\/\/[^\s]+)/g, '<a href="$1" target="_blank">$1</a>');
        
        // Ensure the full text is displayed
        messageDiv.innerHTML = processedText;
        messagesContainer.appendChild(messageDiv);
        
        // Log the full message for debugging
        console.log('Message added:', text);
        
        // Scroll to bottom
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
</script>
