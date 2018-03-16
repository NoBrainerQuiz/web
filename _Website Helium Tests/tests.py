from helium.api import *
import time

#We have added in time delays as our game quiz works based on time. Furthermore, time delays makes it easier to see the test process
#To run the tests, start up the web server and socket server.
   

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

def checkUsernameModal():
    if Button('Submit Username').exists():
        print("Test is successful, new web session asks for username validation upon question page")
    else:
        print("Test has failed, should have to validate the user upon a new web session")    

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
        print("Test sucessful, user has been redirected to home page")
    else:
        print("Test failed, user hasn't been redirected to home page")

def answerAnotherQuestion():
    if Button("2008").is_enabled() == False:
        print("Test success, they cannot change their answer")
    else:
        print("Test failed, the user should not be able to change their answer")

def sameQuestionAfterRefresh(testText):
    refresh()
    if Text(testText).exists():
        print("Test is successful, after page refreshing it still shows the same question")
    else:
        print("Test has failed, the user should be able to refresh the page and still view the questions")  

def backToHomePage():
    click(Button("CREATE QUIZ"))
    click(S("#homeImage"))
    if Button("TAKE QUIZ").exists() == True:
        print("Test sucessful, user has been redirected to home page from the login screen")
    else:
        print("Test failed, user hasn't been redirected to home page from the login screen")

def checkGameReset():
    if Text("Loading answer 1...").exists():
        print("Test is successful, the questions have been reset on the server and client")
    else:
        print("Test has failed, the questions should have reset after a whole game was played.") 

def main():
    #Tests to check the functionality of playing the quiz
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
    set_driver(browserDriver) #This has to re allocated the driver to the old browser
    delay(1)
    
    hasUserBeenRedirect("Will Claudia gives us a good mark?") #7 Checking the user has been redirected
    delay(1)
    
    answerQuestion("Hopefully") #8 - Checking the user can answer a question
    delay(3)
    
    isAnswerCorrect(True) #9 - checking answer is correct
    delay(7)
    
    sameQuestionAfterRefresh("When was Github created?") #10 - What happens when the user refreshses the page, does it show the same question
    delay(2)
    
    hasUserBeenRedirect("When was Github created?") #11 -see if new question has shown
    
    click(Button("2012")) #Clicks the button to answer the question
    delay(3)
    
    answerAnotherQuestion() #12 - Can a user click a question when they have already clicked a question
    delay(2)
    
    isAnswerCorrect(False) #13 - checking answer is incorrect
    delay(11)
    
    isTimeUp() #14 - has the user entered something and has the correct message appeared
    delay(6)
    
    hasUserBeenRedirect("LEADERBOARD") #12 - has users been redirected to leaderboard page
    
    isScoreCorrect() #15 - checks if user score is correct
    
    correctPlace() #16 - check if user postion is correct
    delay(3)
    
    isHomePage() #17 - check that user has been redirected to home page

    #click(Button("TAKE QUIZ"))
    backToHomePage() #18 - check you can go back to the homepage in the login page.
    delay(2)

    go_to("http://127.0.0.1:8000/question")
    
    #Tests after a quiz has been played fully

    delay(1)
    checkUsernameModal() #19 - If a user goes straight to the question page before entering a username, does it make them validate themselves
    delay(1)
    checkGameReset() #20 - after playing a game do all of the questions reset

main()
