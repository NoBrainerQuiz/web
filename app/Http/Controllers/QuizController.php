<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;

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

    public function showQuestion()
    {
        return view('quiz_user.question');
    }

    public function showPin()
    {
        return view('quiz_user.pin');
    }

    public function showSplash()
    {
        return view('quiz_user.splash');
    }

    public function enterQuizPin(Request $request)
    {
        // @TODO - PIN max length needs to be dynamic with trait
        // will sort out soon - Matt.
        $validatedData = $request->validate([
            'pin'      => 'required|string'
        ]);

        // FIX XSS HERE ALSO
        $quiz = Quiz::where('quiz_pin', $request->get('pin'))
                    ->where('active', 1)
                    ->first();

        if (!$quiz->exists()) {
            return back()->with('pin_error', 'Either the quiz doesn\'t exist, or it hasn\'t been activated');
        } else {
            //Add user to the socket.io stuff!
            event(new \App\Events\addUser($request->get('username'))); //Adds the user to the socket stuff
            return redirect()->route('quiz_user.showSplash')->with('quizData', $quiz);
        }
    }
}
