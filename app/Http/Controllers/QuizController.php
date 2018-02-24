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

    public function enterQuizPin(Request $request)
    {
        // @TODO - PIN max length needs to be dynamic with trait
        // will sort out soon - Matt.
        $validatedData = $request->validate([
            'username' => 'required|string',
            'pin'      => 'required|string'
        ]);

        // if (Quiz::where('quiz_pin', $request->get('pin'))->where('active', 1)->get()->isEmpty()) {
        //     return back()->with('errors', 'The quiz PIN does not exist');
        // } else {
        //     return back()->with('success', 'Whoa, the quiz exists');
        // }

        // FIX XSS HERE ALSO

        $quiz = Quiz::where('quiz_pin', $request->get('pin'))
                    ->where('active', 1)
                    ->first();

        if (!$quiz->exists()) {
            return back()->with('pin_error', 'Either the quiz doesn\'t exits, or it hasn\'t been activated');
        } else {
            return back()->with('success', 'The quiz ' . $quiz->quiz_name . ' exits and is ready to play.');
        }
    }
}
