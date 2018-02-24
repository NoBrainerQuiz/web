@extends('quiz_host.auth.layout.auth')

@section('title', 'Login')

@section('container_content')

<h4 style="margin: 0 auto; padding-bottom: 20px;">Sign in to your NoBrainer account...</h4>
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
  <form action="{{ route('login') }}" method="post" style="width: 50%; margin: 0 auto;">
    {{ csrf_field() }}
    <div class="form-group">
    <label style="float: left;">Username/Email:&nbsp;&nbsp;<a href="#" class="badge badge-danger" data-toggle="tooltip" data-placement="right" title="Enter your username or email that you used when signing up for a NoBrainer account.">?</a></label><br />
      <input id="email-entry" class="form-control" type="text" name="email" placeholder="Enter your username/email..." value="{{ old('email') }}">
</div>
    <div class="form-group">
      <label style="float: left;">Password:&nbsp;&nbsp;<a href="#" class="badge badge-danger" data-toggle="tooltip" data-placement="right" title="Enter the password you set when you signed up for a NoBrainer account. If you think you may have forgotten then click the forgot password link to the right.">?</a></label><small><span style="float: right; margin-top: 8px;"><a href="{{ route('password.request') }}">Forgot password?</a></span></small><br />
      <input id="password-entry" class="form-control" type="password" name="password" placeholder="Enter your password...">
    </div>
    <div class="form-group">
    <a href="{{ route('register') }}" style="float: left;">Don't have an account?</a>
    <button style="float: right; cursor: pointer;" type="submit" class="btn btn-warning">Sign me in &raquo;</button>
</div>
  </form>
@endsection
