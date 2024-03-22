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
        $formFields = $request->validate([
            'fname' => 'required|min:3',
            'lname' => 'required|min:3',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'phone' => 'required|numeric',
            'password' => 'required|confirmed|min:6',
            'role' => 'required', // Ensure role name is provided
            'date_of_birth' => 'required|date',
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        $uniqueID = 'U' . mt_rand(100000, 999999);

        // Create User
        $user = User::create([
            'unique_id' => $uniqueID,
            'first_name' => $formFields['fname'],
            'last_name' => $formFields['lname'],
            'email' => $formFields['email'],
            'phone' => $formFields['phone'],
            'password' => $formFields['password'],
            'date_of_birth' => $formFields['date_of_birth'],
        ]);

        // Assign role to the user
        $role = Role::where('name', $formFields['role'])->first();
        if ($role) {
            $user->roles()->attach($role->id);
        } else {
            // Handle the case where role doesn't exist or assign a default role
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

