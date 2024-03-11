<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve the search query input
        $searchQuery = $request->input('search');

        // Query the database based on the search term
        $questions = Question::with('user')
            ->when($searchQuery, function ($query, $searchQuery) {
                return $query->where('question', 'LIKE', "%{$searchQuery}%")
                             ->orWhere('course', 'LIKE', "%{$searchQuery}%");
            })
            ->paginate(25);
            

        // Get the total count of questions
        $totalQuestions = Question::count();

        return view('question.index', compact('questions', 'totalQuestions'));
    }

     //show single listing
     public function show(Question $question){
        return view('question.show', [
            'question' => $question
        ]);
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
    
        // Set the user_id to the ID of the current authenticated user
        $question->user_id = auth()->id(); // This assumes you're using Laravel's default authentication

        

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


    public function edit(Question $question){
      
        return view('question.edit', ['question$question' => $question]);
    }
    
}
