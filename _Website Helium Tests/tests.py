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

def main():
    browserDriver = openPinPage()
    tryPinNotExist() #1
    delay(1)
    tryNoPin() #2
    delay(1)
    tryPinExist() #3
    delay(2)
    checkUsernameVoid() #4
    delay(2)
    checkUsernameSubmits() #5
    delay(1)
    hostQuizStart() #6 - Starts the quiz
    set_driver(browserDriver)
    delay(1)
    hasUserBeenRedirect("Will Claudia gives us a good mark?") #7
    delay(1)
    answerQuestion("Hopefully") #8
    delay(1)
    
    #kill_browser()

main()
