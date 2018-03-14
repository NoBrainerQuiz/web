@extends('quiz_host.dashboard.layout.app')

@section('title', 'Your Dashboard')

@section('container_content')

@section('breadcrumb', 'Create quiz')


<h2>
    Create a new quiz
  </h2>
  <p>
   Fill out the form below to start the process of creating your own quiz!
  </p>
  
  <p>
  @if ($errors->any())
  <div class="alert alert-danger">
      @foreach ($errors->all() as $error)
          {{ $error }}<br />
      @endforeach
    </div>
  @endif
  <form method="post" action="{{ route('quiz_host.dashboard.quiz.store') }}">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="exampleInputEmail1">Quiz Name</label>
    <input type="text" maxlength="30" class="form-control" name="quiz_name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Quiz name...">
    <small id="emailHelp" class="form-text text-muted">Choose a descriptive yet simple name for your quiz (Max 30 chars)</small>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Quiz Description</label>
    <textarea class="form-control" maxlength="500" name="quiz_description" id="exampleFormControlTextarea1" placeholder="And write a nice description..." rows="3"></textarea>
    <small id="emailHelp" class="form-text text-muted">Enter a description for the quiz so people know what it's about</small>
  </div>
  <button type="submit" class="btn btn-success">Create Quiz <i class="fas fa-plus"></i></button>
  </form>
  </p>

  <div class="callout callout-info">
    <h5>Need some assistance?</h5>
    <p>You can view our NoBrainer documentation <a href="#">here</a>.</p>
  </div>


@endsection