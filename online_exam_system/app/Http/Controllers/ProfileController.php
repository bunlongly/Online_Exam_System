<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ExamAttempt;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        // Fetch the logged-in user with their courses
        $user = auth()->user()->load('courses');
        
        // Calculate the number of exam attempts
        $totalExamAttempts = ExamAttempt::where('student_id', $user->id)->count();

        // Fetch the highest score achieved in a course
        $highestScoreExam = ExamAttempt::where('student_id', $user->id)
                                       ->with('exam.course')
                                       ->orderBy('score', 'desc')
                                       ->first();

        return view('student.profile', compact('user', 'totalExamAttempts', 'highestScoreExam'));
    }


    public function update(Request $request){
        $user = auth()->user();
    
        // Validate the input fields
        $formFields = $request->validate([
            'current_password' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'username' => 'required|string|max:255',
            'password' => 'nullable|confirmed|min:6',
            'profile_image' => 'nullable|image|max:2048', // Validating the image
        ]);
    
        // Check if the current password is correct
        if (!Hash::check($formFields['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }
    
        // Update the username (first name)
        $user->first_name = $formFields['username'];
    
        // Update the email
        $user->email = $formFields['email'];
    
        // Handle Profile Image Upload
        if ($request->hasFile('profile_image')) {
            // Add your logic to store the image and get the path
            $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $profileImagePath;
        }
    
        // Update the password if it's set
        if(!empty($formFields['password'])){
            $user->password = Hash::make($formFields['password']);
        }
    
        // Save the updates
        $user->save();
    
        return back()->with('message', 'Profile updated successfully.');
    }

    
}
