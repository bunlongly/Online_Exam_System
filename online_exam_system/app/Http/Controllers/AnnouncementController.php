<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    // Display a listing of announcements
    public function index() {
        $user = auth()->user();
        if ($user->hasRole('teacher')) {
            // Teachers can see announcements they've created
            $announcements = Announcement::where('user_id', $user->id)->get();
        } elseif ($user->hasRole('student')) {
            // Students see announcements targeted at students
            $announcements = Announcement::where('receiver_role', 'Student')->get();
        } else {
            // Admins and other users
            $announcements = []; // Modify this based on what admins should see
        }
    
        return view('announcement.index', compact('announcements'));
    }
    
    
    // Show the form for creating a new announcement
    public function create() {
        if (auth()->user()->hasRole('teacher')) {
            $teacherId = auth()->id();
            $courses = Course::whereHas('teachers', function ($query) use ($teacherId) {
                $query->where('id', $teacherId);
            })->get();
    
            $students = User::whereHas('roles', function($q){
                $q->where('name', 'student');
            })->get();
    
            return view('announcement.create', compact('courses', 'students'));
        } else {
            abort(403); // Only teachers can create announcements
        }
    }
    
    

    // Store a newly created announcement in storage
    public function store(Request $request) 
{
    $request->validate([
        'title' => 'required|max:255',
        'message' => 'required',
        // Other validation rules if needed
    ]);

    $announcement = new Announcement();
    $announcement->title = $request->title;
    $announcement->message = $request->message;
    $announcement->user_id = auth()->id(); 

    // Handle course and student id assignment based on the request
    if ($request->has('course_id')) {
        $announcement->course_id = $request->course_id;
    }
    if ($request->has('student_id')) {
        $announcement->student_id = $request->student_id;
    }

    $announcement->save();

    return redirect()->route('announcements.index')
                     ->with('success', 'Announcement created successfully.');
}


    // Edit Announcement
    public function edit(Announcement $announcement)
    {
        if (auth()->user()->hasRole('teacher')) {
            $teacherId = auth()->id();
            
            // Get courses taught by the logged-in teacher
            $courses = Course::whereHas('teachers', function ($query) use ($teacherId) {
                $query->where('id', $teacherId);
            })->get();
    
            // Get all students for the dropdown
            $students = User::whereHas('roles', function($q) {
                $q->where('name', 'student');
            })->get();
    
            // Pass the announcement, courses, and students to the view
            return view('announcement.edit', compact('announcement', 'courses', 'students'));
        } else {
            abort(403); // If the user is not a teacher, deny access
        }
    }
    

    // Update Announcement
    public function update(Request $request, Announcement $announcement) {
        // Add validation and authorization logic if needed
        $announcement->update($request->all());
        return redirect()->route('announcements.index')->with('success', 'Announcement updated successfully');
    }

    // Delete Announcement
    public function destroy(Announcement $announcement) {
        // Add authorization logic if needed
        $announcement->delete();
        return redirect()->route('announcements.index')->with('success', 'Announcement deleted successfully');
    }

    public function indexForStudent() {
        $studentId = auth()->id();
        $studentCourses = auth()->user()->courses()->pluck('id');

        $announcements = Announcement::where(function($query) use ($studentId, $studentCourses) {
            $query->where('student_id', $studentId) // Announcements for this specific student
                  ->orWhere(function($query) use ($studentCourses) {
                      $query->whereIn('course_id', $studentCourses) // Announcements for courses the student is enrolled in
                            ->orWhereNull('course_id'); // General announcements for all students
                  });
        })->orderBy('created_at', 'desc')->get();

        return view('student.announcements', compact('announcements'));
    }

}
