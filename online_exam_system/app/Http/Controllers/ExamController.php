<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    //index Exam
    public function index(){
       
        
        $exams = Exam::with(['questions', 'user'])->paginate(25);
        
        
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
    $request->validate([
        'title' => 'required|string|max:255',
        'course' => 'required|string|max:255',
        'duration' => 'required|integer|min:1',
        'questions' => 'required|array',
        'questions.*' => 'exists:questions,id'
    ]);

    DB::beginTransaction();
    try {
        $examData = $request->only(['title', 'course', 'duration']);
        $examData['user_id'] = auth()->id(); // Assign the user ID

        $exam = Exam::create($examData);
        $exam->questions()->attach($request->input('questions'));

        DB::commit();
        return redirect()->route('exam.index')->with('success', 'Exam created successfully!');
    } catch (\Exception $e) {
        DB::rollback();
        return back()->withErrors('Error: ' . $e->getMessage());
    }
}


    //Show Single Exam 
    public function show(Exam $exam) {
        // Load the user relationship only
        $exam->load('user');
    
        // Paginate the questions relationship
        $questions = $exam->questions()->paginate(10); // Adjust the pagination size as needed
    
        // Calculate the total score of all related questions
        $totalScore = $exam->questions()->sum('score');
    
        // Return the view with the paginated questions and the exam
        return view('exam.show', compact('exam', 'questions', 'totalScore'));
    }
    
    
    
    

    //Edit Exam
    public function edit(Exam $exam) {
        // Fetch questions that match the course of the exam
        $questions = Question::where('course', $exam->course)->get();
    
        $courses = Question::distinct()->pluck('course');
        $types = Question::distinct()->pluck('type');
        $difficulties = Question::distinct()->pluck('difficulty');
        $selectedQuestionIds = $exam->questions->pluck('id')->toArray();
    
        return view('exam.edit', compact('exam', 'questions', 'courses', 'types', 'difficulties', 'selectedQuestionIds'));
    }

    //Update Exam
    public function update(Request $request, Exam $exam) {
        if (auth()->id() !== $exam->user_id) {
            abort(403);
            // return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
        }
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
    
    public function destroy(Exam $exam)
{

    if (auth()->id() !== $exam->user_id) {
        abort(403);
        // return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
    $exam->delete(); // Delete the exam

    return redirect()->route('exam.index')->with('success', 'Exam deleted successfully!');
}

    
}