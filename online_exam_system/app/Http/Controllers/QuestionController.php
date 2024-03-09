<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function createQuestion(){
        return view('question.create');
    }
}
