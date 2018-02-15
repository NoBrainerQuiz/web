/*
  This document contains all of the socket information that dynamically updates the users page from the server.
*/

//Connect to our server session and upon an event being fired, show a message.
var socket = io('http://127.0.0.1:3000');
socket.on("questions:App\\Events\\Sockets", function(message){
    // increase the power everytime we load test route
    //$('#power').text(parseInt($('#power').text()) + parseInt(message.data.power));
    console.log(message.data.power)
});

socket.on('connect', function(data) {
  console.log("Connection Established")
})
