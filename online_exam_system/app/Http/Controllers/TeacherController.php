<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function teacherCoursesWithStudents($teacherId)
    {
        $teacherCourses = Course::with(['teachers', 'students'])
                                ->whereHas('teachers', function ($query) use ($teacherId) {
                                    $query->where('users.id', $teacherId);
                                })->get();
    
        $totalCourses = $teacherCourses->count();
        $totalStudentsPerCourse = $teacherCourses->mapWithKeys(function($course) {
            return [$course->name => $course->students->count()];
        });
    
        return view('teacher.courses', compact('teacherCourses', 'totalCourses', 'totalStudentsPerCourse'));
    }
    
    
}