/*
  This file is for all the MySQL queries and database information
*/

/*
  MySQL config
*/
let mysql = require('mysql');
var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  database: 'nobrainer',
  password: ""
});

/*
  Main Functions
*/

//This function initalises the database
function init() {
  con.connect(function(err) {
    if (err) throw err;
    console.log("Connected to database");
  });
}

/*
  @param int pin This is the PIN the user enters into the quiz
  This function gets all of the quiz data and puts it into one large JSON object.
*/
async function getQuizData(pin) {
  return new Promise((resolve, reject) => {
   let quizID;
   var getID = "SELECT id q\
                FROM quizzes \
                WHERE quiz_pin = " + pin;
    //Gets the other data
    con.query(getID, function (err, result) {
      if (err) throw err;
      if (typeof result[0] != "undefined") {
        quizID = result[0].q

        //Gets other data with the quizID we just got..
        var getAllOtherData = "SELECT quiz_questions.question AS question, quiz_questions.id AS questionID, quiz_questions.quiz_id AS quizID, question_choices.choice AS choice, \
                               question_choices.is_right_choice AS rightChoice, question_choices.question_id AS questionIDChoice \
                               FROM question_choices, quiz_questions \
                               WHERE quiz_questions.id = question_choices.question_id AND quiz_questions.quiz_id = " + quizID;
         con.query(getAllOtherData, function (err, result) {
           if (err) throw err;
           //console.log(result)
           resolve(sortData(result))
           //Put into appropiate data format
         });
     } else {
       console.log("Doesn\'t exist with that pin")
     }
    });
  })
}

function sortData(data) {
  let allQuizData = []
  let index = 0;
  let last = ""
  let rightAnswer  = ''
  let questionDetails = resetQuestionDetails(1)
  let numberIndex = 2
  for (let i = 0; i < data.length; i++) {
    if (last == "" || last == data[i].question) {
      last = data[i].question
      questionDetails.question = last

      //Building object up. Inefficent, can be imporved..
      if (index == 0) {
        questionDetails.ans1 = data[i].choice
      } else if (index == 1) {
        questionDetails.ans2 = data[i].choice
      } else if (index == 2) {
        questionDetails.ans3 = data[i].choice
      } else {
        questionDetails.ans4 = data[i].choice
      }

      if (data[i].rightChoice == '1') {
        rightAnswer = data[i].choice
      }
      index++
    } else {
      //append to list
      allQuizData.push(addRightAnswer(questionDetails, rightAnswer))
      questionDetails = resetQuestionDetails(numberIndex)
      questionDetails.ans1 = data[i].choice
      if (data[i].rightChoice == '1') {
        rightAnswer = data[i].choice
      }
      numberIndex++
      index = 1
      last = ""
    }
  }
  allQuizData.push(addRightAnswer(questionDetails, rightAnswer))
  return allQuizData
}

function addRightAnswer(list, rightAnwer) {
  return mainData = {
    'ans-correct': rightAnwer,
    'data': list
  }
}

function resetQuestionDetails(numberIndex) {
  return questionDetails = {
      'question-no': numberIndex,
      'timer': 30,
      'question': '',
      'ans1': '',
      'ans2': '',
      'ans3': '',
      'ans4': '',
    }
}

function getQuiz(quizID) {
  //Gets all the quizQuestions
}

function getQuestions(quizID) {
  //Gets all the quizQuestions
}

function getAnswers(quizID) {
  //Gets all the quizQuestions
}

module.exports.getQuizData = getQuizData
module.exports.init = init
