<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\DashboardController;

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


// Home page
Route::get('/', function () {
    return view('home');
});


// Question Bank Routes
// Question index
Route::get('/question', [QuestionController::class, 'index'])->name('question.index');
// Question Create
Route::get('/question/create', [QuestionController::class, 'create'])->name('question.create');
// Question Storing Data
Route::post('/question', [QuestionController::class, 'store'])->name('question.store');
// Question Edit
Route::get('/question/{question}/edit', [QuestionController::class, 'edit'])->name('question.edit')->middleware('auth');
//Question update
Route::put('/question/{question}', [QuestionController::class, 'update'])->name('question.update')->middleware('auth');
//Question Delete
Route::delete('/question/{question}', [QuestionController::class, 'destroy'])->name('question.destroy')->middleware('auth');
//Question show
Route::get('/question/{question}', [QuestionController::class, 'show'])->name('question.show');


//Exam routes
//Exam Index
Route::get('/exam', [ExamController::class, 'index'])->name('exam.index')->middleware('auth');
//Exam Create
Route::get('/exam/create', [ExamController::class, 'create'])->name('exam.create')->middleware('auth');
//Fetch the Questions from the question bank to the exam 
Route::get('/fetch-questions', [ExamController::class, 'fetchQuestions']);
//Store the exam data
Route::post('/exam', [ExamController::class, 'store'])->name('exam.store');
//Exam Show
Route::get('/exam/{exam}', [ExamController::class, 'show'])->name('exam.show')->middleware('auth');
//Exam Edit
Route::get('/exam/{exam}/edit', [ExamController::class, 'edit'])->name('exam.edit')->middleware('auth');
//Exam Update 
Route::put('/exam/{exam}', [ExamController::class, 'update'])->name('exam.update')->middleware('auth');
//Exam Delete
Route::delete('/exam/{exam}', [ExamController::class, 'destroy'])->name('exam.destroy')->middleware('auth');

//Exam Toggle Publish
// Route::patch('/exam/{exam}/toggle-publish', [ExamController::class, 'togglePublish'])->name('exam.toggle-publish');

// Add exam to Dashboard
Route::patch('/exam/{exam}/add-to-dashboard', [ExamController::class, 'addToDashboard'])->name('exam.add-to-dashboard')->middleware('auth');

//Exam Toggle Publish
Route::patch('/exam/toggle-publish/{exam}', [ExamController::class, 'togglePublish'])->name('exam.toggle-publish');




//Dashboard Routes
//Dashboard Index
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
//Dashboard Remove Active Exam from dashboard
Route::patch('/dashboard/{exam}/remove', [DashboardController::class, 'removeFromDashboard'])->name('dashboard.remove')->middleware('auth');


//Profile Routes
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');


// User routes
// User Register
Route::get('/register', [UserController::class, 'create'])->middleware('guest');
// User Storing Data
Route::post('/users', [UserController::class, 'store']);
//User Logout
Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');
// User Login
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
// User authenticate
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
