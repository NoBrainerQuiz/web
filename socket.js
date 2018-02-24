/*
  Documentation:
    Start a quiz: http://127.0.0.1:8000/quiz/start/{PIN}
    Finish a quiz: http://127.0.0.1:8000/quiz/finish/{PIN}
    ---
    Skip Question: http://127.0.0.1:8000/quiz/skipQuestion/{PIN}

    Bens To Do List:
      - Add tests for all of these
      - Properly comment the code
      - Make the quiz questions and answers work
      - Skip question
*/

/*
  Required librays that are needed
*/
var Redis = require('ioredis');
var redis = new Redis();
var express  = require('express');
var app      = express();
var socketIO = require('socket.io')
let server = app.listen(3000)
var io = socketIO(server)

/*
  MySQL config
*/
let mysql = require('mysql');
var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: ""
});

let database = require('./app/Sockets/database.js')

let users = []

//Relative arrays containing objects from the database
let quiz = {
  pin: 0,
  state: "Not_Playing", //States: Not_Playing, Lobby, Playing, Ended
  questions : [],
  answers: []
}

redis.subscribe('questions', function(err, count) {
  console.log('Started on port 3000')
});

//Issue with web sockets
redis.on('message', function(channel, message) {
    console.log('Message Recieved: ' + message);
    message = JSON.parse(message);
    quiz.pin = message.data.questionData.pin
    let method = message.data.questionData.method
    //io.emit(channel + ':' + message.event, message.data);

    if (method == "start") {
      quiz.state = "Playing"
      //Get all quiz questions and answers...
      io.emit('redirect', '/question')
    } else if (method == "finish") {
      quiz.state = "Ended"
      io.emit('redirect', '/')
    }

});

/*
  This is for the main functionality of the quizzes
    - Mainly for the user. This also needs some sort of validation. Perhaps using express sessions?
*/
//If username is blank then var sillyName = generateName();
io.on('connection', function(client) {
  console.log(quiz)
  io.on('answer', function(data) {
    //Validate the answer and show right or wrong screen
    console.log(data)
  })
})

io.on('addUser', function(data) {
  let newUser = {
    id: client.id,
    username: "",
    answeredQuestion: false,
    questionsCorrect: 0,
    questionIncorrect: 0,
    timeAnsweredIn: 0,
  }
  console.log(newUser)
  users.push(newUser)
})

io.on('disconnect', function(data) {
  //Remove user from session...
})
