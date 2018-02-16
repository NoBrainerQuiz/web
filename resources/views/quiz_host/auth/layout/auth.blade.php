<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/theme.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="icon"
  type="image/png"
  href="{{ asset('img/favicon.png') }}">
  <title>NoBrainer - @yield('title')</title>
</head>

<body>
    <div id="top-container">
        <img src="{{ asset('img/noBrainer.png') }}" id="noBrainer" alt="logo" onclick="location.href='about.html'"/>
    </div>
    <div id="container">
        @yield('container_content')
    </div>
</body>
</html>