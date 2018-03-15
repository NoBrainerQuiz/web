/*
  Author: UP805717 (springjben)

  This file is for all the MySQL queries and database information
*/

/*
  MySQL config - this may need to be changed, dependent on your MySQL script. View: https://youtu.be/rxy6xUXWi68 for a mini tutorial.
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
   var getID = "SELECT id \
                FROM quizzes \
                WHERE quiz_pin = " + pin;
    //Gets the other data
    con.query(getID, function (err, result) {
      if (err) throw err;
      if (typeof result[0] != "undefined") {
        quizID = result[0].id
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

/*
  After getting the data from the database, it formats all of the data into a format which is eventually passed back to the sockets file.
*/
function sortData(data) {
  let allQuizData = []
  let index = 0;
  let last = ""
  let rightAnswer  = ''
  let questionDetails = resetQuestionDetails(1)
  let numberIndex = 2
  //Loops through all the data
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
      //Gets the correct answer for the quiz question
      if (data[i].rightChoice == '1') {
        rightAnswer = data[i].choice
      }
      numberIndex++
      index = 1
      last = ""
    }
  }
  allQuizData.push(addRightAnswer(questionDetails, rightAnswer))
  return allQuizData //returns all of the formatted data
}

//This method creates a Javascript object with a quiz question and its correct answer.
function addRightAnswer(list, rightAnwer) {
  return mainData = {
    'ans-correct': rightAnwer,
    'data': list
  }
}

/*
  This method resets the questionDetails object so that a new question can be created.
  This is also here to prevent any errors.
*/
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

module.exports.getQuizData = getQuizData
module.exports.init = init
