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
  updateScreen(data['questionData'])
})

/*
  Temp for testing
  On click it needs to emit to the server, all answers need to have a clickevent.
  Correct answer done server side, better for security.

  When an event is fired this updates dynamically. To try it go to http://127.0.0.1:8000/fire when running the web sockets.
*/
let timeFromStart;
function updateScreen(data) {
  let elements = ['question-no', 'timer', 'question', 'ans-1', 'ans-2', 'ans-3', 'ans-4']
  for(let i = 0; i < elements.length; i++) {
    document.querySelector('#'+elements[i]).textContent = data[elements[i]]
  }
  timeFromStart = data['timer']
  counter=setInterval(timer, 1000); //Starts a timer
}

function timer() {
  timeFromStart=timeFromStart-1;
  if (timeFromStart <= 0) { //If timer has ended. Close everyone clients screens.
     clearInterval(counter);
     window.location = "/answer"; //needs to redirect using JS.
  }

 document.getElementById("timer").innerHTML=timeFromStart; // watch for spelling
}
