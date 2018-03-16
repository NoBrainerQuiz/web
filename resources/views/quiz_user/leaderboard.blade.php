<!doctype html>
  <head>
    <title>NoBrainer</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/theme.css">
    <link rel="stylesheet" type="text/css" href="css/leaderboard.css">
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon"/>
    <style>

    </style>
  </head>
  <body>
    <div class="container" id="top-container">
      <h1 class="display-4 text-center mb-5"></br>
        <a id="homeImage" href="/"><img style="max-width:20%; max-height:20%;" src="{{ asset('img/noBrainerWhite.png') }}" id="noBrainer" alt="logo" /></a>
      </h1>
    </div>
    <div class="container container-fluid text-center" id="main-page-container">
      <div class="container container-fluid" id="main-content">
        <p id="placement-text">You came in <span id="place">nth</span> place!</p>
        <p id="leaderboard-title">LEADERBOARD</p>
        <div class="container" id="leaderboard-container">
          <div class="container text-center name-text" id="first-container">1st - <span id="name1">[NAME]</span></div>
          <p class="score-text" id="first-score">-1pts</p>
          <div class="container text-center name-text" id="second-container" style="display:none">2nd - <span id="name2">[NAME]</span></div>
          <p class="score-text name-text" id="second-score" style="display:none">-1pts</p>
          <div class="container text-center" id="third-container" style="display:none">3rd - <span id="name3">[NAME]</span></div>
          <p class="score-text" id="third-score" style="display:none">-1pts</p>
        </div>
      </div>
        <footer id="version-number">Version 0.0.1-Alpha-1</footer> <!-- Versioning needs updating -->
    </div>
    <!--External Scripts-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- This gets the socket.io scripts -->
    <script src="//{{ Request::getHost() }}:3000/socket.io/socket.io.js"></script>
    <script>var socket = io('//{{ Request::getHost() }}:3000');</script>
    <script src="js/functions.js"></script>
    <script>
      let scoreboard = [] //This stores all of the
      socket.emit('getLeaderboards', {}); //This requests the node server for the leaderboard scores

      //When the server sends the leaderboard/score data
      socket.on('displayLeaderBoards', function(data2) {
        let data = data2['users'].reverse()

        //This loops through all of the data and sorts the data into an appropiate object
        for (let i = 0; i < data.length; i++) {
          console.log(data[i])
          let user = {
            id: data[i].id,
            score: parseFloat(data[i].questionsCorrect * 10) - parseFloat(data[i].questionsIncorrect * 5), //10 points per question correct, minus 5 points per question incorrect.
            name: data[i].username
          }
          scoreboard.push(user)
        }

        //This sorts the users by their score. Highest will be at the top.
        scoreboard.sort(function(a, b){return b.score - a.score});
        //Get user position
        for (user in scoreboard) {
          if (scoreboard[user].id == getCookie('randomVal')) {
            let place = parseFloat(user) + 1
            document.querySelector('#place').textContent = getSuffix(place)
          }
        }

        //This displays the top 3 players (or smaller if there are less players)
        //This makes the efficiency of the loop better.
        let scoreLoop = 2
        if (scoreLoop < scoreboard.length-1) {
          scoreLoop = scoreboard.length-1
        }
        for (let i = 0; i < scoreLoop; i++) {
          if (i == 0) {
            document.querySelector('#name1').textContent = scoreboard[i].name
            document.querySelector('#first-score').textContent = scoreboard[i].score
          } else if(i == 1) {
            document.querySelector('#name2').textContent = scoreboard[i].name
            document.querySelector('#second-score').textContent = scoreboard[i].score
            document.querySelector('#second-score').style.display = "block"
            document.querySelector('#second-container').style.display = "block"
          } else if (i == 2) {
            document.querySelector('#name3').textContent = scoreboard[i].name
            document.querySelector('#third-score').textContent =  scoreboard[i].score
            document.querySelector('#second-score').style.display = "block"
            document.querySelector('#third-container').style.display = "block"
          }
        }

      })

      //Function to get the suffix's for the scores. Credits go to the Javascript for Dummies book.
      function getSuffix(d) {
          var z = d % 10,
              l = d % 100;
          if (z == 1 && l != 11) {
              return d + "st";
          }
          if (z == 2 && l != 12) {
              return d + "nd";
          }
          if (z == 3 && l != 13) {
              return d + "rd";
          }
          return d + "th";
      }
    </script>
  </body>
</html>
