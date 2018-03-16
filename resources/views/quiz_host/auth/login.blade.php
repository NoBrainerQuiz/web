@extends('quiz_host.auth.layout.auth')

@section('title', 'Login')

@section('container_content')


<!-- <div class="container-fluid pt-2 h-100 d-flex"> -->

      <div class="page-sign h-100 w-100">

        <form action="{{ route('login') }}" method="post" class="form-signin" style="max-height: 100% !important;">
        {{ csrf_field() }}
        <a id="homeImage" href="{{ route('welcome') }}">
          <h1 class="display-4 text-center mb-5">
          <img style="max-width:50%; max-height:50%;" src="{{ asset('img/noBrainerWhite.png') }}" id="noBrainer" alt="logo" />
          </h1>
        </a>

          @if ($errors->all())
<div class="alert alert-danger alert-dismissible fade show" id="loginError" role="alert" style="">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
    @foreach ($errors->all() as $error)
     <strong>{{ $error }}</strong> <br />
    @endforeach
  </div>
  @endif

  @if (session()->has('logoutMessage'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
        {{ session('logoutMessage') }}
      </div>
      @endif

          <div class="form-group">
            <div class="label-floating">
              <input id="username" type="text" name="email" class="form-control" placeholder="Username/Email" maxlength="50">
              <label for="username">Username/Email</label>
            </div>
          </div>
          <div class="form-group">
            <div class="label-floating">
              <input id="password" type="password" name="password" class="form-control" placeholder="Password" maxlength="20">
              <label for="password">Password</label>
            </div>
          </div>
          <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block btnColour" />Sign in <i class="fas fa-arrow-right"></i></button>
          <!-- <a href="../../index.html" class="btn btn-lg btn-primary btn-block btnColour">
          Sign in <i class="fas fa-arrow-right"></i>
          </a> -->
          <div class="mt-3 mb-3 text-center">
            <p class="mb-4">
              <a href="{{ route('password.request') }}">I forgot my password</a>
            </p>
            <hr>
            <p class="mt-4">
              <label class="text-muted">Don't have an account?</label>
              <a id="signUp" href="{{ route('register') }}">Sign up</a>
            </p>
        </div>
        </form>
      </div>
<!-- </div> -->

<!-- <h4 style="margin: 0 auto; padding-bottom: 20px;">Sign in to your NoBrainer account...</h4>
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
  </form> -->
@endsection
