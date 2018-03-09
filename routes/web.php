<?php

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

// homepage route
Route::get('/', 'QuizController@showIndexWelcome')->name('welcome');

// new in laravel 5.3, automatically specifies authentication routes
// source code: https://github.com/laravel/framework/blob/5.6/src/Illuminate/Routing/Router.php
Route::prefix('host')->group(function() {
    Auth::routes();
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
    Route::prefix('dashboard')->middleware(['auth'])->group(function() {
        Route::get('/', 'QuizController@showHostDashboard')->name('quiz_host.dashboard');
        Route::get('quiz/manage', 'QuizController@showHostManageQuizzes')->name('quiz_host.dashboard.manage-quizzes');
        Route::get('quiz/create', 'QuizController@create')->name('quiz_host.dashboard.quiz.create');
    });
});

Route::post('pin', 'QuizController@enterQuizPin')->name('pin-enter');

Route::get('/about', function() {
    return view('quiz_user.about');
})->name('about');

// // public routes
// Route::middlware(['web', 'activity'])->group(function() {

//     Route::get('/about', function () {
//         return view('quiz_user.about');
//     });

Route::get('/question', 'QuizController@showQuestion')->name('quiz_user.showQuestion');
Route::get('/splash', 'QuizController@showSplash')->name('quiz_user.showSplash');
Route::get('/pin', 'QuizController@showPin')->name('quiz_user.showPin');
Route::get('/leaderboards', 'QuizController@leaderboards')->name('quiz_user.leaderboards');

Route::get('/quiz/{method}/{pin}', function () {
  $pin = request('pin');
  $method = request('method');
  event(new App\Events\Sockets($pin, $method));
  return "event fired.. users should have been redirected for pin: " . $pin;
});

//Route::get('/pin', 'QuizController@showQuestion')->name('quiz_user.showQuestion');

//     Route::get('/answer', 'QuizController@showAnswer')->name('quiz_user.showAnswer');

//     Route::get('/fire', function () {
//         event(new App\Events\Sockets());
//         return "event fired";
//     });

// });

// // Registered and activated host user routes
// Route::middleware(['auth', 'activated', 'activity'])->group(function() {
//     Route::get('activation-required', 'ActivationController@activationRequired')
//         ->name('quiz_host.activation-required');

//     Route::get('/logout', 'Auth\LoginController@logout')->name('quiz_user.logout');
// });
