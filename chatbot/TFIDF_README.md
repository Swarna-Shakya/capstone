# TF-IDF Implementation Guide

## Overview

This document explains the TF-IDF (Term Frequency-Inverse Document Frequency) algorithm implementation in the hotel chatbot system. TF-IDF significantly improves the chatbot's ability to match user queries with relevant answers by using statistical analysis rather than simple word overlap.

## What is TF-IDF?

TF-IDF is a numerical statistic that reflects how important a word is to a document in a collection of documents. It consists of two components:

1. **Term Frequency (TF)**: How frequently a term appears in a document
2. **Inverse Document Frequency (IDF)**: How rare or common a term is across all documents

The formula is: `TF-IDF = TF × IDF`

## Implementation Details

### 1. Text Preprocessing

```python
def preprocess_text(text):
    # Convert to lowercase
    text = str(text).lower()
    # Remove punctuation
    text = text.translate(str.maketrans('', '', string.punctuation))
    # Remove extra whitespace
    text = ' '.join(text.split())
    return text
```

### 2. TF-IDF Vectorizer Configuration

```python
tfidf_vectorizer = TfidfVectorizer(
    max_features=1000,      # Limit vocabulary size
    stop_words='english',   # Remove common English stop words
    ngram_range=(1, 2),     # Use unigrams and bigrams
    min_df=1,               # Minimum document frequency
    max_df=0.8              # Maximum document frequency
)
```

### 3. Similarity Calculation

The system uses cosine similarity to measure the angle between the user query vector and each question vector in the dataset:

```python
similarities = cosine_similarity(query_tfidf, tfidf_matrix).flatten()
best_match_index = np.argmax(similarities)
```

## Benefits Over Simple Word Matching

| Aspect | Simple Word Matching | TF-IDF Approach |
|--------|---------------------|-----------------|
| **Accuracy** | Basic word overlap | Semantic similarity |
| **Synonyms** | Poor handling | Better recognition |
| **Confidence** | Binary (match/no match) | Scored (0.0 to 1.0) |
| **Partial Matches** | Limited | Excellent |
| **Context** | Word-level only | Document-level |

## API Response Format

The enhanced API now returns detailed information:

```json
{
    "response": "Our check-in time is 2:00 PM and check-out time is 12:00 PM.",
    "confidence": 0.87,
    "matched_question": "What are your check-in and check-out times?",
    "method": "tfidf"
}
```

## Testing the Implementation

Run the test script to see TF-IDF performance:

```bash
python test_tfidf.py
```

Example output:
```
🤖 Testing TF-IDF Chatbot
==================================================
📊 TF-IDF Model Statistics:
   Total Questions: 519
   TF-IDF Enabled: True
   Vocabulary Size: 245
   Matrix Shape: [519, 245]

🔍 Test 1: 'What time is check in?'
   📝 Response: Our check-in time is 2:00 PM and check-out time is 12:00 PM.
   🎯 Confidence: 0.856
   ❓ Matched Question: What are your check-in and check-out times?
   🔧 Method: tfidf
```

## Performance Monitoring

Use the `/api/stats` endpoint to monitor the TF-IDF model:

```bash
curl http://localhost:5000/api/stats
```

## Configuration Options

You can adjust these parameters in `app.py`:

- `max_features`: Maximum vocabulary size (default: 1000)
- `ngram_range`: Word combinations to consider (default: 1-2 words)
- `min_df`: Minimum document frequency (default: 1)
- `max_df`: Maximum document frequency (default: 0.8)
- `similarity_threshold`: Minimum confidence score (default: 0.1)

## Fallback Mechanism

If TF-IDF fails to initialize or encounters an error, the system automatically falls back to the original simple word matching algorithm, ensuring the chatbot remains functional.

## Integration with Existing System

The TF-IDF implementation is backward-compatible with your existing chatbot widget. No changes are needed to the frontend code - the enhanced matching happens transparently in the backend.

## Future Enhancements

1. **Dynamic Learning**: Update TF-IDF model with new questions
2. **Multi-language Support**: Extend to other languages
3. **Semantic Embeddings**: Use word2vec or BERT for even better matching
4. **Query Expansion**: Automatically expand queries with synonyms
5. **Personalization**: Adapt responses based on user history
