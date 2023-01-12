<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuizQuestionController;
use App\Http\Controllers\TakeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuizAnswerController;
use App\Http\Controllers\LocalizationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('lang/{locale}', [LocalizationController::class, 'index'])->name('lang');
Route::get('/quizzes/search', [QuizController::class, 'searchQuiz'])->name('quizzes.search');
Route::resource('quizzes', QuizController::class);
Route::resource('users', UserController::class)->middleware('admin');
Route::resource('quizzes.quizquestions', QuizQuestionController::class)->shallow();
Route::resource('quizzes.takes', TakeController::class)->shallow();
Route::resource('categories', CategoryController::class)->middleware('admin');
Route::resource('quizanswers', QuizAnswerController::class);
