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

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'course' => 'required',
            'question' => 'required',
            'type' => 'required',
            'difficulty' => 'required',
            'score' => 'required|numeric',
            'correct_answer' => 'required',
            
            // Add other fields as necessary
        ]);
    
        // Create a new question
        Question::create($validatedData);
    
        // Redirect to the question bank with a success message
        return redirect('/question')->with('message', 'Question created successfully!');
    }
    
}
