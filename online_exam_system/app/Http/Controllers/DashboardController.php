<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam; // Import the Exam model

class DashboardController extends Controller
{

   // Show All Exams for Logged-in User
   public function index()
   {
       // Fetch exams created by the logged-in user that are added to the dashboard
       $exams = Exam::with(['user', 'questions'])
                   ->where('user_id', Auth::id())
                   ->where('added_to_dashboard', true)
                   ->paginate(10); 
       
       // Pass the exams to the view
       return view('dashboard.index', compact('exams'));
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
