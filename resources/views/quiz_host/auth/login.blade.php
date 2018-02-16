@extends('quiz_host.auth.layout.auth')

@section('title', 'Login')

@section('container_content')

@if ($errors->all())
  <div class="loginError">
    @foreach ($errors->all() as $error)
      {{ $error }} <br />
    @endforeach
  </div>
@endif
  <form id="login" action="{{ route('login') }}" method="post">
    {{ csrf_field() }}
    <input type="text" name="email" placeholder="Email" value="{{ old('email') }}"><br>
    <input type="password" name="password" placeholder="Password..."><br>
    <input id="signUp" type="submit" name="submit" value="Login">
  </form>
@endsection
