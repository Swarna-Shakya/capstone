#!/usr/bin/env python3
"""
Test script to demonstrate TF-IDF functionality in the chatbot
"""

import requests
import json
import time

# Test the chatbot API
def test_chatbot():
    base_url = "http://localhost:5000"
    
    # Test queries
    test_queries = [
        "What time is check in?",
        "Do you have wifi?",
        "Is breakfast free?",
        "Where can I park?",
        "How to book a room?",
        "What are your amenities?",
        "Tell me about your services",
        "Random question that doesn't match anything"
    ]
    
    print("🤖 Testing TF-IDF Chatbot")
    print("=" * 50)
    
    # First, get stats
    try:
        stats_response = requests.get(f"{base_url}/api/stats")
        if stats_response.status_code == 200:
            stats = stats_response.json()
            print("📊 TF-IDF Model Statistics:")
            print(f"   Total Questions: {stats['total_questions']}")
            print(f"   TF-IDF Enabled: {stats['tfidf_enabled']}")
            print(f"   Vocabulary Size: {stats['vocabulary_size']}")
            print(f"   Matrix Shape: {stats['tfidf_shape']}")
            print()
    except requests.exceptions.ConnectionError:
        print("❌ Could not connect to chatbot server. Make sure it's running on localhost:5000")
        return
    
    # Test each query
    for i, query in enumerate(test_queries, 1):
        print(f"🔍 Test {i}: '{query}'")
        
        try:
            response = requests.post(
                f"{base_url}/api/chat",
                json={"message": query},
                headers={"Content-Type": "application/json"}
            )
            
            if response.status_code == 200:
                result = response.json()
                print(f"   📝 Response: {result['response']}")
                print(f"   🎯 Confidence: {result['confidence']:.3f}")
                print(f"   ❓ Matched Question: {result.get('matched_question', 'None')}")
                print(f"   🔧 Method: {result.get('method', 'unknown')}")
            else:
                print(f"   ❌ Error: HTTP {response.status_code}")
                
        except requests.exceptions.RequestException as e:
            print(f"   ❌ Request failed: {e}")
        
        print("-" * 50)
        time.sleep(0.5)  # Small delay between requests

if __name__ == "__main__":
    test_chatbot()
