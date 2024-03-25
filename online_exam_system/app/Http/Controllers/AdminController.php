<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str; // Import Str for generating unique ID

class AdminController extends Controller
{
    public function index() {
        $users = User::with('roles')->paginate(10); 
        return view('admin.users_index', compact('users'));
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
    
    
}