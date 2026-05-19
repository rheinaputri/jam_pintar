# Flask API Integration - Penjelasan Lengkap

## 📊 Arsitektur Sistem

```
┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
┃                          USER INTERFACE (Frontend)                      ┃
┃                      📱 test.blade.php (Quiz Page)                      ┃
┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┬━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛
                                │ POST /api/test/submit
                                │ {answers: {q1: "A", q2: "B", ...}}
                                ▼
┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
┃              LARAVEL API (Backend - HTTP Layer)                         ┃
┃           📂 app/Http/Controllers/Api/TestSubmissionController          ┃
┃                                                                          ┃
┃  1. Validate request                                                    ┃
┃  2. Create TestAttempt record                                           ┃
┃  3. Save answers to database (answers table)                            ┃
┃  4. Call Flask API for analysis  ────────────────┐                      ┃
┃  5. Save result to database (results table) ◄────┤                      ┃
┃  6. Return response to frontend                  │                      ┃
┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┼━━━━━━━━━━━━━━━━━━┛
                                                     │
                                                     │ POST /api/predict
                                                     │ {user_id, answers, test_type}
                                                     ▼
┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
┃        FLASK API (Backend - ML Analysis Layer)                         ┃
┃                 🤖 app.py + utils/analyzer.py                          ┃
┃                                                                          ┃
┃  1. Receive answers                                                     ┃
┃  2. Load trained ML model                                               ┃
┃  3. Preprocess answers (convert to features)                            ┃
┃  4. Run prediction/analysis                                             ┃
┃  5. Generate recommendation                                             ┃
┃  6. Return result JSON                                                  ┃
┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛
                                                     ▲
                                                     │ JSON Response
                                                     │ {success, data: {prediction, confidence, recommendation}}
                                                     │
┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┴━━━━━━━━━━━━━━━━━━┓
┃                        DATABASE (MySQL)                                 ┃
┃                                                                          ┃
┃  ┌──────────────────────────────────────────────────────────────────┐  ┃
┃  │ test_attempts (1 record per test)                                │  ┃
┃  │ - id, user_id, started_at, finished_at                           │  ┃
┃  └──────────────────────────────────────────────────────────────────┘  ┃
┃                               ▲ 1-to-Many                               ┃
┃  ┌──────────────────────────────────────────────────────────────────┐  ┃
┃  │ answers (multiple records per test)                              │  ┃
┃  │ - id, test_attempt_id, question_id, answer                      │  ┃
┃  └──────────────────────────────────────────────────────────────────┘  ┃
┃                               ▲ 1-to-One                                ┃
┃  ┌──────────────────────────────────────────────────────────────────┐  ┃
┃  │ results (1 record per test, after analysis)                      │  ┃
┃  │ - id, test_attempt_id, prediction, confidence, score, details   │  ┃
┃  └──────────────────────────────────────────────────────────────────┘  ┃
┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛
```

## 🔄 Detailed Flow

### Step 1: User Submits Test
```
Frontend (JavaScript)
├─ User fills answers
├─ Clicks "Selesai" button
├─ Collects all answers: {1: "A", 2: "B", 3: "C", ...}
└─ POST /api/test/submit
   └─ Adds CSRF token & Content-Type headers
```

### Step 2: Laravel Receives & Validates
```
Laravel TestSubmissionController@submit
├─ Validate JSON payload
│  ├─ answers is array ✓
│  ├─ answers values are strings ✓
│  └─ User is authenticated ✓
├─ Get authenticated user
└─ Continue to Step 3
```

### Step 3: Save to Database (Immediate)
```
Database Transactions
├─ Create TestAttempt record
│  ├─ user_id = Auth::user()->id
│  ├─ started_at = now()->subMinutes(...)
│  └─ finished_at = now()
│
├─ Loop through answers
│  └─ Create Answer record for each question
│     ├─ test_attempt_id = TestAttempt.id
│     ├─ question_id = from answers key
│     └─ answer = from answers value
│
└─ Data saved in database ✓
   (Even if Step 4 fails, data is preserved)
```

### Step 4: Call Flask API (Async)
```
HTTP Request to Flask
├─ URL: http://localhost:5000/api/predict
├─ Method: POST
├─ Headers:
│  ├─ X-API-Key: env('FLASK_API_KEY')
│  └─ Content-Type: application/json
├─ Body:
│  ├─ user_id: 123
│  ├─ answers: {1: "A", 2: "B", ...}
│  └─ test_type: "career_assessment"
│
└─ Timeout: 30 seconds (configurable)
```

### Step 5: Flask API Processes
```
Flask Analyzer
├─ Receive request
├─ Validate API key ✓
├─ Preprocess answers
│  ├─ Convert "A", "B", "C" to 0, 1, 2
│  └─ Normalize to features array
│
├─ Load ML model (if exists)
│  └─ model.predict([features])
│
├─ Get predictions
│  ├─ prediction = "Software Engineer" (class label)
│  ├─ confidence = 0.92 (probability)
│  └─ probabilities = [0.92, 0.05, 0.03]
│
├─ Generate recommendation text
│  └─ "Fokus pada algoritma dan data structures..."
│
└─ Return JSON response
```

### Step 6: Laravel Processes Response
```
TestSubmissionController@submit (continued)
├─ Receive Flask response
├─ Check if response is successful
│  ├─ HTTP 200 ✓
│  └─ response.json()['success'] = true ✓
│
├─ Extract analysis data
│  ├─ prediction
│  ├─ confidence
│  ├─ recommendation
│  ├─ score
│  └─ probabilities
│
├─ Create Result record
│  ├─ test_attempt_id
│  ├─ prediction = "Software Engineer"
│  ├─ confidence = 0.92
│  ├─ recommendation = "Fokus pada algoritma..."
│  ├─ score = 85
│  └─ details = JSON (full analysis)
│
└─ Data saved in results table ✓
```

### Step 7: Send Response to Frontend
```
JSON Response (201 Created)
{
  "success": true,
  "message": "Test berhasil diserahkan",
  "data": {
    "test_attempt_id": 123,
    "submitted_at": "2026-05-12 10:30:45",
    "total_answers": 4,
    "analysis": {
      "prediction": "Software Engineer",
      "confidence": 0.92,
      "recommendation": "...",
      "score": 85
    }
  }
}
```

### Step 8: Frontend Shows Modal & Redirect
```
Frontend (JavaScript)
├─ Receive response
├─ Check success flag
├─ Show modal
│  ├─ Title: "Berhasil"
│  ├─ Message: "Test berhasil diserahkan!"
│  └─ Button: "OK"
│
└─ On modal close
   └─ Redirect to dashboard
```

---

## 🗂️ File Structure

```
jam_pintar/
│
├── app/
│   └── Http/Controllers/Api/
│       └── TestSubmissionController.php  ← Main orchestrator
│
├── database/
│   └── migrations/
│       ├── *_create_test_attempts_table.php
│       ├── *_create_answers_table.php
│       └── *_create_results_table.php
│
├── app/Models/
│   ├── TestAttempt.php
│   ├── Answer.php
│   └── Result.php
│
├── routes/
│   └── api.php  ← API routes defined here
│
├── resources/views/
│   └── pages/student/
│       └── test.blade.php  ← Frontend
│
├── .env  ← Laravel config
│   ├── FLASK_API_URL=http://localhost:5000
│   └── FLASK_API_KEY=your-secret-key
│
└── flask-api/  ← SEPARATE Flask project
    │
    ├── app.py  ← Flask main app
    │
    ├── routes/
    │   └── predict.py  ← API endpoints
    │
    ├── utils/
    │   └── analyzer.py  ← ML logic
    │
    ├── models/
    │   └── trained_model.pkl  ← Your ML model (pickle file)
    │
    ├── requirements.txt  ← Python dependencies
    ├── .env  ← Flask config
    ├── train_model.py  ← Script to train model
    ├── run.bat  ← Quick start (Windows)
    ├── run.sh  ← Quick start (Mac/Linux)
    └── README.md  ← Flask documentation
```

---

## 🚀 How to Run Everything

### Terminal 1: Start Laravel (Port 8000)
```bash
cd c:\laragon\www\jam_pintar
php artisan serve
# http://localhost:8000
```

### Terminal 2: Start Flask (Port 5000)
```bash
cd c:\laragon\www\jam_pintar\flask-api

# Windows
run.bat

# Or manual
python -m venv venv
venv\Scripts\activate
pip install -r requirements.txt
python app.py
```

### Terminal 3: Optional - Train Model
```bash
cd c:\laragon\www\jam_pintar\flask-api
source venv/bin/activate
python train_model.py
```

---

## 📊 Data Models

### TestAttempt
```
id          INTEGER PRIMARY KEY
user_id     INTEGER (FK → users.id)
started_at  TIMESTAMP
finished_at TIMESTAMP
created_at  TIMESTAMP
updated_at  TIMESTAMP
```

### Answer
```
id               INTEGER PRIMARY KEY
test_attempt_id  INTEGER (FK → test_attempts.id)
question_id      INTEGER (FK → questions.id)
answer           TEXT (nilai jawaban: "A", "B", image_url, dll)
created_at       TIMESTAMP
updated_at       TIMESTAMP
```

### Result
```
id               INTEGER PRIMARY KEY
test_attempt_id  INTEGER (FK → test_attempts.id, UNIQUE)
prediction       VARCHAR (career path recommendation)
confidence       DECIMAL (0.0 - 1.0)
score            DECIMAL (0 - 100)
recommendation   TEXT
details          JSON (full analysis result)
created_at       TIMESTAMP
updated_at       TIMESTAMP
```

---

## 🔐 Security Features

1. **API Key Authentication**
   - Flask checks `X-API-Key` header
   - Must match `FLASK_API_KEY` in .env
   - Prevents unauthorized API calls

2. **CSRF Protection**
   - Laravel automatically adds CSRF token
   - Frontend includes token in request headers

3. **User Authorization**
   - TestSubmissionController checks `Auth::user()`
   - Results tied to authenticated user
   - Can't submit for other users

4. **Timeout Protection**
   - Flask request timeout: 30 seconds
   - Prevents hanging requests

---

## ⚠️ Error Handling

### Scenario 1: Flask API Down
```
├─ Answers still saved to database ✓
├─ TestAttempt created ✓
├─ Analysis fails (Result not created)
├─ Response to frontend includes success=true (answers saved)
└─ User sees success message + can retry analysis later
```

### Scenario 2: Flask API Error
```
├─ Error logged
├─ Returns null from analyzeWithFlaskAPI()
├─ Result not created
├─ Laravel returns success response
└─ User sees modal success (test was submitted & saved)
```

### Scenario 3: Invalid API Key
```
├─ Flask returns 401 Unauthorized
├─ Laravel logs warning
├─ Continues without result
└─ User still sees success (answers were saved)
```

---

## 📈 Next Steps

1. **Train Your ML Model**
   - Use `train_model.py` as template
   - Collect real user data
   - Train actual classifier

2. **Integrate With Your Data**
   - Update answer preprocessing
   - Match question types to features
   - Calibrate confidence thresholds

3. **Monitor & Improve**
   - Log analysis results
   - Compare predictions vs actual outcomes
   - Retrain model periodically

4. **Scale**
   - Deploy Flask with Gunicorn
   - Use async jobs for heavy processing
   - Cache model predictions

---

## 🎓 Learning Resources

- **Flask**: https://flask.palletsprojects.com/
- **scikit-learn**: https://scikit-learn.org/
- **REST APIs**: https://restfulapi.net/
- **Laravel HTTP Client**: https://laravel.com/docs/11.x/http-client

---

## 💡 Tips & Tricks

- **Debug Flask**: Add `debug=True` in `.env`
- **Test API**: Use Postman or curl
- **Monitor Logs**: Check Laravel `storage/logs/laravel.log`
- **Reload Model**: Restart Flask app to reload trained model
- **Async Jobs**: Consider Celery for long-running analysis
