/*
  This document contains all of the socket information that dynamically updates the users page from the server.
*/

//Connect to our server session and upon an event being fired, show a message.
socket.on("questions:App\\Events\\Sockets", function(data){
    window.location.href = "/question";
    //console.log("Got data: ", data)
});

//Dynamically redirect the user from the server
socket.on('redirect', function(url) {
  window.location.href = url;
})

socket.on('connect', function(data) {
  console.log("Connection Established")
})

socket.on('showQuestion', function(data) {
  updateScreen(data)
})

socket.on('signUserUp', function() {
  $('#assignName').modal({backdrop: 'static', keyboard: false})
  $('#assignName').modal('show');
})

socket.on('resetQuestion', function() {
  startedQuiz = false
})

$('#submit-username').on('click', function(event) {
  let username = document.querySelector('#username').value
  if (username != "") {
    $('#submit-username').prop('disabled', true);
    socket.emit('addUser', {name: username, id: id})
    $('#assignName').modal('hide');
  }
})

/*
  Temp for testing
  On click it needs to emit to the server, all answers need to have a clickevent.
  Correct answer done server side, better for security.
*/

let startedQuiz = false // THIS NEEDS UPDATING WHEN THERE IS A NEW QUESTION
function updateScreen(data) {
  console.log("UPDATED", startedQuiz, data)
  if (startedQuiz == false) {
    try {
      clearInterval(counter);
    } catch(e) {
      console.log("Error handling")
    }

    $('#timeUpModal').modal('hide');
    let elements = ['question-no', 'timer', 'question', 'ans1', 'ans2', 'ans3', 'ans4']
    for(let i = 0; i < elements.length; i++) {
      document.querySelector('#'+elements[i]).textContent = data[elements[i]]
    }

    let serverTime = new Date(data['timer'])
    var t = new Date();
    console.log("Now: ", t.setSeconds(t.getSeconds()));
    console.log("Finish: ", serverTime.getTime())
    let timeLeft = (serverTime.getTime() - t.setSeconds(t.getSeconds()))/1000
    timeFromStart = timeLeft
    console.log("left", timeLeft)
    counter=setInterval(timer, 1000); //Starts a timer
    startedQuiz = true
  }
}

function timer() {
  timeFromStart=timeFromStart-1;
  if (timeFromStart <= 0) { //If timer has ended. Close everyone clients screens.
     clearInterval(counter);
     //window.location = "/answer"; //needs to redirect using JS.
     document.getElementById("timer").innerHTML= "&#x23F0; Time Up!" //Incase there is ever a bug, this will show the user not an error but a friendly "Time Up"
     $('#timeUpModal').modal({backdrop: 'static', keyboard: false})
     $('#timeUpModal').modal('show');
  } else {
    document.getElementById("timer").innerHTML=timeFromStart.toFixed(0);
  }

}
