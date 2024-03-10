<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(){
        $questions = Question::all(); // This retrieves all questions. Consider using pagination in production.
        $totalQuestions = Question::count(); // Get the total number of questions

        return view('question.index', compact('questions', 'totalQuestions'));
}

    public function create(){
        return view('question.create');
    }
}
