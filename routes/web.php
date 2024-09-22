<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

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
Route::get('/fetch-quiz', [QuizController::class, 'fetchQuiz']);
Route::middleware(['auth' ])->group(function () {
    Route::get('/', [QuizController::class, 'Quiz']);
    Route::post('/quiz/submit', [QuizController::class, 'submitQuiz'])->name('quiz.submit');
    Route::post('/temp-correct-answers', [QuizController::class, 'store'])->name('temp_correct_answers.store');
    Route::get('/evaluate-quiz', [QuizController::class, 'evaluateQuiz'])->name('quiz.evaluate');
});

#Authentication
Route::get('/login',[AuthController::class,'showLogin'] )->name('login.form');
Route::get('/signup',[AuthController::class,'showRegister'] );
Route::post('/register/user',[AuthController::class,'onRegister'] );
Route::post('/login/user',[AuthController::class,'onLogin'] );
Route::get('/logout',[AuthController::class,'logout'] );