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
   // Store new user data
   public function storeUser(Request $request)
   {
    // dd($request->all());
       $request->validate([ 
           'fname' => 'required|string|max:255',
           'lname' => 'required|string|max:255',
           'email' => 'required|email|unique:users',
           'phone' => 'required|unique:users|numeric',
           'password' => 'required|confirmed|min:6',
           'role' => 'required', 
           'date_of_birth' => 'required|date',
       ]);

       // Generate a unique ID
       $uniqueID = 'U' . mt_rand(100000, 999999);

       // Create the user
       $user = User::create([
           'unique_id' => $uniqueID,
           'first_name' => $request->fname,
           'last_name' => $request->lname,
           'email' => $request->email,
           'phone' => $request->phone,
           'password' => bcrypt($request->password),
           'date_of_birth' => $request->date_of_birth,
       ]);

       // Find the role by the name provided in the request
       $role = Role::where('name', $request->role)->first();

       // Attach the role to the user, using its ID
       if ($role) {
           $user->roles()->attach($role->id);
       } else {
           // Handle the case where the role is not found
           // For example, assign a default role or return an error message
       }

       return redirect()->route('admin.users.create')->with('success', 'User created successfully');
   }
}