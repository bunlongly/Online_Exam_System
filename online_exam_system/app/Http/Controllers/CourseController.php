<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index() {
        $courses = Course::paginate(10); 
        $totalCourses = Course::count();
        return view('courses.index', compact('courses', 'totalCourses'));
    }
    

    public function create() {
        return view('courses.create');
    }

    public function store(Request $request) {
                // Validate the request data
                $request->validate([
                    'name' => 'required|string|max:255',
                ]);
        
                // Create a new course
                Course::create([
                    'name' => $request->name,
                ]);
        
                // Redirect back with a success message
                return redirect()->route('courses.index')->with('success', 'Course created successfully!');
            }

            public function edit($id)
            {
                $course = Course::findOrFail($id);
                return view('courses.edit', compact('course'));
            }
        
            public function update(Request $request, $id)
            {
                $request->validate([
                    'name' => 'required|string|max:255',
                ]);
        
                $course = Course::findOrFail($id);
                $course->update([
                    'name' => $request->name,
                ]);
        
                return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
            }
        
            public function destroy($id)
            {
                $course = Course::findOrFail($id);
                $course->delete();
                return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
            }
}
