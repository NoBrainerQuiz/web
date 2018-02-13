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

Route::get('/', function () {
    return view('quiz_user.index');
});

Route::get('/about', function () {
    return view('quiz_user.about');
});

Route::get('/question', function () {
    return view('quiz_user.question');
});

Route::get('/signup', function () {
    return view('quiz_user.signUp');
});

Route::get('/login', function () {
    return view('quiz_user.login');
});

Route::get('/fire', function () {
    // this fires the event
    event(new App\Events\Sockets(10));
    return "event fired";
});


Route::get('/test', function () {
    // this checks for the event
    return "ey";
});
