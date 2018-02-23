@extends('quiz_host.auth.layout.auth')

@section('title', 'Register')

@section('container_content')

<h4 style="margin: 0 auto;">Create your NoBrainer account now...</h4>
@if ($errors->all())
<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 50%; margin: 0 auto; text-align: left;">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>Ooops, please correct the below errors before registering:</strong><br />
    @foreach ($errors->all() as $error)
      {{ $error }} <br />
    @endforeach
  </div>
  @endif
 
  <form action="{{ route('register') }}" method="post" style="width: 50%; margin: 0 auto; padding-bottom: 60px;">
    {{ csrf_field() }}
    <!-- <div class="form-group">
    <label style="float: left;">Username:&nbsp;&nbsp;<a href="#" class="badge badge-danger" data-toggle="tooltip" data-placement="right" title="Choose a unique username to remember and login with on the site.">?</a></label>
      <input id="username-entry" class="form-control" type="text" name="username" placeholder="Choose your username..." value="{{ old('email') }}">
</div>

    <div class="form-group">
    <label style="float: left;">Email:&nbsp;&nbsp;<a href="#" class="badge badge-danger" data-toggle="tooltip" data-placement="right" title="Pick an email to be used to recover your account, login and receive updates.">?</a></label>
      <input id="email-entry" class="form-control" type="email" name="email" placeholder="Enter your email..." value="{{ old('email') }}">
  </div> -->
  <div class="form-group">
  <div class="row">
    <div class="col">
    <label style="float: left;">Username:&nbsp;&nbsp;<a href="#" class="badge badge-danger" data-toggle="tooltip" data-placement="right" title="Choose a unique username to remember and login with on the site.">?</a></label>
      <input type="text" name="username" value="{{ old('username') }}"class="form-control" placeholder="Choose a username...">
    </div>
    <div class="col">
    <label style="float: left;">Email:&nbsp;&nbsp;<a href="#" class="badge badge-danger" data-toggle="tooltip" data-placement="right" title="Pick an email to be used to recover your account, login and receive updates.">?</a></label>
      <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter your email address...">
    </div>
  </div>
</div>

    <div class="form-group">
      <label style="float: left;">Password:&nbsp;&nbsp;<a href="#" class="badge badge-danger" data-toggle="tooltip" data-placement="right" title="Choose a secure password that you will remember. You will be asked to provide this when logging in.">?</a></label>
      <input id="password-entry" class="form-control" type="password" name="password" placeholder="Choose a strong password...(Min 6 characters)">
    </div>
    <div class="form-group">
      <label style="float: left;">Confirm Password:&nbsp;&nbsp;<a href="#" class="badge badge-danger" data-toggle="tooltip" data-placement="right" title="Confirm the password that you just set above. This step is just to ensure you didn't make a mistake.">?</a></label>
      <input id="password-conf-entry" class="form-control" type="password" name="password_confirmation" placeholder="Now go ahead and confirm it...">
    </div>


    <div class="form-group">
    <a href="{{ route('login') }}" style="float: left;">Already own an account? Sign in!</a>
    <button style="float: right; cursor: pointer;" type="submit" class="btn btn-warning">Create my account &raquo;</button>
</div>
  </form>
@endsection

