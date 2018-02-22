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
Route::get('/', 'QuizController@showIndexWelcome')->name('quiz_user.index');

// new in laravel 5.3, automatically specifies authentication routes
// source code: https://github.com/laravel/framework/blob/5.6/src/Illuminate/Routing/Router.php
Route::prefix('host')->group(function() {
    Auth::routes();
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
    Route::middleware(['auth'])->group(function() {
        Route::get('dashboard', 'QuizController@showHostDashboard')->name('quiz_host.dashboard');
    });
});

Route::get('/about', function() {
    return view('quiz_user.about');
})->name('about');

// // public routes
// Route::middlware(['web', 'activity'])->group(function() {

//     Route::get('/about', function () { 
//         return view('quiz_user.about'); 
//     });

//     Route::get('/question', 'QuizController@showQuestion')->name('quiz_user.showQuestion');

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