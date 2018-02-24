@extends('quiz_host.auth.layout.auth')

@section('title', 'Ey-oh!')

@section('container_content')
<!--
  If no quiz data, then redirect the user elsewhere.. Worry about authentication later.
-->
<h4 style="margin: 0 auto;">Please wait for the host to start the quiz..</h4></br>

@if ($errors->all())
<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 50%; margin: 0 auto; text-align: left;">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>Ooops, please correct the below errors before continuing:</strong><br />
    @foreach ($errors->all() as $error)
      {{ $error }} <br />
    @endforeach
  </div>
  @endif

@if (session()->has('pin_error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 50%; margin: 0 auto; text-align: left;">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>Ooops, please correct the below errors before continuing:</strong><br />
    {{ session('pin_error') }}
  </div>
  @endif
  @if (session()->has('quizData'))
      <div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 50%; margin: 0 auto; text-align: left;">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
        {{ session('quizData') }}
      </div>
      @endif
  <p>Names will be displayed here...</p>
@endsection
