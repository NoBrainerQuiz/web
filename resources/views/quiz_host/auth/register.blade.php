<!doctype html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/theme.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="icon"
  type="image/png"
  href="{{ asset('img/favicon.png') }}">
  <title>Login</title>
</head>
<body>
  <div id="top-container">
    <img src="{{ asset('img/noBrainer.png') }}" id="noBrainer" alt="logo" onclick="location.href='about.html'"/>
  </div>
  <div id='container'>
  <form id="login" action="/signup.php" method="post">
      <input type="text" name="username" placeholder="Username..."><br>
      <input type="text" name="email" placeholder="Email..."><br>
      <input type="password" name="password" placeholder="Password..."><br>
      <input id="signUp" type="submit" value="Register account">
    </form>
  </div>
</body>
</html>
