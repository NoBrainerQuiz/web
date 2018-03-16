from helium.api import *
import random

# NoBrainer authentication tests, using laravel homestead / vagrant
# @author up821309

def openLoginPage():
    browserDriver = start_chrome("http://homestead.nobrainer")
    click(Button("CREATE QUIZ"))
    return browserDriver

def test_UsernameOrPasswordInvalid():
    write("invalid username", into="Username/Email")
    write("invalid password", into="Password")
    click(Button("Sign in"))
    #has failed or passed?
    if S("#loginError").exists() == True:
        print("Test success, the username and password were invalid")
    else:
        print("Test failed, the username and password should not exist.")

# This assumes the default user quiz_host is within the database.
# Run php artisan db:seed to populate the tables with this dummy data
def test_UsernameInvalid():
    write("invalid_username-quiz_host", into="Username/Email")
    write("secret", into="Password")
    click(Button("Sign in"))
    #has failed or passed?
    if S("#loginError").exists() == True:
        print("Test success, the username was invalid but password valid.")
    else:
        print("Test failed, the username should be invalid, password valid.")

# This assumes the default user quiz_host is within the database.
# Run php artisan db:seed to populate the tables with this dummy data
def test_PasswordInvalid():
    write("quiz_host", into="Username/Email")
    write("incorrect password", into="Password")
    click(Button("Sign in"))
    #has failed or passed?
    if S("#loginError").exists() == True:
        print("Test success, the username was valid but password invalid.")
    else:
        print("Test failed, the username should be valid but password invalid.")

def test_EmptyFieldsLogin():
    click(Button("Sign in"))
    #has failed or passed?
    if S("#loginError").exists() == True:
        print("Test success, fields cannot be empty.")
    else:
        print("Test failed, fields cannot be empty")      

def test_SuccessfulLogin():
    write("quiz_host", into="Username/Email")
    write("secret", into="Password")
    click(Button("Sign in"))

    if (Text('Your Dashboard').exists()):
        print("Test success, successfully logged in.")
    else:
        print("Test failed, user not logged in.")

def openForgotPasswordPage(): 
    openLoginPage()
    click("I forgot my password")

def test_EmptyFieldResetPassword():
    click(Button("Send reset link"))
    if (S("#resetPasswordError").exists() or Text("The email field is required.").exists()):
        print("Test success, field cannot be empty.")
    else:
        print("Test failed, field cannot be empty")   

def test_InvalidEmailResetPassword():
    write("invalidemail@nobrainerquiz.com", into="Email")
    click(Button("Send reset link"))
    if (S("#resetPasswordError").exists() or Text("We can't find a user with that e-mail address.").exists()):
        print("Test success, invalid email address (not found in db).")
    else:
        print("Test failed, email is invalid.") 

def test_SuccessfulResetPassword():
    write("quiz_host@nobrainerquiz.com", into="Email")
    click(Button("Send reset link"))
    if (S("#successfulLinkSent").exists() or Text("We have e-mailed your password reset link!").exists()):
        print("Test success, password reset email sent")
    else:
        print("Test failed, password reset email not sent") 

def openRegisterPage(): 
    openLoginPage()
    click("Sign up")

def test_EmptyFieldRegisterPage():
    click(Button("Create my account"))
    if (S("#registerError").exists() or Text("The username field is required.").exists()
    or Text("The email field is required.").exists() 
    or Text("The password field is required.").exists()):
        print("Test success, fields cannot be empty.")
    else:
        print("Test failed, fields cannot be empty")   

def test_UsernameEmailExistsRegister():
    write("quiz_host", into="Username")
    write("quiz_host@nobrainerquiz.com", into="Email")
    write("secret", into="Password")
    write("secret", into="Confirm Password")
    click(Button("Create my account"))
    if (Text("The username has already been taken.").exists()
    and Text("The email has already been taken.").exists()):
        print("Test success, username and password already taken.")
    else:
        print("Test failed, username and password are already taken.")

def test_SuccessfulRegistration():
    write(random.choice("abcde"), into="Username")
    write(random.choice("abcde") + "@nobrainerquiz.com", into="Email")
    write("secret", into="Password")
    write("secret", into="Confirm Password")
    click(Button("Create my account"))

    if (Text('Your Dashboard').exists()):
        print("Test success, account successfully created.")
    else:
        print("Test failed, account not successfully created.")

def main():
    # Login page tests
    print("Initialising login tests...")
    openLoginPage()
    test_UsernameOrPasswordInvalid()
    refresh()
    test_UsernameInvalid()
    refresh()
    test_PasswordInvalid()
    refresh()
    test_EmptyFieldsLogin()
    refresh()
    test_SuccessfulLogin()
    print("Login tests have all been completed, closing browser.")
    kill_browser()

    # Forgot password tests
    print("Initialising Reset Password tests...")
    openForgotPasswordPage()
    test_EmptyFieldResetPassword()
    refresh()
    test_InvalidEmailResetPassword()
    refresh()
    test_SuccessfulResetPassword()
    
    print("Reset password tests have all been completed, closing browser.")
    kill_browser()

    # Registration tests
    print("Initialising registration tests...")
    openRegisterPage()
    test_EmptyFieldRegisterPage()
    refresh()
    test_UsernameEmailExistsRegister()
    refresh()
    test_SuccessfulRegistration()

    print("Registration tests have all been completed, closing browser.")
    kill_browser()
main()
