<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Course;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    //index Exam
    public function index(){
       
        
        $exams = Exam::with(['questions' => function ($query) {
            $query->where('user_id', auth()->id());
        }, 'user'])->where('user_id', auth()->id())->paginate(25);
        
        
        
        return view('exam.index', compact('exams'));
    }
    public function create() {
        // Fetch all questions
        $questions = Question::all();

        // Fetch courses that have associated questions
        $courses = Course::has('questions')->get();

        // Get distinct types and difficulties from questions
        $types = Question::distinct()->pluck('type');
        $difficulties = Question::distinct()->pluck('difficulty');

        // Return the view with the necessary data
        return view('exam.create', compact('questions', 'courses', 'types', 'difficulties'));
    }


    public function fetchQuestions(Request $request) {
        $courseId = $request->input('course_id');
        $type = $request->input('type');
        $difficulty = $request->input('difficulty');
        
        $questions = Question::when($courseId, function($query) use ($courseId) {
            return $query->where('course_id', $courseId);
        })
        ->when($type, function($query) use ($type) {
            return $query->where('type', $type);
        })
        ->when($difficulty, function($query) use ($difficulty) {
            return $query->where('difficulty', $difficulty);
        })
        ->with('course')
        ->where('user_id', auth()->id())
        ->get();
    
        return response()->json($questions);
    }
    
    
    
   

    //Store Exam Data
    public function store(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'duration' => 'required|integer|min:1',
            'questions' => 'required|array',
            'questions.*' => 'exists:questions,id',
            'start_time' => 'required|date_format:Y-m-d\TH:i',
            'end_time' => 'required|date_format:Y-m-d\TH:i', 
        ]);
    
        DB::beginTransaction();
        try {
            $examData = $request->only(['title', 'course_id', 'duration', 'start_time', 'end_time']); // Include start_time and end_time
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
            // Check if the exam belongs to the logged-in user
            if (auth()->id() !== $exam->user_id) {
                return back()->withErrors('Unauthorized access to exam.');
            }

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
          // Check if the exam belongs to the logged-in user
          if (auth()->id() !== $exam->user_id) {
            return back()->withErrors('Unauthorized access to exam.');
        }

        // Fetch questions that match the course of the exam
        $questions = Question::where('course_id', $exam->course_id)->get();
    
        $courses = Question::distinct()->pluck('course_id');
        $types = Question::distinct()->pluck('type');
        $difficulties = Question::distinct()->pluck('difficulty');
        $selectedQuestionIds = $exam->questions->pluck('id')->toArray();
    
        // Format the start and end times for the datetime-local input
        $formattedStartTime = $exam->start_time ? $exam->start_time->format('Y-m-d\TH:i') : null;
        $formattedEndTime = $exam->end_time ? $exam->end_time->format('Y-m-d\TH:i') : null;
    
        return view('exam.edit', compact('exam', 'questions', 'courses', 'types', 'difficulties', 'selectedQuestionIds', 'formattedStartTime', 'formattedEndTime'));
    }

 
public function update(Request $request, Exam $exam) {
           // Check if the exam belongs to the logged-in user
           if (auth()->id() !== $exam->user_id) {
            return back()->withErrors('Unauthorized access to exam.');
        }
    $request->validate([
        'title' => 'required|string|max:255',
        'course' => 'required|string|max:255',
        'duration' => 'required|integer|min:1',
        'questions' => 'required|array',
        'questions.*' => 'exists:questions,id',
        'start_time' => 'required|date_format:Y-m-d\TH:i', 
        'end_time' => 'required|date_format:Y-m-d\TH:i',  
    ]);
    
    DB::beginTransaction();
    try {
        // Update the exam details
        $exam->update([
            'title' => $request->title,
            'course' => $request->course,
            'duration' => $request->duration,
            'start_time' => $request->start_time, 
            'end_time' => $request->end_time,     
        ]);
        $exam->questions()->sync($request->input('questions'));
    
        DB::commit();
        return redirect()->route('exam.index')->with('success', 'Exam updated successfully!');
    } catch (\Exception $e) {
        DB::rollback();
        return back()->withErrors('Error: ' . $e->getMessage())->withInput();
    }
}

    
    public function destroy(Exam $exam)
{

          // Check if the exam belongs to the logged-in user
          if (auth()->id() !== $exam->user_id) {
            return back()->withErrors('Unauthorized access to exam.');
        }

    $exam->delete(); // Delete the exam

    return redirect()->route('exam.index')->with('success', 'Exam deleted successfully!');
}



public function togglePublish(Exam $exam)
{
    if (auth()->id() !== $exam->user_id) {
        abort(403);
    }

    $exam->published = !$exam->published;
    if ($exam->published) {
        $exam->start_time = now(); // Start time set at the moment of publishing
    }

    
    $exam->save();

    $remainingTime = 0;
    if ($exam->published) {
        $remainingTime = $exam->duration * 60 - now()->diffInSeconds($exam->start_time);
    }

    return response()->json([
        'published' => $exam->published,
        'remainingTime' => $remainingTime
    ]);
}



//Add Exam to dashboard
public function addToDashboard(Exam $exam) {
    $exam->added_to_dashboard = true;
    $exam->save();

    return redirect()->route('dashboard.index')->with('success', 'Exam added to dashboard successfully!');
}


}
