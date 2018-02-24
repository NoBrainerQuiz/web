/*
  This file is for all the MySQL queries and database information
*/

module.exports = function(con) {

  con.connect(function(err) {
    if (err) throw err;
    console.log("Connected to database");
  });



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
