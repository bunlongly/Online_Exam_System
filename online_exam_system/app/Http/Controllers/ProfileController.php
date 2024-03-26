<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
    // Fetch the logged-in user with their courses
    $user = auth()->user()->load('courses');

    // Now $user->courses will contain the courses assigned to this user
    return view('profile.index', compact('user'));

      
    }
}
