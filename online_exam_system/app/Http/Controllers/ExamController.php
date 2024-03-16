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
    
    
   

    //Store Exam Data
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

    //Show Single Exam 
    public function show(Exam $exam) {
        // Load questions with the exam
        $exam->load('questions');
    
        $totalScore = $exam->questions->sum('score');
        return view('exam.show', compact('exam', 'totalScore'));
    }
    

    //Edit Exam
    public function edit(Exam $exam) {
        // Fetch questions that match the course of the exam
        $questions = Question::where('course', $exam->course)->get();
        
        // Rest of your existing code
        $courses = Question::distinct()->pluck('course');
        $types = Question::distinct()->pluck('type');
        $difficulties = Question::distinct()->pluck('difficulty');
        $selectedQuestionIds = $exam->questions->pluck('id')->toArray();
    
        return view('exam.edit', compact('exam', 'questions', 'courses', 'types', 'difficulties', 'selectedQuestionIds'));
    }
    public function update(Request $request, Exam $exam) {
        // dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'questions' => 'required|array',
            'questions.*' => 'exists:questions,id'
        ]);
     
        
    
        DB::beginTransaction();
        try {
            $exam->update($request->only(['title', 'course', 'duration']));
            $exam->questions()->sync($request->input('questions'));
    
            DB::commit();
            return redirect()->route('exam.index')->with('success', 'Exam updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors('There was an issue updating the exam.')->withInput();
        }
    }
    
    
}