
@extends('quiz_host.dashboard.layout.app')

@section('title', 'Your Dashboard')

@section('container_content')

@section('breadcrumb', 'Dashboard Index')


<h2>
    Your Dashboard
  </h2>
  <p>
   Welcome to your dashboard <strong>{{ Auth::user()->username }}</strong>! From here you can manage all your
   quizzes and questions, as well as your own account settings and profile options.
  </p>
  <p>
    So far you've managed to create <strong>{{ $quizCount }}</strong> {{ ($quizCount < 2) ? 'quiz' : 'quizzes' }}! 
    @if ($quizCount == 0)
        Get started by creating your <a href="">first quiz</a>.
    @else
    Why not <a href="">create another</a>?
    @endif  
  </p>
  <div class="callout callout-info">
    <h5>Need some assistance?</h5>
    <p>You can view our NoBrainer documentation <a href="#">here</a>.</p>
  </div>


@endsection