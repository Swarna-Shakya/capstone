# AI-Powered Hotel Chatbot System

## Project Overview

Our hotel booking website features an advanced AI-powered chatbot that provides automated customer service to website visitors. The chatbot uses natural language processing techniques to understand user queries and deliver relevant information about hotel services, amenities, bookings, and more.

## AI Implementation

### Natural Language Processing (NLP)

Our chatbot employs several NLP techniques to understand and respond to user queries:

1. **Text Preprocessing**: User queries undergo cleaning and normalization to remove punctuation and convert to lowercase, ensuring consistent processing.

2. **Intent Recognition**: The system identifies the intent behind user questions by analyzing keywords and patterns, categorizing queries into types such as contact inquiries, booking questions, room information, and facility inquiries.

3. **Pattern Matching Algorithm**: We developed a sophisticated matching algorithm that:
   - Calculates word overlap between user queries and our knowledge base
   - Measures query coverage percentage
   - Applies keyword-based scoring bonuses for contextual relevance
   - Uses weighted scoring to prioritize the most relevant responses

4. **Context-Aware Responses**: When no exact match is found in our dataset, the system provides intelligent fallback responses based on the detected query type, ensuring users always receive helpful information.

### Dataset and Knowledge Base

The AI is trained on a comprehensive dataset containing 519 question-answer pairs specifically curated for hotel customer service. This dataset covers:

- Room information and amenities
- Booking and reservation procedures
- Hotel facilities and services
- Check-in/check-out policies
- Payment options
- Special requests handling
- Local attractions and transportation

### Technical Architecture

1. **Backend AI Engine**: Python-based NLP system that processes queries and generates responses
2. **API Layer**: Lightweight HTTP server that exposes the AI functionality via RESTful endpoints
3. **Frontend Integration**: Seamless embedding into the website through both a floating widget and dedicated chat page
4. **Real-time Processing**: Asynchronous communication for immediate responses without page reloads

## Development Process

### Challenges and Solutions

1. **Challenge**: Creating an accurate response matching system without heavy dependencies
   **Solution**: Developed a custom lightweight algorithm using word overlap, coverage scoring, and intent detection

2. **Challenge**: Handling diverse user queries with varying phrasing
   **Solution**: Implemented keyword categorization and context-aware fallback responses

3. **Challenge**: Seamless integration between PHP frontend and Python AI backend
   **Solution**: Created a cross-origin compatible API with proper error handling

### Testing and Refinement

Our chatbot underwent multiple iterations of testing and refinement:

1. Initial development with basic word matching
2. Enhanced with improved scoring algorithms
3. Further refined with keyword categorization and intent detection
4. Final version with context-aware fallback responses

## Presentation Q&A Preparation

### Anticipated Questions

**Q: How does your chatbot understand user questions?**  
A: Our chatbot uses natural language processing techniques to analyze user queries, extract key terms, identify intent, and match against our knowledge base using a sophisticated scoring algorithm that considers word overlap, query coverage, and contextual relevance.

**Q: Is this truly AI or just a simple keyword matching system?**  
A: While our system doesn't use deep learning neural networks, it employs AI techniques including natural language processing, pattern recognition, intent classification, and context-aware response generation. It's a rule-based AI system designed for efficient hotel customer service.

**Q: How accurate is your chatbot in providing responses?**  
A: Our chatbot achieves high accuracy through multiple matching techniques and fallback mechanisms. The system uses a weighted scoring algorithm that considers several factors to find the most relevant response, and when no good match exists, it provides context-appropriate information based on the detected query type.

**Q: How did you build and train the AI?**  
A: We created a specialized dataset of 519 hotel-related Q&A pairs. Rather than traditional ML training, we implemented a sophisticated matching algorithm that analyzes queries and finds the most relevant answers based on multiple scoring factors. The system was iteratively refined through testing with various query types.

**Q: What makes your chatbot better than simple FAQ systems?**  
A: Unlike basic FAQ systems that require exact keyword matches, our chatbot understands variations in phrasing, identifies the intent behind questions, and provides context-aware responses even when no exact match exists. It also categorizes queries to deliver more relevant information.

**Q: How can the chatbot be improved in the future?**  
A: Future enhancements could include implementing machine learning models for better pattern recognition, adding sentiment analysis to detect customer frustration, incorporating a session-based memory to remember conversation context, and expanding the knowledge base with more Q&A pairs.

**Q: How does the chatbot handle queries it doesn't understand?**  
A: When the chatbot cannot find a good match in its knowledge base, it analyzes the query type (contact, booking, room, or facility) and provides a relevant default response. If it cannot determine the query type, it offers a general response encouraging the user to ask about specific hotel topics.

## Technical Implementation Details

### Backend (Python)
- Custom NLP processing with text normalization and pattern matching
- Lightweight HTTP server using Python's built-in libraries
- CSV dataset parsing with multiple encoding support
- Cross-origin resource sharing (CORS) for frontend integration

### Frontend (PHP/JavaScript)
- Responsive chat interface with real-time interaction
- Asynchronous AJAX communication with the AI backend
- Floating widget that can be toggled on any page
- Dedicated full-page chat interface for extended conversations

### Integration
- The chatbot is embedded in the website footer for global availability
- API endpoints handle query processing and response generation
- Error handling for network issues and server unavailability

## Conclusion

Our AI-powered chatbot represents a significant enhancement to the hotel website's customer service capabilities. By automating responses to common inquiries, we improve user experience while reducing the workload on human staff. The implementation demonstrates practical application of AI techniques in a real-world hospitality context.

## Setup Instructions

### 1. Install Python Dependencies

Open a terminal in this directory and run:

```bash
pip install -r requirements.txt
```

This will install all the required Python packages including Flask, NLTK, pandas, and scikit-learn.

### 2. Start the Flask API Server

From this directory, run:

```bash
python app.py
```

This will start the Flask server on http://localhost:5000.

### 3. Test the API

The API should now be running and accessible from your PHP website. The chatbot widget and dedicated chatbot page will communicate with this API to get responses to user queries.

## Customizing the Chatbot

To add more questions and answers:
1. Edit the "CHATBOT CAPSTONE DATASET.csv" file in the main directory
2. Restart the Flask server to load the updated dataset

## Troubleshooting

If the chatbot is not responding:
1. Make sure the Flask server is running
2. Check that the API URL in the chatbot.php and chatbot_widget.php files is correct
3. Look for any error messages in the Flask server console
