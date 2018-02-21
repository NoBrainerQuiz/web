<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/theme.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="icon"
  type="image/png"
  href="{{ asset('img/favicon.png') }}">
  <title>NoBrainer - @yield('title')</title>
</head>

<body>
    <div class="container" id="top-container">
        <img style="max-width:100%; max-height:100%; margin: 0 auto; display: block;" src="{{ asset('img/noBrainer.png') }}" id="noBrainer" alt="logo" onclick="location.href='about.html'"/>
    </div>
    <div class="jumbotron jumbotron-fluid text-center" id="main-page-container">
      <div class="container container-fluid" id=id="main-page-container">
        @yield('container_content')
    </div>
    <div class="contaier container-fluid text-center">
        <p id="version-number">Version 0.0.1-alpha-1</p>
      </div>
    </div>
<!--External Scripts-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!--End External Scripts-->
</body>
</html>