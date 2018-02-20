@extends('quiz_host.auth.layout.auth')

@section('title', 'Register')

@section('container_content')

@if ($errors->all())
  <div class="loginError">
    @foreach ($errors->all() as $error)
      {{ $error }} <br />
    @endforeach
  </div>
@endif

  <form id="login" action="{{ route('register') }}" method="post">
    {{ csrf_field() }}
    <input type="text" name="username" placeholder="Username" value="{{ old('username') }}"><br>
    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"><br>
    <input type="password" name="password" placeholder="Password..."><br>
    <input type="password" name="password_confirmation" placeholder="Confirm password..."><br>
    <input id="signUp" type="submit" name="submit" value="Register account">
  </form>
  @endsection
