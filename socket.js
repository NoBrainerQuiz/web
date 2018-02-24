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

redis.subscribe('questions', function(err, count) {
  console.log('Started on port 3000')
});

//Issue with web sockets
redis.on('message', function(channel, message) {
    console.log('Message Recieved: ' + message);
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
    io.emit()
});

let users = []

//Relative arrays containing objects from the database
let questions;
let answers;

/*
  This is for the host of the quiz
    - This needs some validation to ensure its the quiz host that is actually submitting the sockets requests
*/
io.on('startQuiz', function(data) {
  //On start it will update the screens for users
})

io.on('endQuiz', function(data) {
  //Terminate the quiz
})

io.on('skipQuestions', function(data) {
  //Terminate the quiz
})

/*
  This is for the main functionality of the quizzes
    - Mainly for the user. This also needs some sort of validation. Perhaps using express sessions?
*/
//If username is blank then var sillyName = generateName();
io.on('connection', function(client) {
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
  io.on('answer', function(data) {
    //Validate the answer and show right or wrong screen
    console.log(data)
  })
})

io.on('quizPin', function(data) {
    //Validate PIN for user
    //If yes, then go them redirect them, else show error message
    //Add user to users file.
})

io.on('disconnect', function(data) {
  //Remove user from session...
})
