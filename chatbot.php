<?php
include_once("include/initialize.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>AI Hotel Assistant - IIMS Hotel</title>
   <meta name="keywords" content="Hotel, booking, AI chatbot, virtual assistant">
   <meta name="description" content="IIMS Hotel AI Assistant - Get instant answers about our hotel services, rooms, and amenities">
   <meta name="author" content="IIMS">

   <!-- bootstrap css -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/jquery-ui.css">
   <!-- style css -->
   <link rel="stylesheet" href="css/style.css">
   <!-- Responsive-->
   <link rel="stylesheet" href="css/responsive.css">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- Google Fonts - Poppins -->
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
   
   <style>
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
      
      body {
         font-family: 'Poppins', 'Helvetica Neue', Arial, sans-serif;
      }
      
      .page-header {
         background: linear-gradient(135deg, var(--primary-color), #2a4fa8);
         color: white;
         padding: 60px 0 80px;
         position: relative;
         margin-bottom: 60px;
      }
      
      .page-header::after {
         content: '';
         position: absolute;
         bottom: 0;
         left: 0;
         right: 0;
         height: 60px;
         background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwJSIgaGVpZ2h0PSI2MHB4IiB2aWV3Qm94PSIwIDAgMTI4MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0iI2YwZjJmNSI+PHBhdGggZD0iTTAgMHYxNDBoMTI4MEwwIDB6Ii8+PC9nPjwvc3ZnPg==');
         background-size: 100% 100%;
         transform: rotateY(180deg);
         z-index: 1;
      }
      
      .page-header h1 {
         font-weight: 700;
         margin-bottom: 5px;
         font-size: 2.5rem;
      }
      
      .page-header p {
         font-size: 1.1rem;
         opacity: 0.9;
         max-width: 600px;
         margin: 0 auto;
      }
      
      .chatbot-container {
         max-width: 900px;
         margin: -40px auto 50px;
         background-color: #fff;
         border-radius: var(--border-radius);
         box-shadow: var(--box-shadow);
         overflow: hidden;
         position: relative;
         z-index: 2;
         border: 1px solid rgba(0,0,0,0.08);
      }
      
      .chatbot-header {
         background: linear-gradient(135deg, var(--primary-color), #2a4fa8);
         color: white;
         padding: 25px;
         text-align: center;
         border-bottom: 2px solid var(--secondary-color);
      }
      
      .chatbot-header h2 {
         margin: 0;
         font-weight: 600;
         display: flex;
         align-items: center;
         justify-content: center;
      }
      
      .chatbot-header h2 i {
         margin-right: 10px;
         color: var(--secondary-color);
      }
      
      .chatbot-header p {
         margin: 10px 0 0;
         font-size: 0.95rem;
         opacity: 0.9;
      }
      
      .chatbot-messages {
         height: 500px;
         padding: 25px;
         overflow-y: auto;
         background-color: #f8f9fa;
         background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1IiBoZWlnaHQ9IjUiPgo8cmVjdCB3aWR0aD0iNSIgaGVpZ2h0PSI1IiBmaWxsPSIjZmZmIj48L3JlY3Q+CjxyZWN0IHdpZHRoPSIxIiBoZWlnaHQ9IjEiIGZpbGw9IiNmNWY1ZjUiPjwvcmVjdD4KPC9zdmc+');
      }
      
      .message {
         margin-bottom: 20px;
         max-width: 85%;
         padding: 15px 20px;
         border-radius: 18px;
         position: relative;
         font-size: 15px;
         line-height: 1.5;
         box-shadow: 0 2px 5px rgba(0,0,0,0.05);
         animation: fadeIn 0.3s ease-out;
      }
      
      @keyframes fadeIn {
         from { opacity: 0; transform: translateY(10px); }
         to { opacity: 1; transform: translateY(0); }
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
      }
      
      .chatbot-input {
         display: flex;
         padding: 20px;
         background-color: white;
         border-top: 1px solid rgba(0,0,0,0.08);
      }
      
      .chatbot-input input {
         flex: 1;
         padding: 15px 20px;
         border: 1px solid #e1e5eb;
         border-radius: 30px;
         font-size: 15px;
         outline: none;
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
         padding: 15px 25px;
         margin-left: 15px;
         border-radius: 30px;
         cursor: pointer;
         font-weight: 600;
         transition: var(--transition);
         display: flex;
         align-items: center;
         justify-content: center;
      }
      
      .chatbot-input button i {
         margin-left: 8px;
      }
      
      .chatbot-input button:hover {
         transform: translateY(-2px);
         box-shadow: 0 5px 15px rgba(30, 58, 138, 0.2);
      }
      
      .typing-indicator {
         display: none;
         padding: 15px 20px;
         background-color: white;
         border-radius: 18px;
         margin-bottom: 20px;
         width: fit-content;
         box-shadow: 0 2px 5px rgba(0,0,0,0.05);
         border-left: 3px solid var(--secondary-color);
         border-bottom-left-radius: 4px;
      }
      
      .typing-indicator span {
         height: 10px;
         width: 10px;
         background-color: var(--secondary-color);
         display: inline-block;
         border-radius: 50%;
         animation: typing 1.3s ease-in-out infinite;
         margin: 0 2px;
      }
      
      .typing-indicator span:nth-child(2) {
         animation-delay: 0.15s;
      }
      
      .typing-indicator span:nth-child(3) {
         animation-delay: 0.3s;
      }
      
      @keyframes typing {
         0% { transform: translateY(0px); }
         28% { transform: translateY(-5px); }
         44% { transform: translateY(0px); }
      }
      
      /* Welcome message animation */
      .welcome-message {
         animation: slideIn 0.5s ease-out forwards;
      }
      
      @keyframes slideIn {
         from { opacity: 0; transform: translateY(20px); }
         to { opacity: 1; transform: translateY(0); }
      }
      
      /* Suggestion chips */
      .suggestion-chip {
         display: inline-block;
         background: linear-gradient(135deg, var(--primary-color), #2a4fa8);
         color: white;
         padding: 8px 15px;
         margin: 5px 5px 5px 0;
         border-radius: 20px;
         font-size: 14px;
         cursor: pointer;
         transition: all 0.2s ease;
         box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      }
      
      .suggestion-chip:hover {
         transform: translateY(-2px);
         box-shadow: 0 4px 8px rgba(0,0,0,0.15);
      }
      
      /* Features section */
      .features-section {
         padding: 60px 0;
         background-color: white;
      }
      
      .feature-card {
         background: white;
         border-radius: var(--border-radius);
         padding: 30px;
         margin-bottom: 30px;
         box-shadow: var(--box-shadow);
         transition: var(--transition);
         height: 100%;
         border-top: 4px solid var(--primary-color);
      }
      
      .feature-card:hover {
         transform: translateY(-5px);
      }
      
      .feature-icon {
         width: 60px;
         height: 60px;
         background: linear-gradient(135deg, var(--primary-color), #2a4fa8);
         color: white;
         border-radius: 50%;
         display: flex;
         align-items: center;
         justify-content: center;
         font-size: 24px;
         margin-bottom: 20px;
      }
      
      .feature-card h3 {
         font-size: 20px;
         margin-bottom: 15px;
         color: var(--primary-color);
      }
      
      /* Responsive */
      @media (max-width: 768px) {
         .page-header {
            padding: 40px 0 60px;
         }
         
         .chatbot-messages {
            height: 400px;
         }
         
         .message {
            max-width: 90%;
         }
      }
   </style>
</head>

<body class="main-layout">
   <!-- loader  -->
   <div class="loader_bg">
      <div class="loader"><img src="images/loading.gif" alt="#" /></div>
   </div>
   <!-- end loader -->
   <!-- header -->
   <header>
      <!-- header inner -->
      <div class="header">
         <div class="container">
            <div class="row">
               <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                  <div class="full">
                     <div class="center-desk">
                        <div class="logo">
                           <a href="index.php"><img src="images/logo.png" alt="#" /></a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                  <nav class="navigation navbar navbar-expand-md navbar-dark ">
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                     </button>
                     <div class="collapse navbar-collapse" id="navbarsExample04">
                        <ul class="navbar-nav mr-auto">
                           <li class="nav-item">
                              <a class="nav-link" href="index.php">Home</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="about.php">About</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="room.php">Our room</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="gallery.php">Gallery</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="blog.php">Blog</a>
                           </li>
                           <li class="nav-item active">
                              <a class="nav-link" href="chatbot.php">Chatbot</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="contact.php">Contact Us</a>
                           </li>
                        </ul>
                     </div>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </header>
   <!-- end header inner -->
   <!-- end header -->

   <!-- Page Header -->
   <div class="page-header text-center">
      <div class="container">
         <h1><i class="fas fa-robot"></i> AI Hotel Assistant</h1>
         <p>Get instant answers about our services, rooms, amenities, and more</p>
      </div>
   </div>

   <!-- Main Content -->
   <div class="container">
      <!-- Chatbot Container -->
      <div class="chatbot-container">
         <div class="chatbot-header">
            <h2><i class="fas fa-concierge-bell"></i> Hotel Assistant</h2>
            <p>Ask me anything about our hotel services and amenities</p>
         </div>
         
         <div class="chatbot-messages" id="chatMessages">
            <!-- Messages will be added here via JavaScript -->
            <div class="typing-indicator" id="typingIndicator">
               <span></span>
               <span></span>
               <span></span>
            </div>
         </div>
         
         <div class="chatbot-input">
            <input type="text" id="userInput" placeholder="Ask about our services..." />
            <button id="sendButton">Send <i class="fas fa-paper-plane"></i></button>
         </div>
      </div>
      
      <!-- Features Section -->
      <div class="features-section">
         <div class="row">
            <div class="col-md-12 mb-5 text-center">
               <h2>How Our AI Assistant Can Help You</h2>
               <p class="lead">Our intelligent virtual assistant is designed to provide you with quick and accurate information</p>
            </div>
         </div>
         <div class="row">
            <div class="col-md-4">
               <div class="feature-card">
                  <div class="feature-icon">
                     <i class="fas fa-info-circle"></i>
                  </div>
                  <h3>Hotel Information</h3>
                  <p>Get details about our facilities, check-in/check-out times, amenities, and services available at the hotel.</p>
               </div>
            </div>
            <div class="col-md-4">
               <div class="feature-card">
                  <div class="feature-icon">
                     <i class="fas fa-bed"></i>
                  </div>
                  <h3>Room Inquiries</h3>
                  <p>Learn about our different room types, pricing, availability, and special accommodation features.</p>
               </div>
            </div>
            <div class="col-md-4">
               <div class="feature-card">
                  <div class="feature-icon">
                     <i class="fas fa-concierge-bell"></i>
                  </div>
                  <h3>Service Requests</h3>
                  <p>Find out how to request room service, housekeeping, or other special services during your stay.</p>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!--  footer -->
   <?php include 'include/footer.php'; ?>
   <!-- end footer -->

   <!-- Javascript files-->
   <script src="js/jquery.min.js"></script>
   <script src="js/bootstrap.bundle.min.js"></script>
   <script src="js/jquery-3.0.0.min.js"></script>
   <!-- sidebar -->
   <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
   <script src="js/custom.js"></script>
   
   <script>
      $(document).ready(function() {
         const chatMessages = document.getElementById('chatMessages');
         const userInput = document.getElementById('userInput');
         const sendButton = document.getElementById('sendButton');
         const typingIndicator = document.getElementById('typingIndicator');
         
         // API endpoint - points to our Python server
         const apiUrl = 'http://localhost:5001';
         
         // Function to add a message to the chat
         function addMessage(message, isUser) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${isUser ? 'user-message' : 'bot-message'}`;
            messageDiv.textContent = message;
            
            // Insert before typing indicator
            chatMessages.insertBefore(messageDiv, typingIndicator);
            
            // Scroll to bottom
            chatMessages.scrollTop = chatMessages.scrollHeight;
         }
         
         // Function to send message to API
         function sendMessage() {
            const message = userInput.value.trim();
            if (message === '') return;
            
            // Add user message to chat
            addMessage(message, true);
            
            // Clear input
            userInput.value = '';
            
            // Show typing indicator
            typingIndicator.style.display = 'block';
            
            // Send to API
            fetch(apiUrl, {
               method: 'POST',
               headers: {
                  'Content-Type': 'application/json'
               },
               body: JSON.stringify({ message: message })
            })
            .then(response => response.json())
            .then(data => {
               // Hide typing indicator
               typingIndicator.style.display = 'none';
               
               // Add bot response
               addMessage(data.response, false);
            })
            .catch(error => {
               console.error('Error:', error);
               typingIndicator.style.display = 'none';
               addMessage('Sorry, I encountered an error. Please try again later.', false);
            });
         }
         
         // Event listeners
         sendButton.addEventListener('click', sendMessage);
         
         userInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
               sendMessage();
            }
         });
         
         // Focus input on page load
         userInput.focus();
      });
   </script>
</body>

</html>
