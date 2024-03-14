<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        
        $searchQuery = $request->input('search');
        $typeFilter = $request->input('type');
    
        $questions = Question::with('user')
            ->when($typeFilter && $typeFilter !== '' && in_array($typeFilter, ['Multiple Choice', 'True Or False', 'Enter the Answer']), function ($query) use ($typeFilter) {
                return $query->where('type', $typeFilter);
            })
            ->when($searchQuery, function ($query, $searchQuery) {
                return $query->where(function($query) use ($searchQuery) {
                    $query->where('question', 'LIKE', "%{$searchQuery}%")
                          ->orWhere('course', 'LIKE', "%{$searchQuery}%");
                });
            })
            ->paginate(25);
    
        $totalQuestions = Question::count();

        if ($typeFilter) {
            if($typeFilter == 'all') {
                session()->forget('question_filter_type');
            } else {
                session(['question_filter_type' => $typeFilter]);
            }
        } else {
            $typeFilter = session('question_filter_type', '');
        }
    
    
        return view('question.index', compact('questions', 'totalQuestions', 'typeFilter'));
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


    //store the data
    public function store(Request $request)
    {
        Log::info('Store method called');
        Log::info('Request data: ' . json_encode($request->all()));
        
        $validatedData = $request->validate([
            'course' => 'required',
            'question' => 'required',
            'type' => 'required',
            'difficulty' => 'required',
            'score' => 'required|numeric',
            // 'correct_answer' => 'required'
        ]);
    
        // Create a new question instance with the validated data
        $question = new Question($validatedData);
    
        // Set the user_id to the ID of the current authenticated user
        $question->user_id = auth()->id(); 

        

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
      
        return view('question.edit',[
            'question' => $question
        ]);
    }

    public function update(Request $request, Question $question)
    {
        if (auth()->id() !== $question->user_id) {
            abort(403);
        }

        // Validation
        $validatedData = $request->validate([
            'course' => 'required',
            'question' => 'required',
            'type' => 'required',
            'difficulty' => 'required',
            'score' => 'required|numeric',
        ]);

        // Update basic question details
        $question->update($validatedData);

        // Handling different question types
        if ($request->input('type') === 'Multiple Choice') {
            // Validate and update options and correct_answer
            $validatedOptions = $request->validate([
                'options' => 'required|array',
                'options.*' => 'required',
                'correct_answer' => 'required|in:A,B,C,D',
            ]);

            $question->options = json_encode($validatedOptions['options']);
            $question->correct_answer = $validatedOptions['correct_answer'];

        } elseif ($request->input('type') === 'True Or False') {
            // Handle True/False
            $validatedCorrectAnswer = $request->validate([
                'correct_answer' => 'required|in:True,False',
            ]);
            $question->correct_answer = $validatedCorrectAnswer['correct_answer'];

        } elseif ($request->input('type') === 'Enter the Answer') {
            // Handle Enter the Answer
            $validatedCorrectAnswer = $request->validate([
                'correct_answer' => 'required',
            ]);
            $question->correct_answer = $validatedCorrectAnswer['correct_answer'];
        }

        $question->save();

        return redirect('/question')->with('message', 'Question updated successfully!');
    }

    
    public function destroy(Question $question)
{

    if (auth()->id() !== $question->user_id) {
        abort(403);
    }

    $question->delete();

    return redirect('/question')->with('message', 'Question deleted successfully!');
}
}
