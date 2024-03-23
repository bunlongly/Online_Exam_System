<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
// use Illuminate\Foundation\Auth\User;

class UserController extends Controller
{
    //Show Register/Create Form
    public function create(){
        return view('users.register');
    }

    //Create New User
    // Create New User with additional fields
    public function store(Request $request)
    {
        // Validate input data
        $formFields = $request->validate([
            'fname' => 'required|min:3',
            'lname' => 'required|min:3',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'phone' => 'required|numeric',
            'password' => 'required|confirmed|min:6',
            'role' => 'required',
            'profile_image' => 'nullable|image|max:2048',
            'date_of_birth' => 'required|date',
        ]);
    
        // Handle Image Upload
        if ($request->hasFile('profile_image')) {
            $imageName = $request->file('profile_image')->store('profile_images', 'public');
            $formFields['profile_image'] = $imageName;
        }
    
        // Assign first_name and last_name from fname and lname
        $formFields['first_name'] = $formFields['fname'];
        $formFields['last_name'] = $formFields['lname'];


        // Hash the password
        $formFields['password'] = bcrypt($formFields['password']);
    
        // Determine prefix based on role
        $prefix = $formFields['role'] === 'teacher' ? 'T' : 'S';
    
        // Generate unique ID with prefix
        $uniqueID = $prefix . mt_rand(100000, 999999);
    
        // Add unique_id to form fields
        $formFields['unique_id'] = $uniqueID;
    
        // Create the user
        $user = User::create($formFields);
    
        // Assign role to the user
        $role = Role::where('name', $formFields['role'])->first();
        if ($role) {
            $user->roles()->attach($role->id);
        } else {
            // Handle case where role is not found
            $defaultRole = Role::where('name', 'student')->first();
            $user->roles()->attach($defaultRole->id);
        }
    
        // Login the new user
        auth()->login($user);
    
        return redirect('/')->with('message', 'User created and logged in');
    }
    


    //Logout User
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out');

    }

    public function login(){
        return view('users.login');
    }

    //Authenticate User
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerateToken();

            return redirect('/')->with('message', 'You are now logged in');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}

