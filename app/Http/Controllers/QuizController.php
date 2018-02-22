<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function showIndexWelcome()
    {
        return view('index.welcome');
    }

    public function showHostDashboard() 
    {
        return view('quiz_host.dashboard.index');
    }
}
