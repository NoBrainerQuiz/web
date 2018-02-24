@extends('quiz_host.auth.layout.auth')

@section('title', 'Enter PIN')

@section('container_content')

<h4 style="margin: 0 auto;">Are you ready for the challenge?</h4></br>
@if ($errors->all())
<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 50%; margin: 0 auto; text-align: left;">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>Ooops, please correct the below errors before logging in:</strong><br />
    @foreach ($errors->all() as $error)
      {{ $error }} <br />
    @endforeach
  </div>
  @endif
  @if (session()->has('logoutMessage'))
      <div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 50%; margin: 0 auto; text-align: left;">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
        {{ session('logoutMessage') }}
      </div>
      @endif
  <form action="{{ route('pin-enter') }}" method="post" style="width: 50%; margin: 0 auto;">
    {{ csrf_field() }}
    <div class="form-group">
    <label style="float: left;">PIN:&nbsp;&nbsp;<a href="#" class="badge badge-danger" data-toggle="tooltip" data-placement="right" title="You get this PIN off the creator of the quiz.">?</a></label><br />
      <input id="email-entry" class="form-control" type="text" name="pin" placeholder="Enter PIN...">
    </div>
    <div class="form-group">
      <label style="float: left;">Username:&nbsp;&nbsp;<a href="#" class="badge badge-danger" data-toggle="tooltip" data-placement="right" title="This will appear as your name in the game.">?</a></label><br />
      <input id="password-entry" class="form-control" type="text" name="username" placeholder="Enter username...">
    </div>
    <div class="form-group">
    <button style="float: right; cursor: pointer;" type="submit" class="btn btn-warning">Enter Quiz &raquo;</button>
</div>
  </form>
@endsection
