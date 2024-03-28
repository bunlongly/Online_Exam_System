<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\User;
use App\Models\Course;
use App\Models\Question;
use App\Models\ExamAttempt;
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
    

    public function profile() {
        $user = auth()->user();
        $teacherId = auth()->id();
    
        $teacher = User::with(['courses.students', 'exams', 'courses.questions'])->findOrFail($teacherId);
        $totalCourses = $teacher->courses->count();
        $totalStudents = $teacher->courses->pluck('students')->flatten()->unique('id')->count();
        $totalExams = $teacher->exams->count();
    
        // Counting total questions across all courses taught by the teacher
        $totalQuestions = $teacher->courses->pluck('questions')->flatten()->count();
    
        return view('teacher.profile', compact('user', 'teacher', 'totalCourses', 'totalExams', 'totalStudents', 'totalQuestions'));
    }
    
    
}