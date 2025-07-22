import json
import os
import re
import csv
from http.server import HTTPServer, BaseHTTPRequestHandler

# Default fallback data in case the CSV can't be loaded
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

# Try to load the dataset
try:
    current_dir = os.path.dirname(os.path.abspath(__file__))
    csv_path = os.path.join(os.path.dirname(current_dir), 'CHATBOT CAPSTONE DATASET.csv')
    print(f"Looking for CSV file at: {csv_path}")
    
    # Try different encodings
    encodings_to_try = ['utf-8', 'unicode_escape', 'latin-1', 'cp1252']
    success = False
    
    for encoding in encodings_to_try:
        try:
            with open(csv_path, 'r', encoding=encoding) as file:
                print(f"Trying to read CSV with encoding: {encoding}")
                reader = csv.reader(file)
                headers = next(reader)  # Skip header row
                print(f"CSV headers: {headers}")
                
                # Find the column indices for Questions and Answers
                if 'Questions' in headers and 'Answers' in headers:
                    question_idx = headers.index('Questions')
                    answer_idx = headers.index('Answers')
                    print(f"Found columns - Questions: {question_idx}, Answers: {answer_idx}")
                else:
                    # Assume first two columns are questions and answers
                    question_idx = 0
                    answer_idx = 1
                    print(f"Using default columns - Questions: {question_idx}, Answers: {answer_idx}")
                
                questions_list = []
                answers_list = []
                
                for row in reader:
                    if len(row) > max(question_idx, answer_idx):
                        questions_list.append(row[question_idx])
                        answers_list.append(row[answer_idx])
                
                success = True
                print(f"Successfully loaded {len(questions_list)} question-answer pairs")
                
                # Print first 5 Q&A pairs for debugging
                for i in range(min(5, len(questions_list))):
                    print(f"Q: {questions_list[i]}")
                    print(f"A: {answers_list[i]}")
                
                break  # Successfully read the file, no need to try other encodings
        except Exception as e:
            print(f"Failed with encoding {encoding}: {str(e)}")
    
    if not success:
        raise Exception("Failed to read CSV file with any encoding")
        
except Exception as e:
    print(f"Error loading dataset: {e}")
    print("Using fallback data instead")

# Advanced text matching function with keyword analysis
def find_best_match(user_query):
    user_query = user_query.lower().strip()
    
    # Print the user query for debugging
    print(f"User query: '{user_query}'")
    
    # Define important keywords for different categories of questions
    contact_keywords = {'contact', 'reach', 'call', 'phone', 'email', 'number'}
    booking_keywords = {'book', 'reserve', 'reservation', 'booking'}
    room_keywords = {'room', 'suite', 'accommodation', 'stay'}
    facility_keywords = {'facility', 'amenities', 'pool', 'gym', 'spa', 'restaurant'}
    
    # Clean the query
    user_query = re.sub(r'[^\w\s]', '', user_query)
    query_words = set(user_query.split())
    
    print(f"Query words: {query_words}")
    
    # If no words in query, return default message
    if not query_words:
        return "I didn't understand your question. Could you please rephrase it?"
    
    # Check for keyword matches to help prioritize certain types of questions
    is_contact_query = bool(query_words.intersection(contact_keywords))
    is_booking_query = bool(query_words.intersection(booking_keywords))
    is_room_query = bool(query_words.intersection(room_keywords))
    is_facility_query = bool(query_words.intersection(facility_keywords))
    
    # Print detected query types
    query_types = []
    if is_contact_query: query_types.append("contact")
    if is_booking_query: query_types.append("booking")
    if is_room_query: query_types.append("room")
    if is_facility_query: query_types.append("facility")
    print(f"Detected query types: {query_types if query_types else 'general'}")
    
    # Track best matches with scores
    matches = []
    
    for i, question in enumerate(questions_list):
        question_lower = question.lower()
        question_lower = re.sub(r'[^\w\s]', '', question_lower)
        question_words = set(question_lower.split())
        
        # Calculate word overlap
        common_words = query_words.intersection(question_words)
        
        # Calculate scores: both absolute count and percentage of query covered
        absolute_score = len(common_words)
        coverage_score = len(common_words) / len(query_words) if query_words else 0
        
        # Keyword bonus: if query type matches question type
        keyword_bonus = 0
        if is_contact_query and any(word in question_lower for word in contact_keywords):
            keyword_bonus += 0.5
        if is_booking_query and any(word in question_lower for word in booking_keywords):
            keyword_bonus += 0.5
        if is_room_query and any(word in question_lower for word in room_keywords):
            keyword_bonus += 0.3
        if is_facility_query and any(word in question_lower for word in facility_keywords):
            keyword_bonus += 0.3
        
        # Combined score (weighted with keyword bonus)
        score = (absolute_score * 0.3) + (coverage_score * 0.5) + keyword_bonus
        
        if score > 0:
            matches.append((i, score, absolute_score, coverage_score, keyword_bonus))
    
    # Sort by score (highest first)
    matches.sort(key=lambda x: x[1], reverse=True)
    
    # Print top 3 matches for debugging
    print("Top matches:")
    for i, (idx, score, abs_score, cov_score, key_bonus) in enumerate(matches[:3]):
        if i < len(matches):
            print(f"  {i+1}. Q: '{questions_list[idx]}'")
            print(f"     Score: {score:.2f} (Absolute: {abs_score}, Coverage: {cov_score:.2f}, Keyword Bonus: {key_bonus:.1f})")
    
    # If we found a decent match
    if matches and matches[0][1] > 0.3:  # Increased threshold for better accuracy
        best_match_index = matches[0][0]
        print(f"Selected answer: '{answers_list[best_match_index]}'")
        return answers_list[best_match_index]
    else:
        print("No good match found")
        
        # Provide more helpful default responses based on query type
        if is_contact_query:
            return "You can contact us by phone at +977-1-4567890 or by email at info@iimshotel.com. Our front desk is available 24/7."
        elif is_booking_query:
            return "To make a reservation, you can use our online booking system on our website, call us at +977-1-4567890, or email us at reservations@iimshotel.com."
        elif is_room_query:
            return "We offer various room types including standard rooms, deluxe rooms, and suites. Would you like specific information about any of these?"
        elif is_facility_query:
            return "Our hotel facilities include a swimming pool, fitness center, spa, restaurant, and business center. What specific facility would you like to know more about?"
        else:
            return "I don't have specific information on that. Please ask something about our rooms, facilities, booking process, or contact information."


class ChatbotHandler(BaseHTTPRequestHandler):
    def _set_headers(self):
        self.send_response(200)
        self.send_header('Content-type', 'application/json')
        self.send_header('Access-Control-Allow-Origin', '*')
        self.send_header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
        self.send_header('Access-Control-Allow-Headers', 'Content-Type')
        self.end_headers()
        
    def do_OPTIONS(self):
        self._set_headers()
        
    def do_GET(self):
        self._set_headers()
        response = {'status': 'ok', 'message': 'Chatbot API is running'}
        self.wfile.write(json.dumps(response).encode())
        
    def do_POST(self):
        content_length = int(self.headers['Content-Length'])
        post_data = self.rfile.read(content_length)
        
        try:
            # Parse the incoming request
            data = json.loads(post_data.decode('utf-8'))
            user_message = data.get('message', '')
            
            print(f"Received POST request with data: {data}")
            
            if not user_message:
                response = {'response': 'Please enter a message.'}
            else:
                bot_response = find_best_match(user_message)
                # Print the full response for debugging
                print(f"Full response: '{bot_response}'")
                # Ensure the response is properly encoded
                response = {'response': bot_response.strip()}
                
            self._set_headers()
            self.wfile.write(json.dumps(response).encode())
            
        except Exception as e:
            print(f"Error processing request: {str(e)}")
            self._set_headers()
            response = {'error': str(e)}
            self.wfile.write(json.dumps(response).encode())

def run(server_class=HTTPServer, handler_class=ChatbotHandler, port=5001):
    server_address = ('', port)
    httpd = server_class(server_address, handler_class)
    print(f'Starting chatbot server on port {port}...')
    httpd.serve_forever()

if __name__ == '__main__':
    run()
