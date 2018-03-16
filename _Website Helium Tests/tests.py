from helium.api import *
import time

#Please make sure you have Google Chrome installed to do these tests.
#After every test please restart the node socket server! This is very important

"""start_chrome("google.com/?hl=en")
write("Helium")
press(ENTER)
click("Helium - Wikipedia")
if 'Wikipedia' in get_driver().title:
	print('Test passed!')
else:
	print('Test failed :(')
kill_browser()"""

def openPinPage():
    browserDriver = start_chrome("http://127.0.0.1:8000")
    click(Button("TAKE QUIZ"))
    return browserDriver

def tryPinNotExist():
    write("4567") #Pin doesn't work
    press(ENTER)
    #has failed or passed?
    if S("#pinError").exists() == True:
        print("Test success, the PIN does not exist")
    else:
        print("Test failed, the pin should not exist.")

def tryNoPin():
    press(ENTER)
    if S("#noPinError").exists() == True:
        print("Test success, no pin was entered and it throws an error message")
    else:
        print("Test failed, an error message should occur if no pin has been entered")

def tryPinExist():
    write("9876") #Pin doesn't work
    press(ENTER)
    #Look for element to see if it has worked
    if S("#waitMessage").exists() == True:
        print("Test success, we have been redirected to the splash page")
    else:
        print("Test failed, we should now have been redirected as the pin exists.")

def delay(seconds):
    time.sleep(seconds)

#Validation test

#Test that you can't have a blank username
def checkUsernameVoid():
    click(Button('Submit Username'))
    if Button('Submit Username').is_enabled() == True:
        print("Test is successful as username cannot be left blank")
    else:
        print("Test has failed, username field should not be able to be left blank")

def checkUsernameSubmits():
    click(S("#username"))
    write("UP805717")
    delay(1)
    click(Button('Submit Username'))
    if Button('Submit Username').is_enabled() == False:
        print("Test is successful as it contains text")
    else:
        print("Test has failed, button should disable after submit")

def hostQuizStart():
    start_chrome("http://127.0.0.1:8000/quiz/start/9876")
    if Text("event fired.. users should have been redirected for pin: 9876").exists():
        print("Test is successful, the quiz host has started the quiz")
    else:
        print("Test has failed, the quiz has not been started")
    kill_browser()

def hasUserBeenRedirect(testText):
    if Text(testText).exists():
        print("Test is successful, the user has been redirected")
    else:
        print("Test has failed, the user has NOT been redirected")    

def answerQuestion(buttonText):
    click(Button(buttonText))
    if Button(buttonText).is_enabled() == False:
        print("Test success, it answered a question")
    else:
        print("Test failed, it should have answered a question")

def isAnswerCorrect(correctAnswer):
    if correctAnswer == True:
        if Button('testBtn').is_enabled() == True:
            print("Test success, the answer picked was correct")
        else:
            print("Test failed, the answer should display as correct")
    else:
        if Button('testBtn').is_enabled() == False:
            print("Test success, the answer picked was incorrect")
        else:
            print("Test failed, the answer should display as incorrect")

def isTimeUp():
    if Text("The timer has been complete!").exists():
        print("Test successful, no answer was picked and timer ran out message was shown")
    else:
        print("Test failed, timer ran out message was not shown")

def isScoreCorrect():
    if Text("5").exists():
        print("Test successful, The score was shown correctly")
    else:
        print("Test failed, score was not shown correctly")

def correctPlace():
    if Text("1st - UP805717").exists():
        print("Test successful, Correct postion shown")
    else:
        print("Test failed, incorrect postion shown")

def isHomePage():
    click(S("#homeImage"))
    if Button("TAKE QUIZ").exists() == True:
        print("Test sucessful, User has been redirected to home page")
    else:
        print("Test failed, User hasn't been redirected to home page")

def main():
    browserDriver = openPinPage()
    tryPinNotExist() #1 - Tries no pin.
    delay(1)
    tryNoPin() #2 - Checks an incorrect pin returns an error
    delay(1)
    tryPinExist() #3 - Checks a PIN exists
    delay(2)
    checkUsernameVoid() #4 - Checks the the username cannot be blank
    delay(2)
    checkUsernameSubmits() #5 - Checks the user can input a username
    delay(1)
    hostQuizStart() #6 - Checks the quiz starts
    set_driver(browserDriver)
    delay(1)
    hasUserBeenRedirect("Will Claudia gives us a good mark?") #7 Checking the user has been redirected
    delay(1)
    answerQuestion("Hopefully") #8 - Checking the user can answer a question
    delay(3)
    isAnswerCorrect(True) #9 - checking answer is correct
    delay(7)
    hasUserBeenRedirect("When was Github created?") #see if new question has shown
    click(Button("2012"))
    delay(6)
    isAnswerCorrect(False) #10 - checking answer is incorrect
    delay(13)
    isTimeUp()#11 - has the user entered something and has the correct message appeared
    delay(4)
    hasUserBeenRedirect("LEADERBOARD")#12 - has users been redirected to leaderboard page
    isScoreCorrect()#13 - checks if user score is correct
    correctPlace()#14 - check if user postion is correct
    delay(3)
    isHomePage()#15 - check that user has been redirected to home page
    
    

main()
