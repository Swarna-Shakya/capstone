from flask import Flask, request, jsonify, send_from_directory
from flask_cors import CORS
import pandas as pd
import re
import os

app = Flask(__name__)
CORS(app)  # Enable CORS for all routes

# Load dataset
try:
    current_dir = os.path.dirname(os.path.abspath(__file__))
    csv_path = os.path.join(os.path.dirname(current_dir), 'CHATBOT CAPSTONE DATASET.csv')
    questions_df = pd.read_csv(csv_path, encoding='unicode_escape')
    questions_list = questions_df['Questions'].tolist()
    answers_list = questions_df['Answers'].tolist()
    print(f"Successfully loaded {len(questions_list)} question-answer pairs")
except Exception as e:
    print(f"Error loading dataset: {e}")
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

# Simple text matching function
def find_best_match(user_query):
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
        return answers_list[best_match_index]
    else:
        return "I don't have information on that. Please ask something else about our hotel services."

@app.route('/api/chat', methods=['POST'])
def chat():
    data = request.json
    user_message = data.get('message', '')
    
    if not user_message:
        return jsonify({'response': 'Please enter a message.'})
    
    response = find_best_match(user_message)
    return jsonify({'response': response})

if __name__ == '__main__':
    app.run(debug=True, port=5000)
