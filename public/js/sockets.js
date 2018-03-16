/*
  Author: UP805717 (springjben)

  This document contains all of the socket information that dynamically updates the users page from the server.
*/

//Connect to our server session and upon an event being fired, show a message.
socket.on("questions:App\\Events\\Sockets", function(data){
    window.location.href = "/question";
});

//Dynamically redirect the user from the server
socket.on('redirect', function(url) {
  window.location.href = url;
})

//When the server passes the new question, the browser updates all of the question information dynamically
socket.on('showQuestion', function(data) {
  updateScreen(data)
})

//If the user has not been valided, the server will send a request to this, and it will force a modal to popup (for the user to enter a username).
socket.on('signUserUp', function() {
  $('#assignName').modal({backdrop: 'static', keyboard: false})
  $('#assignName').modal('show');
})

//This resets all the question information, so other questions are independent from eachother
socket.on('resetQuestion', function() {
  startedQuiz = false
  removeModal()
  enableAllButtons()
  resetAnswerModal()
  $('#answersTestButton').prop('disabled', false); //if its false its correct. If its disabled its incorrect.
})

//When a user submits their username, it makes sure the username is not blank. If its a valid username, the client and server will both validate each other.
$('#submit-username').on('click', function(event) {
  let username = document.querySelector('#username').value
  if (username != "") {
    $('#submit-username').prop('disabled', true);
    socket.emit('addUser', {name: username, id: id})
    $('#assignName').modal('hide');
  }
})

let startedQuiz = false //boolean that determines if the user has started the quiz.

//This method updates the screen with quiz data. Such as updating the timer, updating the quiz question and answers.
function updateScreen(data) {

  //If they have started a quiz already, don't update the quiz yet.
  if (startedQuiz == false) {
    try {
      clearInterval(counter);
    } catch(e) {
      console.log("Error handling")
    }

    $('#timeUpModal').modal('hide'); //Hides the time modal.

    //Loops through each element and sets the content to the data that the server has passed to it.
    let elements = ['question-no', 'timer', 'question', 'ans1', 'ans2', 'ans3', 'ans4']
    for(let i = 0; i < elements.length; i++) {
      document.querySelector('#'+elements[i]).textContent = data[elements[i]]
    }

    //Stops cheating and creates a timer from when the server started the question.
    let serverTime = new Date(data['timer'])
    var t = new Date();

    let timeLeft = (serverTime.getTime() - t.setSeconds(t.getSeconds()))/1000
    timeFromStart = timeLeft

    //This starts the time to update the timer text every second.
    counter=setInterval(timer, 1000);
    startedQuiz = true
  }
}

//This method is called every second and updates the timer with how many seconds are left to answer the quiz question.
function timer() {
  timeFromStart=timeFromStart-1;
  if (timeFromStart <= 0) { //If timer has ended. Close everyone clients screens.
     clearInterval(counter);

     document.getElementById("timer").innerHTML= "&#x23F0; Time Up!" //Incase there is ever a bug, this will show the user not an error but a friendly "Time Up"
     socket.emit('getResults',{});
     $('#timeUpModal').modal({backdrop: 'static', keyboard: false})
     $('#timeUpModal').modal('show');
  } else {
    document.getElementById("timer").innerHTML=timeFromStart.toFixed(0);
  }

}
