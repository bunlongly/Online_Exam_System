<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        // dd($request->all());
        Log::info('Store method called');
        Log::info('Request data: ' . json_encode($request->all()));
        
        $validatedData = $request->validate([
            'course' => 'required',
            'question' => 'required',
            'type' => 'required',
            'difficulty' => 'required',
            'score' => 'required|numeric',
            // The correct_answer field might be conditional based on the question type
        ]);
    
        // Create a new question instance with the validated data
        $question = new Question($validatedData);
    
        // Handle the question based on type
        if ($request->input('type') === 'Multiple Choice') {
            // Assuming you want to store options and correct_answer as JSON
            // First validate the options input to make sure it's present
            $validatedOptions = $request->validate([
                'options' => 'required|array',
                'options.*' => 'required', // Validate each option is filled
                'correct_answer' => 'required|in:A,B,C,D', // Validate correct answer is one of the options
            ]);
    
            // Store the options and the correct answer in the question
            $question->options = json_encode($validatedOptions['options']);
            $question->correct_answer = $validatedOptions['correct_answer'];
    
        } elseif ($request->input('type') === 'True Or False') {
            // Validate the correct_answer for True/False type
            $validatedCorrectAnswer = $request->validate([
                'correct_answer' => 'required|in:True,False', // Validate correct answer is 'True' or 'False'
            ]);
    
            // Store the correct answer in the question
            $question->correct_answer = $validatedCorrectAnswer['correct_answer'];
        } elseif ($request->input('type') === 'Enter the Answer') {
            // Validate the correct_answer for Enter the Answer type
            $validatedCorrectAnswer = $request->validate([
                'correct_answer' => 'required', // The correct answer should be filled
            ]);
    
            // Store the correct answer in the question
            $question->correct_answer = $validatedCorrectAnswer['correct_answer'];
        }
    
        // Save the question to the database
        $question->save();
    
        return redirect('/question')->with('message', 'Question created successfully!');
    }
    
}
