
from flask import Flask, request, jsonify
from flask_cors import CORS
import os
import pandas as pd
import numpy as np
import nltk
import re
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
from nltk.stem import WordNetLemmatizer, PorterStemmer
from nltk.corpus import stopwords

# Download necessary resources
nltk.download('punkt')
nltk.download('wordnet')
nltk.download('stopwords')

# File path setup
dataset_path = os.path.join(os.path.dirname(__file__), "CHATBOT CAPSTONE DATASET.csv")

# Check if file exists
if not os.path.exists(dataset_path):
    raise FileNotFoundError(f"\n❌ Dataset file not found: {dataset_path}\n📌 Please place 'CHATBOT CAPSTONE DATASET.csv' in the same folder as this script.")

# Preprocessing functions
def preprocess(text):
    if not isinstance(text, str):
        text = str(text)
    lemmatizer = WordNetLemmatizer()
    stemmer = PorterStemmer()
    text = re.sub(r'[^\w\s]', '', text)
    tokens = nltk.word_tokenize(text.lower())
    tokens = [token for token in tokens if token not in stopwords.words('english')]
    lemmatized_tokens = [lemmatizer.lemmatize(token) for token in tokens]
    stemmed_tokens = [stemmer.stem(token) for token in lemmatized_tokens]
    return ' '.join(stemmed_tokens)

def preprocess_with_stopwords(text):
    lemmatizer = WordNetLemmatizer()
    stemmer = PorterStemmer()
    text = re.sub(r'[^\w\s]', '', text)
    tokens = nltk.word_tokenize(text.lower())
    lemmatized_tokens = [lemmatizer.lemmatize(token) for token in tokens]
    stemmed_tokens = [stemmer.stem(token) for token in lemmatized_tokens]
    return ' '.join(stemmed_tokens)

# Load dataset
questions_df = pd.read_csv(dataset_path, encoding='unicode_escape')
questions_list = questions_df['Questions'].tolist()
answers_list = questions_df['Answers'].tolist()

# TF-IDF Vectorizer
vectorizer = TfidfVectorizer(tokenizer=nltk.word_tokenize)
X = vectorizer.fit_transform([preprocess(q) for q in questions_list])

# Response function
def get_response(user_query):
    processed_text = preprocess_with_stopwords(user_query)
    vectorized_text = vectorizer.transform([processed_text])
    similarities = cosine_similarity(vectorized_text, X)
    max_similarity = np.max(similarities)

    if max_similarity > 0.6:
        high_similarity_indices = [i for i, s in enumerate(similarities[0]) if i < len(answers_list) and s > 0.6]
        high_similarity_questions = [questions_list[i] for i in high_similarity_indices]
        target_answers = [answers_list[i] for i in high_similarity_indices]

        Z = vectorizer.transform([preprocess_with_stopwords(q) for q in high_similarity_questions])
        final_similarities = cosine_similarity(vectorized_text, Z)

        if final_similarities.size > 0:
            closest_index = final_similarities.argmax()
            return {
                'answer': target_answers[closest_index],
                'confidence': float(np.max(final_similarities)),
                'matched_question': high_similarity_questions[closest_index]
            }

    return {
        'answer': "I don't have information on that. Please ask something else.",
        'confidence': float(max_similarity),
        'matched_question': None
    }


import requests
from datetime import datetime

# Detect room availability intent
def is_room_availability_query(user_query):
    availability_keywords = [
        'room available', 'rooms available', 'availability', 'book room', 'reserve room',
        'vacant room', 'free room', 'check availability', 'room booking', 'any room',
        'room status', 'available room', 'room vacancy', 'book a room'
    ]
    query_lower = user_query.lower()
    return any(keyword in query_lower for keyword in availability_keywords)

# Extract check-in/check-out dates (basic version)
def extract_dates_from_query(user_query):
    date_patterns = [
        r'\d{4}-\d{2}-\d{2}',     # YYYY-MM-DD
        r'\d{1,2}/\d{1,2}/\d{4}', # MM/DD/YYYY
        r'\d{1,2}-\d{1,2}-\d{4}'  # MM-DD-YYYY
    ]
    dates_found = []
    for pattern in date_patterns:
        matches = re.findall(pattern, user_query)
        dates_found.extend(matches)
    if len(dates_found) >= 2:
        return dates_found[0], dates_found[1]
    return None, None

# Get real-time room availability from PHP backend
def get_room_availability(check_in_date=None, check_out_date=None):
    try:
        api_url = "http://localhost/capstone/api/check_availability.php"
        request_data = {}
        if check_in_date and check_out_date:
            request_data = {
                "check_in": check_in_date,
                "check_out": check_out_date
            }
        response = requests.post(api_url, json=request_data, timeout=10)
        if response.status_code != 200:
            return "Sorry, I cannot check room availability right now. Please try again later."
        data = response.json()
        if not data.get('success', False):
            return f"Sorry, error checking availability: {data.get('error', 'Unknown error')}"
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
            return f"❌ Sorry, no rooms are available from {check_in} to {check_out}. Try different dates."
    except Exception as e:
        print(f"Room availability error: {e}")
        return "Sorry, I encountered an error checking availability. Please try again later."


# ────── Flask API ──────
app = Flask(__name__)
CORS(app)

@app.route('/api/chat', methods=['POST'])
def chat_api():
    data = request.json
    user_message = data.get('message', '')
    if not user_message:
        return jsonify({
            'response': 'Please enter a message.',
            'confidence': 0,
            'matched_question': None
        })

    if is_room_availability_query(user_message):
        check_in, check_out = extract_dates_from_query(user_message)
        availability_response = get_room_availability(check_in, check_out)
        return jsonify({
            'response': availability_response,
            'confidence': 1.0,
            'matched_question': user_message,
            'method': 'real_time_db',
            'dates_found': {'check_in': check_in, 'check_out': check_out} if check_in and check_out else None
        })

    result = get_response(user_message)
    return jsonify({
        'response': result['answer'],
        'confidence': result['confidence'],
        'matched_question': result['matched_question']
    })

@app.route('/api/stats', methods=['GET'])
def get_stats():
    stats = {
        'total_questions': len(questions_list),
        'vocabulary_size': len(vectorizer.vocabulary_),
        'tfidf_shape': X.shape
    }
    return jsonify(stats)

if __name__ == '__main__':
    print("✅ Chatbot API is running on http://localhost:5002")
    app.run(debug=True, port=5002)
