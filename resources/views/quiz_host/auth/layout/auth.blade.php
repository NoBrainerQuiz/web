<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/theme.css') }}"> -->
  <link rel="stylesheet" href="{{ asset('css/admin4b.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/colours.css') }}">
  <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}"> -->
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="icon"
  type="image/png"
  href="{{ asset('img/favicon.png') }}">
  <title>NoBrainer - @yield('title')</title>
</head>

<body>
    <!-- <div class="container" id="top-container">
        <img style="max-width:100%; max-height:100%; margin: 0 auto; display: block;" src="{{ asset('img/noBrainer.png') }}" id="noBrainer" alt="logo" onclick="location.href='/'"/>
    </div> -->
    <!-- <div id="logo">
<img style="max-width:20%; max-height:20%; margin: 0 auto; display: block;" src="{{ asset('img/noBrainer.png') }}" id="noBrainer" alt="logo" onclick="location.href='/'"/>
</div> -->
    <!-- <div class="jumbotron text-center page-wrap" id="main-page-container">
        <div class="container"> -->
            <!--USED TO BE container-fluid, removed for now - Matt -->
        <div class="container pt-2 h-100 d-flex">
        @yield('container_content')
        </div>
<!-- </div>
    </div> -->
    <!-- <footer class="site-footer">
    Version 0.1.0-Alpha-1
</footer> -->

<!--<script src="//{{ Request::getHost() }}:3000/socket.io/socket.io.js"></script>
<script>var socket = io('//{{ Request::getHost() }}:3000');</script>
<script src="js/sockets.js"></script>-->

<!--External Scripts-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{ asset('js/admin4b.js') }}"></script>
    <script src="{{ asset('js/admin4b.docs.js') }}"></script>
    <!--End External Scripts-->
    <script>
       $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
</body>

</html>
