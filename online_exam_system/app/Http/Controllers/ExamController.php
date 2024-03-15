<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    //index
    public function index(){
        return view('exam.index');
    }

    public function create(){
        $questions = Question::all(); // Fetch all questions
        $courses = Question::distinct()->pluck('course'); // Get distinct courses
        $types = Question::distinct()->pluck('type'); // Get distinct types
        $difficulties = Question::distinct()->pluck('difficulty'); // Get distinct difficulties
    
        return view('exam.create', compact('questions', 'courses', 'types', 'difficulties'));

    }

    public function fetchQuestions(Request $request) {
        $query = Question::query();
    
        if ($request->has('course') && $request->input('course') !== 'Choose a course') {
            $query->where('course', $request->input('course'));
        }
    
        if ($request->has('type') && $request->input('type') !== 'Choose a type') {
            $query->where('type', $request->input('type'));
        }
    
        if ($request->has('difficulty') && $request->input('difficulty') !== 'Choose a difficulty') {
            $query->where('difficulty', $request->input('difficulty'));
        }
    
        $questions = $query->get();
    
        return response()->json($questions);
    }
    
}
