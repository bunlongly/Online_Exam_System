<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function questionBank(){
    $questions = Question::all(); // This retrieves all questions. Consider using pagination in production.
    
    return view('question.questionBank', compact('questions')); // Replace 'question-bank' with the actual view name.
}
}
