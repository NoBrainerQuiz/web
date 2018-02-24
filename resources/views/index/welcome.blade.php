@extends('quiz_host.auth.layout.auth')

@section('title', 'Welcome')

@section('container_content')

<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
<style>


h1 {
  font-size: 1.75rem;
  margin: 0 0 0.75rem 0;
}


.left-half {
  background-color: #fff;
  padding: 2rem;
  float: left;
  width: 49%;
  color: black;
  cursor: pointer;
  text-align: center;
  transition: all .2s ease-in-out;
}

.left-half:hover {
  transform: scale(1.1);
}

.right-half {
  background-color: #fff;
  padding: 2rem;
  float: right;
  width: 49%;
  color: black;
  cursor: pointer;
  text-align: center;
  transition: all .2s ease-in-out;
}

.right-half:hover {
  transform: scale(1.1);
}

</style>
<!-- <h4 style="margin: 0 auto;">Welcome to NoBrainer!</h4>
<strong>Select your option below... -->
<!-- </strong> -->
<a href="{{ route('login') }}">
<div class="left-half">
  <article>
  <h1><i class="fas fa-plus"></i></h1>
  <h1>CREATE QUIZ</h1>
  <p>Want to create a quiz of your own? For students, friends or colleagues? This option is for you!</p>
</article>
</div>
</a>
<a href="{{ route('pin-enter') }}">
<div class="right-half">
  <article>
    <h1><i class="fas fa-pencil-alt"></i></h1>
  <h1>TAKE QUIZ</h1>
  <p>Have a quiz PIN handy? Then test yourself now by taking part in a vast database of quizzes!</p>
</article>
</div>
</a>
@endsection
