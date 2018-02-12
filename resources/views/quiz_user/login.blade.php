<!doctype html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/theme.css">
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="icon"
  type="image/png"
  href="assets/favicon.png">
  <title>Login</title>
</head>
<body>
  <div id="top-container">
    <img src="noBrainer.png" id="noBrainer" alt="logo" onclick="location.href='about.html'"/>
  </div>
  <div id='container'>
    <!--
          - This is just a very very simple way to do a form. I have changed your CSS to match the same style to make it easier for you
          - We do not need that many CSS files btw, maybe something we can discuss in our next meeting?
          - If we all communicate with each other properly, it will make it very easy!
          - Also as me and Matt have suggested using Bootstrap might be easier for you, but its up to you.
    -->
    <form id="login" action="/signup.php" method="post">
      <input type="text" name="username" placeholder="Username..."><br>
      <input type="password" name="password" placeholder="Password..."><br>
      <input id="signUp" type="submit" value="Don't have an account? Sign up here!">
    </form>

  </div>
</body>
</html>
