<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!--<script src="js/index.js"></script>-->
    <title>NoBrainer</title>
    <link rel="icon"
      type="image/png"
      href="assets/favicon.png">
    </head>
    <body>
      <div id="question-number">
        ##
      </div>
      <div id="timer">
        ##
      </div>
      <div id="question">
        Loading...
      </div>
      <div id="ans-container">
        <div class="ans-box" id="ans-1">
          <div class="center-container">
            ANS 1
          </div>
        </div>
        <div class="ans-box" id="ans-2">
          <div class="center-container">
            ANS 2
          </div>
        </div>
        <div class="ans-box" id="ans-3">
          <div class="center-container">
            ANS 3
          </div>
        </div>
        <div class="ans-box" id="ans-4">
          <div class="center-container">
            ANS 4
          </div>
        </div>
      </div>
      <p id="version-number">Version 0.0.0.1Beta0.1</p>
      <!-- Please do not remove this -->
      <script src="http://127.0.0.1:3000/socket.io/socket.io.js"></script>
      <script>
          var socket = io('http://127.0.0.1:3000');
          socket.on("test-channel:App\\Events\\Sockets", function(message){
              // increase the power everytime we load test route
              //$('#power').text(parseInt($('#power').text()) + parseInt(message.data.power));
              console.log(message.data.power)
          });
      </script>
  </body>
</html>
