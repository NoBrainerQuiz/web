/*

  Author: UP805717 (springjben)

  Documentation:
    Start a quiz: http://127.0.0.1:8000/quiz/start/{PIN}
    Finish a quiz: http://127.0.0.1:8000/quiz/finish/{PIN}

  Version Control:
    ....

*/


/*
  Required librays that are needed
*/
//Used for passing data from Laravel framework to a node server
var Redis = require('ioredis');
var redis = new Redis();

//Used to create a basic HTTP server in node
var express  = require('express');
var app      = express();

//Used to dynamically communicate with the users in the quiz (using web sockets)
var socketIO = require('socket.io')
let server = app.listen(3000)
var io = socketIO(server)

//Getting a file I wrote with methods to communicate with the MySQL database
let database = require('./app/Sockets/database.js')
database.init()

/*
  Global server variables
*/
let users = []
let quizData = {}
let index = 0

const secondsPerQuestion = 12 //How many seconds to show per quiz
const serverOffset = 6 //This means after the quiz has ended

//Relative arrays containing objects from the database
let quiz = {
  pin: 0,
  state: "Not_Playing", //States: Not_Playing, Lobby, Playing, Ended
  questions : [],
  answers: []
}

/*
  Main server method and functionality
*/

//This gets redis to subscrive to the "questions" channel. A PHP event gets fired off and communicates to node through this channel.
redis.subscribe('questions', function(err, count) {
  console.log('Listening for questions')
});

let loop; //A global variable for the main game loop
let resetGame = false //This variable is used to reset the client side info

//If an event is fired (from the questions redis channel) and is apart of the message room, it will output the messages sent here.
redis.on('message', async function(channel, message) {
  message = JSON.parse(message);

  //Determines if the quiz host starts of stops the game
  quiz.pin = message.data.questionData.pin
  let method = message.data.questionData.method
  if (method == "start") {
    quiz.state = "Playing"
    //If the quiz host has started the game, get all quiz questions and answers and redirect all the users.
    database.getQuizData(quiz.pin).then(result => {
      reset() //Reset all the relevant information
      quizData = result
      io.emit('showQuestion', quizData[index]['data']) //Using sockets to dynamically communcate with the users.
      loop=setInterval(passQuestion, ((secondsPerQuestion+serverOffset) * 1000)); //This loops every configured second
    })

    io.emit('redirect', '/question') //Once the quiz host starts the game, it redirects everyone from the 'splash' page to the 'question' page
  } else if (method == "finish") {
    //If the quiz host wants to finish the game it updates the quiz information and redirects all its users to the homepage.
    quiz.state = "Ended"
    quiz.questions = []
    quiz.answers = []
    users = [] //Removing all users from lobby
    io.emit('redirect', '/')
  }

});

/*
  This is for the main functionality of the quizzes using web sockets.
  If the user connects to the server (happens automatically once visiting the /splash or /questions page), validates the user.
*/
io.on('connection', function(client) {

  //Upon joining they will be shown the latest question
  if (quizData.length > 0 || quiz.state == "Playing") {
    runQuestion(users)
  }

  //If the users browser (using sockets) makes a call to the server, it will reply with the leaderboard results.
  client.on('getLeaderboards', function(data) {
    client.emit('displayLeaderBoards', {users: users})
  })

  //If the users browser requests the results for the current question, it will reply with the results for the question
  client.on('getResults', function(data) {
    client.emit('showResults', {users: users, correct: currentCorrect})
  })

  //When a user answers a question within the quiz, it gets logged server side.
  client.on('answer', function(data) {
    userAnswer(data.answer, data.id)
  })

  //If a new user joins the quiz (client-side), it will add their details to a global users array.
  client.on('addUser', async function(data) {
    let newUser = {
      id: data.id,
      username: data.name, //User different usernames. This needs some validation
      answeredQuestion: false,
      questionsCorrect: 0,
      questionsIncorrect: 0,
      timeAnsweredIn: 0,
      lastQuestionCorrect: false
    }
    users.push(newUser)
    let info = await getUserInfo(users, data.id) //This gets the users relevent information.
    client.emit('userInfo', {allUsers: info.allUsernames, username: info.yourUsername}) //Once the user has been added, the server gives the relevent information back to the user
    })

    /*
      This is some validation to ensure the user has been added to the server users array.
      If they have not been added, it will force the user to pick a username (otherwise they can't play the quiz).
      The client gets a cookie created to make sure that our product remembers them. Its the way I am validating the user every time.
    */
    client.on('validateUser', async function(data) {
      let info = await getUserInfo(users, data.id) //Has the user already played before and is in the users array?
      if (info.validUser == false) {
        client.emit('signUserUp', {}) //If they have no entered their information, force them to
      } else {
        client.emit('userInfo', {allUsers: info.allUsernames, username: info.yourUsername}) //If the user has played before and we have their information, simply pass the information back to the client
      }
    })
})

let timer; //Stores the time left for a question to be answered, this stops users cheating the system and getting more time.

/*
  This method is called when a new question needs to be displayed to the user.
  Once the timer is up, it moves onto the next question left in the database.
*/
function passQuestion() {
  quiz.state = "Playing"
  io.emit('resetQuestion', {})
  resetUserQuestion()

  //If its the last question, clear the interval.
  timer = new Date();
  timer.setSeconds(timer.getSeconds() + secondsPerQuestion);
  index++

  //If quiz questions are just 1 or more if will display, even if the user refreshes the page.
  //This checks to see if its the last question in in the quiz. If it is, it will terminate the loop and reset everything.
  console.log("length", quizData.length, index)
  if ((quizData.length-1) <= (index)) {
    console.log("2 No more questions, the game is over.")
    runQuestion()
    reset()
    outputQuizResults()
  } else if (quizData.length > 1) {
    runQuestion()
  } else {
    reset()
    console.log("1 No more questions, the game is over.")
  }

}

let currentCorrect; //Stores the correct answer for each quiz question

/*
  This method just renders all the correct information to the user connecting.
  If the user refreshes the page (or joins late), it will show the user the correct question (the same for every user).
  This is also a way to stop users cheating or accidentally refreshing the page.
*/
function runQuestion() {
  //A try and catch incase anything goes wrong with the questions.
  try {
    //If the timer hasn't been created, it gets created and passed to all users connected.
    if (typeof timer == "undefined") {
      timer = new Date();
      timer.setSeconds(timer.getSeconds() + secondsPerQuestion);
    }
    quizData[index]['data'].timer = timer
    currentCorrect = quizData[index]['ans-correct']

    io.emit('showQuestion', quizData[index]['data']) //Passes the relevant question information to the user
  } catch(e) {
    //If a problem does occur, it needs to reset the quiz data and report the error.
    console.log("Problem with indexing ", e)
    reset()
  }
}

/*
  This method displays all of the final results to the user
*/
function outputQuizResults() {
  //Display all the results
  setTimeout(function(){
    //io.emit('displayScoreBoard', users)
    io.emit('redirect', '/leaderboards')
  }, (secondsPerQuestion+(serverOffset-1)) * 1000);

  //After 10 seconds from showing the user the scores, reset the game entirly (the data only gets removed twhen the user refreshes their page)
  setTimeout(function(){
    users = []
    quiz.state = "Not_Playing"
  }, ((secondsPerQuestion+(serverOffset-1))+ 10) * 1000);  //Times out 10 seconds after redirect

}

/*
  This method resets all of the games information, ready for the next quiz that wants to be played
*/
function reset() {
  console.log("Resetting the game...")
  clearInterval(loop) //Clears the loop.
  quizData = {}
  index = 0
  timer = undefined
  quiz.state = "Ended" //Sets quiz state to ended
}

/*
  This method is called when the user answers a question on the quiz.
  It updates the users score and determines if they have the answer correct or not.
*/
function userAnswer(answer, id) {
  for (let i = 0; i < users.length; i++) {
    if (users[i].id == id && users[i].answeredQuestion == false) {
      if (answer == currentCorrect) {
        users[i].questionsCorrect += 1
        users[i].lastQuestionCorrect = true
      } else {
        users[i].questionsIncorrect += 1
      }
      users[i].answeredQuestion = true
    }
  }
}

/*
  This method is called when a new question in the quiz is shown.
  It resets the users last played answer.
  This is ensures a user cannot cheat by not answering a question. If they do not answer before the timer is up, it will mark them down as getting the question incorrect.
*/
function resetUserQuestion() {
  for (let i = 0; i < users.length; i++) {
    if (users[i].answeredQuestion == false) {
      users[i].questionsIncorrect += 1
    } else {
      users[i].answeredQuestion = false
      users[i].lastQuestionCorrect = false
    }
  }
}

/*
  This method retrives a particular users current information
  After is has got their data, it creates an object and returns that object.
*/
async function getUserInfo(users, id) {
  let validUser = false;
  let allUsernames = [];
  let yourUsername;
  //Retrive relevant user (by their ID which is stored and passed from their cookie server side)
  for (let i = 0; i < users.length; i++) {
    allUsernames.push(users[i].username)
    if (users[i].id == id) {
      validUser = true
      yourUsername = users[i].username
    }
  }
  //New object is created with their relevant information and is returned
  let returnVal = {
    validUser: validUser,
    allUsernames: allUsernames,
    yourUsername: yourUsername
  }
  return returnVal
}
