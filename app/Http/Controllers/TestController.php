<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\View\View;

class TestController extends Controller
{
    public function index(): View
    {
        // Try to get questions with type 'test'
        $questions = Question::where('question_type', 'test')
            ->limit(10)
            ->get();
        
        // Fallback: if no 'test' type, get any questions
        if ($questions->isEmpty()) {
            $questions = Question::limit(10)->get();
        }
        
        return view('pages.student.test', [
            'questions' => $questions,
            'totalQuestions' => $questions->count(),
        ]);
    }
}
