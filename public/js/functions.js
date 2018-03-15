/*
  This file includes all of the cookie functions that validates the user.

  Credits to w3schools for some of these functions.
*/

//This creates a cookie on the clients computer with the expiry date, cookie value and name.
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

//If a cookie doesn't exist, it creates a cookie. The cookies value is used to validate the user server side.
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

//This is a method to make a random cookie. Every cookie needs to be unique to validate every user playing the quiz.
function makeid() {
  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

  for (var i = 0; i < 25; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));

  return text;
}

//This function checks they have a cookie created, if they don't it creates a random cookie for them.
function checkCookie() {
    var rnd = getCookie("randomVal");
    if (rnd == "") {
      let id = makeid()
      setCookie("randomVal", id, 365);
      console.log("Creating ID", id)
    }
}

//This is called every time the user loads the page to ensure they can validate themselves with the server
checkCookie()
