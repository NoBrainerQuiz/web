<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function showIndexWelcome()
    {
        return view('index.welcome');
    }

    public function showHostDashboard()
    {
        // Move to trait/facade/logic class @TODO
        $quizCount = DB::table('user_quizzes')->where('user_id', Auth::user()->id)->count();
        return view('quiz_host.dashboard.index')->with('quizCount', $quizCount);
    }

    public function showHostManageQuizzes()
    {
        $quizzes = Quiz::leftJoin('user_quizzes', 'user_quizzes.quiz_id', 'quizzes.id')
                        ->join('users', 'user_quizzes.user_id', '=', 'users.id')
                        ->where('users.id', Auth::user()->id)
                        ->get();

        return view('quiz_host.dashboard.manage-quizzes')->with('quizzes', $quizzes);
    }

    public function create()
    {
        return view('quiz_host.dashboard.quiz.create');
    }

    public function store()
    {
        $quiz = new Quiz;
    }

    public function showQuestion()
    {
        return view('quiz_user.question');
    }

    public function showPin()
    {
        return view('quiz_user.pin');
    }

    public function leaderboards()
    {
        return view('quiz_user.leaderboard');
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

        try {
            $quiz = Quiz::where('quiz_pin', $request->get('pin'))
                    ->where('active', '1')
                    ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return back()->with('pin_error', 'Either the quiz doesn\'t exist, or it hasn\'t been activated');
        }

        //Add user to the socket.io stuff!
        event(new \App\Events\addUser($request->get('username'))); //Adds the user to the socket stuff
        return redirect()->route('quiz_user.showSplash')->with('quizData', $quiz);
    }
}
