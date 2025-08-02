import requests
from flask import Flask, request, jsonify, send_from_directory
from flask_cors import CORS
import pandas as pd
import re
import os
import numpy as np
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
import string
import mysql.connector
from datetime import datetime, timedelta
import json

app = Flask(__name__)
# Enable CORS for all routes with explicit configuration
CORS(app, origins=['http://localhost', 'http://127.0.0.1', 'http://localhost:80', 'http://127.0.0.1:80'], 
     methods=['GET', 'POST', 'OPTIONS'], 
     allow_headers=['Content-Type', 'Authorization'])

# Text preprocessing function
def preprocess_text(text):
    """Clean and preprocess text for TF-IDF"""
    if pd.isna(text):
        return ""
    # Convert to lowercase
    text = str(text).lower()
    # Remove punctuation
    text = text.translate(str.maketrans('', '', string.punctuation))
    # Remove extra whitespace
    text = ' '.join(text.split())
    return text

# Database connection function
def get_db_connection():
    """Get database connection"""
    try:
        connection = mysql.connector.connect(
            host='localhost',
            port=3307,  # XAMPP MySQL port
            database='capstone',
            user='root',
            password=''
        )
        return connection
    except mysql.connector.Error as e:
        print(f"Database connection error: {e}")
        return None

# Real-time room availability function using PHP API
def get_room_availability(check_in_date=None, check_out_date=None):
    """Get real-time room availability from PHP API"""
    try:
        # Prepare the API request
        api_url = "http://localhost/capstone/api/check_availability.php"
        
        # Prepare request data
        request_data = {}
        if check_in_date and check_out_date:
            request_data = {
                "check_in": check_in_date,
                "check_out": check_out_date
            }
        
        # Make the API call
        response = requests.post(api_url, json=request_data, timeout=10)
        
        if response.status_code != 200:
            return "Sorry, I cannot check room availability right now. Please try again later."
        
        data = response.json()
        
        if not data.get('success', False):
            return f"Sorry, there was an error checking availability: {data.get('error', 'Unknown error')}"
        
        # Format the response for the chatbot
        check_in = data.get('check_in', 'today')
        check_out = data.get('check_out', 'tomorrow')
        available_rooms = data.get('available_rooms', [])
        
        if available_rooms:
            response_text = f"🏨 Available Rooms ({check_in} to {check_out}):\n\n"
            
            for room in available_rooms:
                response_text += f"• {room['title']} - {room['available_rooms']} rooms available\n"
                response_text += f"  Price: {room['currency']} {room['price']} per night\n\n"
            
            response_text += "✨ Updated in real-time! Book now to secure your room."
            return response_text
        else:
            return f"❌ Sorry, no rooms are available from {check_in} to {check_out}. Please try different dates."
            
    except requests.exceptions.RequestException as e:
        print(f"API request error: {e}")
        return "Sorry, I cannot check room availability right now. Please try again later."
    except Exception as e:
        print(f"Error in room availability: {e}")
        return "Sorry, I encountered an error checking room availability. Please try again later."

# Function to detect room availability queries
def is_room_availability_query(user_query):
    """Detect if user is asking about room availability"""
    availability_keywords = [
        'room available', 'rooms available', 'availability', 'book room', 'reserve room',
        'vacant room', 'free room', 'check availability', 'room booking', 'any room',
        'room status', 'available room', 'room vacancy', 'book a room'
    ]
    
    query_lower = user_query.lower()
    return any(keyword in query_lower for keyword in availability_keywords)

# Function to extract dates from user query (basic implementation)
def extract_dates_from_query(user_query):
    """Extract check-in and check-out dates from user query"""
    # This is a basic implementation - you can enhance it with more sophisticated date parsing
    import re
    from datetime import datetime
    
    # Look for date patterns like YYYY-MM-DD, MM/DD/YYYY, etc.
    date_patterns = [
        r'\d{4}-\d{2}-\d{2}',  # YYYY-MM-DD
        r'\d{1,2}/\d{1,2}/\d{4}',  # MM/DD/YYYY
        r'\d{1,2}-\d{1,2}-\d{4}'   # MM-DD-YYYY
    ]
    
    dates_found = []
    for pattern in date_patterns:
        matches = re.findall(pattern, user_query)
        dates_found.extend(matches)
    
    if len(dates_found) >= 2:
        return dates_found[0], dates_found[1]
    
    return None, None

# Load dataset with robust error handling
def load_dataset_robust():
    current_dir = os.path.dirname(os.path.abspath(__file__))
    csv_path = os.path.join(os.path.dirname(current_dir), 'CHATBOT CAPSTONE DATASET.csv')
    
    # Try multiple loading strategies
    strategies = [
        {'encoding': 'unicode_escape', 'quotechar': '"', 'skipinitialspace': True},
        {'encoding': 'utf-8', 'quotechar': '"'},
        {'encoding': 'utf-8', 'quotechar': '"', 'on_bad_lines': 'skip'},
        {'encoding': 'latin-1', 'quotechar': '"'},
    ]
    
    for i, strategy in enumerate(strategies):
        try:
            print(f"Trying loading strategy {i+1}...")
            questions_df = pd.read_csv(csv_path, **strategy)
            questions_list = questions_df['Questions'].tolist()
            answers_list = questions_df['Answers'].tolist()
            print(f"Successfully loaded {len(questions_list)} question-answer pairs with strategy {i+1}")
            return questions_list, answers_list
        except Exception as e:
            print(f"Strategy {i+1} failed: {e}")
            continue
    
    # If all strategies fail, return fallback data
    print("All loading strategies failed, using fallback data")
    return None, None

try:
    questions_list, answers_list = load_dataset_robust()
    if questions_list is None:
        # Fallback data in case the CSV can't be loaded
        questions_list = [
            "What are your check-in and check-out times?",
            "Do you have free WiFi?",
            "Is breakfast included?",
            "Do you have parking?",
            "How can I make a reservation?"
        ]
        answers_list = [
            "Our check-in time is 2:00 PM and check-out time is 12:00 PM.",
            "Yes, we offer free high-speed WiFi throughout the hotel.",
            "Yes, a complimentary breakfast is included with your stay.",
            "Yes, we have free parking for all guests.",
            "You can make a reservation through our website, by calling us, or by visiting the front desk."
        ]
except Exception as e:
    print(f"Error in dataset loading: {e}")
    # Fallback data in case of any error
    questions_list = [
        "What are your check-in and check-out times?",
        "Do you have free WiFi?",
        "Is breakfast included?",
        "Do you have parking?",
        "How can I make a reservation?"
    ]
    answers_list = [
        "Our check-in time is 2:00 PM and check-out time is 12:00 PM.",
        "Yes, we offer free high-speed WiFi throughout the hotel.",
        "Yes, a complimentary breakfast is included with your stay.",
        "Yes, we have free parking for all guests.",
        "You can make a reservation through our website, by calling us, or by visiting the front desk."
    ]

# Preprocess questions for TF-IDF
processed_questions = [preprocess_text(q) for q in questions_list]

# Initialize TF-IDF Vectorizer
tfidf_vectorizer = TfidfVectorizer(
    max_features=1000,  # Limit vocabulary size
    stop_words='english',  # Remove common English stop words
    ngram_range=(1, 2),  # Use unigrams and bigrams
    min_df=1,  # Minimum document frequency
    max_df=0.8  # Maximum document frequency (ignore very common terms)
)

# Fit TF-IDF on the questions
try:
    tfidf_matrix = tfidf_vectorizer.fit_transform(processed_questions)
    print(f"TF-IDF matrix shape: {tfidf_matrix.shape}")
    print("TF-IDF vectorizer initialized successfully")
except Exception as e:
    print(f"Error initializing TF-IDF: {e}")
    tfidf_matrix = None

# TF-IDF based matching function
def find_best_match_tfidf(user_query):
    """Find the best matching answer using TF-IDF and cosine similarity"""
    try:
        # Handle common greetings and short queries first
        query_lower = user_query.lower().strip()
        greeting_responses = {
            'hello': "Hi! How can I help you?",
            'hi': "Hello! Do you have any inquiries?",
            'hey': "Hi there! How can I assist you today?",
            'good morning': "Good morning! How can I help you?",
            'good afternoon': "Good afternoon! How can I assist you?",
            'good evening': "Good evening! How may I help you?",
            'thanks': "You're welcome! Is there anything else I can help you with?",
            'thank you': "You're welcome! Feel free to ask if you need anything else.",
            'bye': "Goodbye! Thank you for choosing our hotel. Have a great day!",
            'goodbye': "Goodbye! Thank you for visiting. Have a wonderful stay!"
        }
        
        # Check for exact greeting matches
        if query_lower in greeting_responses:
            return {
                'answer': greeting_responses[query_lower],
                'confidence': 1.0,
                'matched_question': query_lower.title()
            }
        
        if tfidf_matrix is None or tfidf_vectorizer is None:
            return fallback_simple_match(user_query)
        
        # Preprocess the user query
        processed_query = preprocess_text(user_query)
        
        # Transform the query using the fitted vectorizer
        query_vector = tfidf_vectorizer.transform([processed_query])
        
        # Calculate cosine similarity
        similarities = cosine_similarity(query_vector, tfidf_matrix).flatten()
        
        # Find the best match
        best_match_index = np.argmax(similarities)
        best_similarity = similarities[best_match_index]
        
        # Set a threshold for similarity (you can adjust this)
        threshold = 0.1
        
        if best_similarity > threshold:
            return {
                'answer': answers_list[best_match_index],
                'confidence': float(best_similarity),
                'matched_question': questions_list[best_match_index]
            }
        else:
            return {
                'answer': "I don't have information on that. Please ask something else about our hotel services.",
                'confidence': float(best_similarity),
                'matched_question': None
            }
    
    except Exception as e:
        print(f"Error in TF-IDF matching: {e}")
        return fallback_simple_match(user_query)

# Fallback simple matching function (original approach)
def fallback_simple_match(user_query):
    """Fallback to simple word overlap matching if TF-IDF fails"""
    user_query = user_query.lower()
    best_match_index = -1
    best_match_score = 0
    
    # Clean the query
    user_query = re.sub(r'[^\w\s]', '', user_query)
    query_words = set(user_query.split())
    
    for i, question in enumerate(questions_list):
        question_lower = question.lower()
        question_lower = re.sub(r'[^\w\s]', '', question_lower)
        question_words = set(question_lower.split())
        
        # Calculate word overlap
        common_words = query_words.intersection(question_words)
        if len(common_words) > best_match_score:
            best_match_score = len(common_words)
            best_match_index = i
    
    # If we found a decent match
    if best_match_score >= 1 and best_match_index >= 0:
        return {
            'answer': answers_list[best_match_index],
            'confidence': best_match_score / len(query_words) if query_words else 0,
            'matched_question': questions_list[best_match_index]
        }
    else:
        return {
            'answer': "I don't have information on that. Please ask something else about our hotel services.",
            'confidence': 0,
            'matched_question': None
        }

@app.route('/api/chat', methods=['POST'])
def chat():
    data = request.json
    user_message = data.get('message', '')
    
    if not user_message:
        return jsonify({
            'response': 'Please enter a message.',
            'confidence': 0,
            'matched_question': None,
            'method': 'error'
        })
    
    # Check if user is asking about room availability
    if is_room_availability_query(user_message):
        # Extract dates from query if provided
        check_in, check_out = extract_dates_from_query(user_message)
        
        # Get real-time room availability
        availability_response = get_room_availability(check_in, check_out)
        
        return jsonify({
            'response': availability_response,
            'confidence': 1.0,
            'matched_question': user_message,
            'method': 'real_time_db',
            'query_type': 'room_availability',
            'dates_found': {'check_in': check_in, 'check_out': check_out} if check_in and check_out else None
        })
    
    # Use TF-IDF matching for other queries
    result = find_best_match_tfidf(user_message)
    
    return jsonify({
        'response': result['answer'],
        'confidence': result['confidence'],
        'matched_question': result['matched_question'],
        'method': 'tfidf' if tfidf_matrix is not None else 'fallback'
    })

# Additional endpoint to get TF-IDF statistics
@app.route('/api/stats', methods=['GET'])
def get_stats():
    """Get statistics about the TF-IDF model"""
    stats = {
        'total_questions': len(questions_list),
        'tfidf_enabled': tfidf_matrix is not None,
        'vocabulary_size': len(tfidf_vectorizer.vocabulary_) if tfidf_matrix is not None else 0,
        'tfidf_shape': tfidf_matrix.shape if tfidf_matrix is not None else None
    }
    return jsonify(stats)

if __name__ == '__main__':
    app.run(debug=True, port=5002)
