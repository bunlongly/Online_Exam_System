<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam; // Import the Exam model

class DashboardController extends Controller
{

   // Show All Exams for Logged-in User
   public function index()
{
    // Fetch exams created by the logged-in teacher that are added to the dashboard
    $exams = Exam::with(['user', 'questions'])
                ->where('user_id', Auth::id())
                ->where('added_to_dashboard', true)
                ->paginate(10);

    // Assuming you have a relationship 'courses' in your User model
    $courses = auth()->user()->courses;

    // Calculating total students in all courses (assumes 'students' relationship in Course model)
    $totalStudents = $courses->reduce(function ($carry, $course) {
        return $carry + $course->students->count();
    }, 0);

    // Calculating total exams and total questions
    $totalExams = auth()->user()->exams->count();
    $totalQuestions = Question::where('user_id', Auth::id())->count();


    // Pass the data to the view
    return view('dashboard.index', compact('exams', 'courses', 'totalStudents', 'totalExams', 'totalQuestions'));
}

    //Delete Active Exam from dashboard
    public function removeFromDashboard(Exam $exam)
    {
        // Check if the logged-in user owns the exam
        if ($exam->user_id != Auth::id()) {
            // Redirect with an error message if the user doesn't own the exam
            return back()->withErrors('You do not have permission to remove this exam.');
        }

        // Update the exam status to not show on the dashboard
        $exam->added_to_dashboard = false;
        $exam->save();
    
        // Redirect with a success message
        return redirect()->route('dashboard.index')->with('success', 'Exam removed from dashboard successfully.');


    }    
   
}
