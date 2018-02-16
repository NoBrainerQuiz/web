<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function quizUserIndex()
    {
        return view('quiz_user.index');
    }
}
