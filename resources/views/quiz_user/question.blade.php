<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/index.css"> <!-- Remember to reduce CSS files-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>NoBrainer</title>
    <link rel="icon"
      type="image/png"
      href="assets/favicon.png">
    </head>
    <body>
      <div id="question-no">
        Loading...
      </div>
      <div id="timer">
        Loading...
      </div>
      <div id="question">
        Loading...
      </div>
      <div id="ans-container">
        <div class="ans-box" id="ans-1">
          <div class="center-container">
            Loading...
          </div>
        </div>
        <div class="ans-box" id="ans-2">
          <div class="center-container">
            Loading...
          </div>
        </div>
        <div class="ans-box" id="ans-3">
          <div class="center-container">
            Loading...
          </div>
        </div>
        <div class="ans-box" id="ans-4">
          <div class="center-container">
            Loading...
          </div>
        </div>
      </div>
      <p id="version-number">Version 0.0.0.1Beta0.1</p>
      <!-- Please do not remove this -->
      <script src="//{{ Request::getHost() }}:3000/socket.io/socket.io.js"></script>
      <script>var socket = io('//{{ Request::getHost() }}:3000');</script>
      <script src="js/sockets.js"></script>
  </body>
</html>
