<?php

use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Home page
Route::get('/', function () {
    return view('home');
});

//Question Bank
Route::get('/question', [QuestionController::class, 'index']);


//Create the Question
Route::get('/question/create', [QuestionController::class, 'create'])->name('question.create');



//Storing Question Data
Route::post('/question', [QuestionController::class, 'store']);


//Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

//Create New User
Route::post('/users', [UserController::class, 'store']);

//Log User Out
Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');


//Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');


//Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
