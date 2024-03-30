<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Role;
use App\Models\User;
use App\Models\Course;
use App\Models\Question;
use App\Models\ExamAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str; // Import Str for generating unique ID

class AdminController extends Controller
{
    public function index() {
        $users = User::with('roles')->paginate(10); 
        return view('admin.users_index', compact('users'));
    }

    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);
    
        // Detach all associated roles
        $user->roles()->detach();
    
        // Now delete the user
        $user->delete();
    
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
    
    


    //Course Overview
    public function coursesOverview()
    {
        $courses = Course::with(['teachers', 'students'])->get();
        $totalCourses = $courses->count();
        $totalStudents = User::whereHas('roles', function ($query) {
            $query->where('name', 'student');
        })->count();
        $totalTeachers = User::whereHas('roles', function ($query) {
            $query->where('name', 'teacher');
        })->count();
    
        $coursesWithoutEnrollment = $courses->filter(function ($course) {
            return $course->students->isEmpty() && $course->teachers->isEmpty();
        });
    
        return view('admin.courses-overview', compact('courses', 'totalCourses', 'totalStudents', 'totalTeachers', 'coursesWithoutEnrollment'));
    }
    


    // Display form to create a new user
    public function createUserForm()
    {
        $roles = Role::all(); // assuming you have a Role model
        return view('admin.createUser', compact('roles'));
    }

    // Store new user data
    public function storeUser(Request $request)
    {
        $formFields = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users|numeric',
            'password' => 'required|confirmed|min:6',
            'role' => 'required',
            'profile_image' => 'nullable|image|max:2048',
            'date_of_birth' => 'required|date',
        ]);
    
        if ($request->hasFile('profile_image')) {
            $imageName = $request->file('profile_image')->store('profile_images', 'public');
            $formFields['profile_image'] = $imageName;
        }
    
        // Assign first_name and last_name from fname and lname
        $formFields['first_name'] = $formFields['fname'];
        $formFields['last_name'] = $formFields['lname'];


        $formFields['password'] = bcrypt($formFields['password']);
        $prefix = $request->role === 'teacher' ? 'T' : 'S';
        $formFields['unique_id'] = $prefix . mt_rand(100000, 999999);
    
        $user = User::create($formFields);
    
        $role = Role::where('name', $request->role)->first();
        if ($role) {
            $user->roles()->attach($role->id);
        } else {
            // handle case where role is not found
        }
    
        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }

 
    public function showAssignCourseForm()
    {
        $teachers = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'teacher');
        })->get();
    
        $courses = Course::all();

    
        return view('admin.assign-course', compact('teachers', 'courses'));
    }
    


    public function storeAssignCourse(Request $request)
    {
        // Validate the request data
        $request->validate([
            'teacher_id' => 'required|exists:users,id',
            'courses' => 'required|array',
            'courses.*' => 'exists:courses,id'
        ]);
    
        // Find the teacher user by ID
        $teacher = User::findOrFail($request->teacher_id);
    
        // Fetch the current course IDs assigned to the teacher
        $currentCourseIds = $teacher->courses->pluck('id')->toArray();
    
        // Filter out the courses that are already assigned to the teacher
        $newCourseIds = array_diff($request->courses, $currentCourseIds);
    
        if (empty($newCourseIds)) {
            return redirect()->back()->with('error', 'No new courses to assign. This teacher already has the selected courses.');
        }
    
        // Prepare the course data with timestamps for the new courses
        $courseData = collect($newCourseIds)
            ->mapWithKeys(function ($courseId) {
                return [$courseId => ['created_at' => now(), 'updated_at' => now()]];
            })->toArray();
    
        // Sync the new courses to the teacher with custom timestamps
        $teacher->courses()->syncWithoutDetaching($courseData);
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'New courses assigned successfully.');
    }
    

        public function showAssignCourseToStudentForm()
    {
        $students = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'student');
        })->get();

        $courses = Course::all();
        return view('admin.assign-course-to-student', compact('students', 'courses'));
    }

    

    public function storeAssignCourseToStudent(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
            'course_ids' => 'required|array',
            'course_ids.*' => 'exists:courses,id'
        ]);
    
        $student = User::findOrFail($validated['student_id']);
    
        // Fetch the current course IDs assigned to the student
        $currentCourseIds = $student->courses->pluck('id')->toArray();
    
        // Filter out the courses that are already assigned to the student
        $newCourseIds = array_diff($validated['course_ids'], $currentCourseIds);
    
        if (empty($newCourseIds)) {
            return redirect()->back()->with('error', 'No new courses to assign. This student already has the selected courses.');
        }
    
        // Preparing pivot data with timestamps
        $pivotData = array_fill_keys($newCourseIds, ['created_at' => now(), 'updated_at' => now()]);
    
        // Sync new courses with pivot data (timestamps)
        $student->courses()->syncWithoutDetaching($pivotData);
    
        return redirect()->back()->with('success', 'Courses assigned to student successfully.');
    }
    
    
    public function studentExamHistory() {
        $examAttempts = ExamAttempt::with('student', 'exam', 'exam.course.teachers')
                                   ->orderBy('created_at', 'desc')
                                   ->paginate(10);
    
        return view('admin.student-exam-history', compact('examAttempts'));
    }
    
    public function adminProfile() {
        $user = auth()->user();
    
        $totalTeachers = User::whereHas('roles', function($q) {
            $q->where('name', 'teacher');
        })->count();
    
        $totalStudents = User::whereHas('roles', function($q) {
            $q->where('name', 'student');
        })->count();
    
        // Fetch additional statistics
        $totalCourses = Course::count();
        $totalExams = Exam::count();
        $totalExamAttempts = ExamAttempt::count();
        $totalQuestions = Question::count();
    
        return view('admin.profile', compact('user', 'totalTeachers', 'totalStudents', 'totalCourses', 'totalExams', 'totalExamAttempts', 'totalQuestions'));
    }
    
    
    

    
}