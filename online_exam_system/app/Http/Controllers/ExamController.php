<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    //index
    public function index(){
       
        $exams = Exam::with('questions')->get();
    
        // Pass the exams to the view
        return view('exam.index', compact('exams'));
    }

    public function create(){
        $questions = Question::all(); // Fetch all questions
        $courses = Question::distinct()->pluck('course'); // Get distinct courses
        $types = Question::distinct()->pluck('type'); // Get distinct types
        $difficulties = Question::distinct()->pluck('difficulty'); // Get distinct difficulties
    
        return view('exam.create', compact('questions', 'courses', 'types', 'difficulties'));

    }
    public function fetchQuestions(Request $request) {
        $course = $request->input('course');
        $type = $request->input('type');
        $difficulty = $request->input('difficulty');
    
        $questions = Question::when($course, function($query) use ($course) {
                          return $query->where('course', $course);
                      })
                      ->when($type, function($query) use ($type) {
                          return $query->where('type', $type);
                      })
                      ->when($difficulty, function($query) use ($difficulty) {
                          return $query->where('difficulty', $difficulty);
                      })
                      ->get();
    
        return response()->json($questions);
    }
    
    
   

    public function store(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'questions' => 'required|array',
            'questions.*' => 'exists:questions,id' // Make sure each question ID exists in the database
        ]);

        // Start transaction
        DB::beginTransaction();
        try {
            // Create the exam
            $exam = Exam::create($request->only(['title', 'course', 'duration']));

            // Attach questions to the exam
            $exam->questions()->attach($request->input('questions'));

            // Commit transaction
            DB::commit();

            return redirect()->route('exam.index')->with('success', 'Exam created successfully!');
        } catch (\Exception $e) {
            // Rollback transaction
            DB::rollback();

            // Handle the error
            return back()->withErrors('There was an issue creating the exam.')->withInput();
        }
    }

    public function show(Exam $exam) {
        // Load questions with the exam
        $exam->load('questions');
    
        return view('exam.show', compact('exam'));
    }
    
}