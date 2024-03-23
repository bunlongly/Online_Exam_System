<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Import Str for generating unique ID

class AdminController extends Controller
{
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
    
        return redirect()->route('admin.users.create')->with('success', 'User created successfully');
    }
}
    