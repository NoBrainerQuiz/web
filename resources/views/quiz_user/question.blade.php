@section('title', 'Ey-oh!')

<!doctype html>
<html lang="en">
  <head>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="css/index.css"> <!-- Remember to reduce CSS files-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
      #assignName > * {
        color: black;
      }
    </style>
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
        <button class="ans-box" id="ans1">
          <h1>Loading answer 1...</h1>
          <div class="center-container">
            sdf
          </div>
        </button>
        <button class="ans-box" id="ans2">
          <div class="center-container">
            Loading answer 2...
          </div>
        </button>
        <button class="ans-box" id="ans3">
          <div class="center-container">
            Loading answer 3...
          </div>
        </button>
        <button class="ans-box" id="ans4">
          <div class="center-container">
            Loading answer 4...
          </div>
        </button>
      </div>
      <p id="version-number">Version 0.0.0.1Beta0.1</p>

      <!-- Model for username -->
      <div class="modal fade" id="assignName">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Please enter a username to enter the quiz..</h5>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label style="float: left;">Username:&nbsp;&nbsp;<a href="#" class="badge badge-danger" data-toggle="tooltip" data-placement="right" title="This will appear as your name in the game.">?</a></label><br />
                <input id="username" class="form-control" type="text" name="username" placeholder="Enter username...">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary"id="submit-username">Submit Username</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Model for time up -->
      <div class="modal fade" id="timeUpModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">&#x23F0; Time up!</h5>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label style="float: left;">The timer has been complete!</label>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Model for answering question -->
      <div class="modal fade" id="answerUpModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="answerTitle">&#x1F60A; Question Answered!</h5>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label style="float: left;" id="answerBody">Your quesiton has been answered. Please wait for the timer to end for the next question.</label>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- This gets the socket.io scripts -->
      <script src="//{{ Request::getHost() }}:3000/socket.io/socket.io.js"></script>
      <script>var socket = io('//{{ Request::getHost() }}:3000');</script>
      <script src="js/sockets.js"></script>
      <script src="js/functions.js"></script>
      <script>
        let valid = false;
        let username; //stores the clients username
        let allUserInfo; //stores all of the other users information
        let id = getCookie("randomVal"); //This gets the users cookie value which is used to validate the user on the server side.

        //As soon as the user loads the page, it sends a request to the server to validate the user
        socket.on('connect', function(data) {
          socket.emit('validateUser', {id: id})
        })

        //When the server sends the client the user info, it updates 2 global variables
        socket.on('userInfo', function(data) {
          console.log(data)
          username = data.username
          allUserInfo = data.allUsers
        })

        //When the server sends the question results to the user (once the timer has ended), it displays to the user if they got it correct or incorrect.
        socket.on('showResults', function(info) {
          let data = info['users']
          let correct = info['correct']
          for (let i = 0; i < data.length; i++) {
            if (data[i].id == id) {
              let text = ""
              if (data[i].lastQuestionCorrect == true) {
                document.querySelector('#answerTitle').innerHTML = "&#x1F601; Correct"
                text = "You got the question correct!"
              } else {
                document.querySelector('#answerTitle').innerHTML = "&#x1F622; Incorrect"
                text = "You got the question incorrect! Better luck next time. Correct answer was " + correct
              }
              text += "</br></br> You currently have <b>" + data[i].questionsCorrect + "</b> questions correct."

              document.querySelector('#answerBody').innerHTML = text
            }
          }
        })

        socket.on('displayScoreBoard', function(data) {
          console.log("GAME OVER", data)
        })

        //This resets the modal as it is all updated dynamicly.
        function resetAnswerModal() {
          document.querySelector('#answerTitle').innerHTML = "&#x1F60A; Question Answered!"
          document.querySelector('#answerBody').innerHTML = "Your quesiton has been answered. Please wait for the timer to end for the next question."
        }

        //This disables all of the question buttons
        function disableAllButtons() {
          $('#ans1').prop('disabled', true);
          $('#ans2').prop('disabled', true);
          $('#ans3').prop('disabled', true);
          $('#ans4').prop('disabled', true);
        }

        //This re-enables all of the question buttons
        function enableAllButtons() {
          $('#ans1').prop('disabled', false);
          $('#ans2').prop('disabled', false);
          $('#ans3').prop('disabled', false);
          $('#ans4').prop('disabled', false);
        }

        //Upon the user clicking the first answer button, it sends it to the server and stops the user answering another question.
        $('#ans1').on('click', function(event) {
          event.preventDefault();
          socket.emit('answer', {
            answer: document.querySelector('#ans1').textContent,
            id: id
          });
          answered()
        });

        //Upon the user clicking the second answer button, it sends it to the server and stops the user answering another question.
        $('#ans2').on('click', function(event) {
          event.preventDefault();
          socket.emit('answer', {
            answer: document.querySelector('#ans2').textContent,
            id: id
          });
          answered()
        });

        //Upon the user clicking the third answer button, it sends it to the server and stops the user answering another question.
        $('#ans3').on('click', function(event) {
          event.preventDefault();
          socket.emit('answer', {
            answer: document.querySelector('#ans3').textContent,
            id: id
          });
          answered()
        });

        //Upon the user clicking the fourth answer button, it sends it to the server and stops the user answering another question.
        $('#ans4').on('click', function(event) {
          event.preventDefault();
          socket.emit('answer', {
            answer: document.querySelector('#ans4').textContent,
            id: id
          });
          answered()
        });

        //This forces a modal popup on the user (which they cannot close), so they can't answer another question.
        function answered() {
          $('#answerUpModal').modal({backdrop: 'static', keyboard: false})
          $('#answerUpModal').modal('show');
          disableAllButtons()
        }

        //TRhis removes the answer modal and is called when the client has another question displayed to them
        function removeModal() {
          $('#answerUpModal').modal('hide');
        }

      </script>
      <!-- Thisis the standard bootstrap, jquery and popper javascript files -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <script>
         //This is a bootstrap function to make the tooltip work
         $(function () {
            $('[data-toggle="tooltip"]').tooltip()
          })
      </script>
  </body>
</html>
