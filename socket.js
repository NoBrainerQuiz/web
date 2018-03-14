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

    MAJOR:
      - How does each client know what they are? We NEED socket ids!
    BUGS:
      - Can have the same usernames
      - When everyone answers a question, it still waits. You have to wait for the timer
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

let database = require('./app/Sockets/database.js')
database.init()

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

redis.subscribe('questions', function(err, count) {
  console.log('Listening for questions')
});

let userName;
let loop;
let resetGame = false //This variable is used to reset the client side info
//Issue with web sockets
redis.on('message', async function(channel, message) {
  console.log('Message Recieved: ' + message);
  message = JSON.parse(message);

  quiz.pin = message.data.questionData.pin
  let method = message.data.questionData.method
  //io.emit(channel + ':' + message.event, message.data);
  if (method == "start") {
    quiz.state = "Playing"
    //Get all quiz questions and answers...

    database.getQuizData(quiz.pin).then(result => {
      reset()
      console.log("Quiz data", result)
      quizData = result
      io.emit('showQuestion', quizData[index]['data'])
      //passQuestion(io)
      loop=setInterval(passQuestion, ((secondsPerQuestion+serverOffset) * 1000)); //Starts a timer
    })

    io.emit('redirect', '/question')
  } else if (method == "finish") {
    //Resetting game
    quiz.state = "Ended"
    quiz.questions = []
    quiz.answers = []
    users = [] //Removing all users
    io.emit('redirect', '/')
  }

});

/*
  This is for the main functionality of the quizzes
    - Mainly for the user. This also needs some sort of validation. Perhaps using express sessions?##

*/
//If username is blank then var sillyName = generateName();
io.on('connection', function(client) {
  //console.log(quiz)
  //Upon joining they will be shown the latest question
  console.log("Game state", quiz.state)
  if (quizData.length > 0 || quiz.state == "Playing") {
    runQuestion(users)
  }

  client.on('getLeaderboards', function(data) {
    client.emit('displayLeaderBoards', {users: users})
  })

  client.on('getResults', function(data) {
    client.emit('showResults', {users: users, correct: currentCorrect})
  })

  client.on('answer', function(data) {
    //Validate the answer and show right or wrong screen
    console.log(data)
    userAnswer(data.answer, data.id)
  })

  client.on('addUser', async function(data) {
    console.log("This going off?", data)
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
    let info = await getUserInfo(users, data.id)
    console.log("new user", info)
    client.emit('userInfo', {allUsers: info.allUsernames, username: info.yourUsername})
    })

    client.on('validateUser', async function(data) {
      let info = await getUserInfo(users, data.id)
      console.log(info)
      if (info.validUser == false) {
        client.emit('signUserUp', {})
      } else {
        client.emit('userInfo', {allUsers: info.allUsernames, username: info.yourUsername})
      }
    })

})


io.on('disconnect', function(data) {
  //Remove user from session...
})

let timer;
//This is run when a new question is done
function passQuestion() {
  quiz.state = "Playing"
  console.log("In", index)
  io.emit('resetQuestion', {})
  resetUserQuestion()
  //If its the last question, clear the interval.
  timer = new Date();
  timer.setSeconds(timer.getSeconds() + secondsPerQuestion);
  index++
  console.log("Length============", )

  //If quiz questions are just 1 or more if will display, even if the user refreshes the page.
  if ((quizData.length-1) >= (index)) {
    console.log("No more questions, the game is over.")
    runQuestion()
    reset()
    outputQuizResults()
  } else if (quizData.length > 1) {
    runQuestion()
  } else {
    reset()
    console.log("Its over..")
  }

  console.log("Left: ", quizData.length, index)

  //Check its not the end of the list.. e.g. end of the game
}

let currentCorrect;
//This just renders all the correct information to the user connecting
function runQuestion() {
  console.log("Running Q")
  try {
    if (typeof timer == "undefined") {
      console.log("TIMER UNDEFINED")
      timer = new Date();
      timer.setSeconds(timer.getSeconds() + secondsPerQuestion);
    }
    console.log("Timer", timer)
    quizData[index]['data'].timer = timer
    currentCorrect = quizData[index]['ans-correct']
    //After 30 (Then another 10 seconds for the leaderboards) seconds go to the next question..
    io.emit('showQuestion', quizData[index]['data']) //['question-no', 'timer', 'question', 'ans-1', 'ans-2', 'ans-3', 'ans-4']
    //if then game is over, reset everything
  } catch(e) {
    console.log("Problem with indexing ", e)
    reset()
  }
}

function outputQuizResults() {
  //Display all the results
  //Then remove users...
  setTimeout(function(){
    //io.emit('displayScoreBoard', users)
    io.emit('redirect', '/leaderboards')
  }, (secondsPerQuestion+(serverOffset-1)) * 1000);

  //After a bit of time, reset the game entirly.
  setTimeout(function(){
    //io.emit('displayScoreBoard', users)
    users = []
    quiz.state = "Not_Playing"
  }, ((secondsPerQuestion+(serverOffset-1))+ 10) * 1000);  //Times out 10 seconds after redirect

}

function reset() {
  console.log("Reset game")
  clearInterval(loop)
  //Redirect user
  quizData = {}
  index = 0
  timer = undefined
  quiz.state = "Ended"
}

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

function resetUserQuestion() {
  //Resets the user information, if a user has not answered a question, they will get +1 to their incorrect answered.
  for (let i = 0; i < users.length; i++) {
    if (users[i].answeredQuestion == false) {
      users[i].questionsIncorrect += 1
    } else {
      users[i].answeredQuestion = false
      users[i].lastQuestionCorrect = false
    }
  }
}

async function getUserInfo(users, id) {
  let validUser = false;
  let allUsernames = [];
  let yourUsername;
  for (let i = 0; i < users.length; i++) {
    allUsernames.push(users[i].username)
    if (users[i].id == id) {
      validUser = true
      yourUsername = users[i].username
    }
  }
  let returnVal = {
    validUser: validUser,
    allUsernames: allUsernames,
    yourUsername: yourUsername
  }
  return returnVal
}
