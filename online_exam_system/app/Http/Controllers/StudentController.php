<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\StudentExamAttempt;

class StudentController extends Controller
{
    
    
    public function dashboard()
    {
        $studentId = auth()->id();
    

        $exams = Exam::with('publisher', 'course', 'questions')
                     ->whereHas('course.students', function ($query) use ($studentId) {
                         $query->where('users.id', $studentId);
                     })->where('published', true)->get();
        
        // Fetching enrolled courses and their respective teachers
        $enrolledCourses = Course::with('teachers') 
                                ->whereHas('students', function ($query) use ($studentId) {
                                    $query->where('users.id', $studentId);
                                })->get();
    
                                 
        return view('student.dashboard', compact('exams', 'enrolledCourses'));
    }
    
    
    



    public function show(Exam $exam, Request $request) {
        $studentId = auth()->id();
        if (StudentExamAttempt::where('student_id', $studentId)->where('exam_id', $exam->id)->exists()) {
            return redirect()->route('student.dashboard')->with('error', 'You have already taken this exam.');
        }

        $perPage = 10; // One question per page
        $currentPage = $request->input('page', 1); // Default to the first page if no page is set
        $totalQuestions = $exam->questions()->count(); // Count total questions
        $totalPages = ceil($totalQuestions / $perPage); // Calculate total pages
    
        // Fetch questions for the current page
        $questions = $exam->questions()->skip(($currentPage - 1) * $perPage)->take($perPage)->get();
    
        $endTime = $exam->start_time->addMinutes($exam->duration);
    
        $types = $exam->questions->pluck('type')->unique();
        $difficulties = $exam->questions->pluck('difficulty')->unique();
    
        
        // Pass the subset of questions to the view
        return view('student.exam-show', [
            'exam' => $exam,
            'questions' => $questions,
            'endTime' => $endTime,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'types' => $types,
            'difficulties' => $difficulties,
        ]);
    }
    
    


    public function submitExam(Request $request, Exam $exam) {
        $studentId = auth()->id();
        $totalScore = 0;
        $correctAnswersCount = 0;
        
        // Get all questions for the exam with their answers
        $questions = $exam->questions()->get();
        
        // Calculate total available points for the exam
        $totalAvailablePoints = $questions->sum('score');
        
        // Check each answer from the student
        foreach ($questions as $question) {
            $studentAnswer = $request->input("answers.{$question->id}");
            if ($studentAnswer == $question->correct_answer) {
                $correctAnswersCount++;
                $totalScore += $question->score;
            }
        }
    
        // Check if the student scored more than 50% of the total available points
        $passed = ($totalScore / $totalAvailablePoints) >= 0.5;
    
      
    
        StudentExamAttempt::create([
            'student_id' => $studentId,
            'exam_id' => $exam->id,
            'attempted_at' => now(),
        ]);
    

        
        // Redirect to a results page or return a view
        return view('student.exam-results', compact('totalScore', 'passed', 'correctAnswersCount', 'totalAvailablePoints'));
    }
    

}
