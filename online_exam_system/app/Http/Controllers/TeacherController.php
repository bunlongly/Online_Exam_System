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


    public function studentExamHistory() {
        $teacherId = auth()->id(); // Get the logged-in teacher's ID
    
        // Fetch courses taught by the teacher and their student's exam attempts
        $courses = Course::whereHas('teachers', function ($query) use ($teacherId) {
            $query->where('id', $teacherId); // Ensure only courses taught by this teacher are selected
        })->with('exams.examAttempts.student')->get();
    
        // Extract exam attempts from courses
        $examAttempts = $courses->flatMap(function ($course) {
            return $course->exams->flatMap(function ($exam) {
                return $exam->examAttempts;
            });
        });
    
       
        $perPage = 10; 
        $page = request('page', 1);
        $total = $examAttempts->count();
    
        $examAttempts = new \Illuminate\Pagination\LengthAwarePaginator(
            $examAttempts->forPage($page, $perPage), 
            $total, 
            $perPage, 
            $page, 
            ['path' => request()->url(), 'query' => request()->query()]
        );
    
        return view('teacher.student-exam-history', compact('examAttempts'));
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