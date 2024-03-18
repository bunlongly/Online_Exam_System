<?php

namespace App\Http\Controllers;

use App\Models\Exam; // Import the Exam model
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    //Show All
    public function index()
    {
        $exams = Exam::where('added_to_dashboard', true)->get();
    
        // Pass the exams to the view
        return view('dashboard.index', compact('exams'));
    }


    //Delete Active Exam from bashboard
    public function removeFromDashboard(Exam $exam)
    {
        // Update the exam status
        $exam->added_to_dashboard = false;
        $exam->save();
    
        // Redirect with a success message
        return redirect()->route('dashboard.index')->with('success', 'Exam removed from dashboard successfully.');
    }
    
    
    


    
}
