from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.chrome.options import Options
import time

options = webdriver.ChromeOptions()
options.add_experimental_option("detach", True)
options.add_experimental_option('excludeSwitches', ['enable-logging'])
driver = webdriver.Chrome(options=options)


testUsername = ''
testPassword = ''



def test_login(username, password):
    try:
        driver.get("http://127.0.0.1:8000")
        username_input = driver.find_element("id" , "username")
        password_input = driver.find_element("id" , "password")
        login_button = driver.find_element("css selector", 'button[type="submit"]')

        username_input.send_keys(username)
        password_input.send_keys(password)
        login_button.click()

        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user")
        )

    except Exception as e:
        print("An error occurred:", e)


def test_signup(firstname, lastname, username, email):
    try:
        driver.get("http://127.0.0.1:8000")
        link = driver.find_element(By.LINK_TEXT, "Not a user?")
        link.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/guest")
        )
        firstname_input = driver.find_element("id" , "firstname")
        lastname_input = driver.find_element("id" , "lastname") 
        username_input = driver.find_element("id" , "username")
        email_input = driver.find_element("id" , "email")
        signup_button = driver.find_element("css selector", 'button[type="submit"]')

        
        firstname_input.send_keys(firstname)
        lastname_input.send_keys(lastname)
        username_input.send_keys(username)
        email_input.send_keys(email)
        signup_button.click()

        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/saveUserAccount")
        ) 
        global testUsername, testPassword
        testUsername = username
        testPassword = firstname + "123"

    except Exception as e:
        print("An error occurred:", e)


def test_forgetPassword(email):
    try:
        driver.get("http://127.0.0.1:8000")
        link = driver.find_element(By.LINK_TEXT, "Forgot Password")
        link.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/forgotpassword")
        )
        email_input = driver.find_element("id" , "email")
        submit_button = driver.find_element("css selector", 'button[type="submit"]')

        email_input.send_keys(email)
        submit_button.click()

        WebDriverWait(driver, 60).until(
            EC.url_to_be("http://127.0.0.1:8000")
        ) 

    except Exception as e:
        print("An error occurred:", e)


def test_bookMeeting(date , clock, AMorPM, project, projectSummary):
    test_login(testUsername, testPassword)
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Projects and Services")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user/projectsandservices/")
        )
        
        navbar_element2 = driver.find_element(By.LINK_TEXT, "Book a Meeting")
        navbar_element2.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user/bookameeting")
        )
        datetime_input = driver.find_element("id" , "datetime")
        project_input = driver.find_element("id" , "project")
        projectSummary_input = driver.find_element("id" , "projectSummary")
        submit_button = driver.find_element("css selector", 'button[type="submit"]')
        time.sleep(2)
        datetime_input.send_keys(date)
        datetime_input.send_keys(Keys.TAB)  
        datetime_input.send_keys(clock)
        #datetime_input.send_keys(Keys.TAB)  
        datetime_input.send_keys(AMorPM)
        project_input.send_keys(project)
        projectSummary_input.send_keys(projectSummary)
        submit_button.click()
        
        ##CALENDLY ??????????????????
        
        
        
        

    except Exception as e:
        print("An error occurred:", e)

     
 
def test_moneyTransaction(receiver , amount, cardName, cardNumber, cardCVV):
    test_login(testUsername, testPassword)
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Money Transaction")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user/moneytransaction")
        )
        receiver_input = driver.find_element("id" , "receiverUsername")
        amount_input = driver.find_element("id" , "amountToSend")
        cardName_input = driver.find_element("id" , "nameOnCard")
        cardNumber_input = driver.find_element("id" , "creditCardNumber")
        cardCVV_input = driver.find_element("id" , "cvv")
        submit_button = driver.find_element("css selector", 'button[type="submit"]')
        
        receiver_input.send_keys(receiver)
        amount_input.send_keys(amount)
        cardName_input.send_keys(cardName)
        cardNumber_input.send_keys(cardNumber)
        cardCVV_input.send_keys(cardCVV)
        submit_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user/moneytransaction")
        )
        time.sleep(2)
        navbar_element = driver.find_element(By.LINK_TEXT, "Financial History")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user/financialhistory")
        )

    except Exception as e:
        print("An error occurred:", e)


def test_redeemBenefits():
    test_login(testUsername, testPassword)
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Benefits")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user/benefits")
        )
        
        
        ## grab each benefit ID and redeeem them all
        benefits_table = driver.find_elements(By.XPATH , "//table//tbody/tr")
        list=[]
        for row in benefits_table:
            benefit_id_element = row.find_element(By.XPATH, "./td[1]")
            benefitID = benefit_id_element.text
            list.append(benefitID)

        for id in list:
            benefitID_input = driver.find_element("id" , "benefit")
            redeem_button = driver.find_element("css selector", 'button[type="submit"]')
            benefitID_input.send_keys(id)
            redeem_button.click()
            time.sleep(1)
         
    except Exception as e:
        print("An error occurred:", e)
        
        
        
def test_reportProblem(title, description):
    test_login(testUsername, testPassword)
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Report Problem")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user/problem")
        )
        
        title_input = driver.find_element("id" , "problemTitle")
        description_input = driver.find_element("id" , "problemDescription")
        submit_button = driver.find_element("css selector", 'button[type="submit"]')
        
        title_input.send_keys(title)
        description_input.send_keys(description)
        time.sleep(1)
        submit_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)
        
        
        
def test_reportFeedback(title, description):
    test_login(testUsername, testPassword)
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Report Feedback")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user/feedback")
        )
        
        title_input = driver.find_element("id" , "feedbackTitle")
        description_input = driver.find_element("id" , "feedbackDescription")
        submit_button = driver.find_element("css selector", 'button[type="submit"]')
        
        title_input.send_keys(title)
        description_input.send_keys(description)
        time.sleep(1)
        submit_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)
        
        
        
def test_signout():
    test_login(testUsername, testPassword)
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Sign Out")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000")
        )         
    except Exception as e:
        print("An error occurred:", e)
        

def test_cancelLatestSlot():
    test_login(testUsername, testPassword)
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user")
        )
        slot_input = driver.find_element("id" , "slot")
        parent_div = slot_input.find_element(By.XPATH, "./ancestor::div")
        cancel_button = parent_div.find_element("css selector", 'button[type="submit"]') 
        
        slots_table = driver.find_elements(By.XPATH , "//table//tbody/tr")
        list=[]
        for row in slots_table:
            meeting_id_element = row.find_element(By.XPATH, "./td[1]")
            meetingID = meeting_id_element.text
            list.append(meetingID)


        slot_input.send_keys(list[-1])
        cancel_button.click()
        time.sleep(1)
    except Exception as e:
        print("An error occurred:", e)
        
        
def test_cancelSlot(slotID):
    test_login(testUsername, testPassword)
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user")
        )
        slot_input = driver.find_element("id" , "slot")
        parent_div = slot_input.find_element(By.XPATH, "./ancestor::div")
        cancel_button = parent_div.find_element("css selector", 'button[type="submit"]') 
        
        slot_input.send_keys(slotID)
        cancel_button.click()
        time.sleep(1)
    except Exception as e:
        print("An error occurred:", e)


def test_editLatestSlot(description):
    test_login(testUsername, testPassword)
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user")
        )
        slot_input = driver.find_element("id" , "slotID")
        parent_div = slot_input.find_element(By.XPATH, "./ancestor::form")
        edit_button = parent_div.find_element("css selector", 'button[type="submit"]') 
        description_input = driver.find_element("id" , "newDescription")
        
        slots_table = driver.find_elements(By.XPATH , "//table//tbody/tr")
        list=[]
        for row in slots_table:
            meeting_id_element = row.find_element(By.XPATH, "./td[1]")
            meetingID = meeting_id_element.text
            list.append(meetingID)

        slot_input.send_keys(list[-1])
        description_input.send_keys(description)
        time.sleep(1)
        edit_button.click()
        
    except Exception as e:
        print("An error occurred:", e)
        

def test_editSlot(ID , description):
    test_login(testUsername, testPassword)
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user")
        )
        slot_input = driver.find_element("id" , "slotID")
        parent_div = slot_input.find_element(By.XPATH, "./ancestor::form")
        edit_button = parent_div.find_element("css selector", 'button[type="submit"]') 
        description_input = driver.find_element("id" , "newDescription")

        slot_input.send_keys(ID)
        description_input.send_keys(description)
        time.sleep(1)
        edit_button.click()
        
    except Exception as e:
        print("An error occurred:", e)

def test_changePassword(password):
    test_login(testUsername, testPassword)
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user")
        )
        password_input = driver.find_element("id" , "password")
        parent_div = password_input.find_element(By.XPATH, "./ancestor::div")
        driver.execute_script("arguments[0].scrollIntoView();", parent_div)  
        change_button = parent_div.find_element("css selector", 'button[type="submit"]')   
        
        password_input.send_keys(password)
        time.sleep(1)
        change_button.click()  
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user/")
        )
        password_input = driver.find_element("id" , "password")
        parent_div = password_input.find_element(By.XPATH, "./ancestor::div")
        driver.execute_script("arguments[0].scrollIntoView();", parent_div)  
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user/")
        )
        
        ##FOR FULL SIMULATION YOU MIGHT WANT TO CHANGE IT BACK
        
    except Exception as e:
        print("An error occurred:", e)
    
def test_changeMobile(mobile):
    test_login(testUsername, testPassword)
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user")
        )
        mobile_input = driver.find_element("id" , "mobile")
        parent_div = mobile_input.find_element(By.XPATH, "./ancestor::div")
        driver.execute_script("arguments[0].scrollIntoView();", parent_div)  
        change_button = parent_div.find_element("css selector", 'button[type="submit"]')   
        
        mobile_input.send_keys(mobile)
        time.sleep(1)
        change_button.click()  
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user/")
        )
        mobile_input = driver.find_element("id" , "mobile")
        parent_div = mobile_input.find_element(By.XPATH, "./ancestor::div")
        driver.execute_script("arguments[0].scrollIntoView();", parent_div)  
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/user/")
        )
        
        ##FOR FULL SIMULATION YOU MIGHT WANT TO CHANGE IT BACK
        
    except Exception as e:
        print("An error occurred:", e)
    
     

######################### TEST RUNS ##################################
#BEFORE TESTING PLEASE SET THE 'testUsername' and 'testPassword' MANUALLY AT THE TOP OF THE PAGE FOR THE TESTS TO WORK
#IF YOU WANT TO TEST WITH A NEW ACCOUNT TEST THE SIGNUP FIRST AND THEN MANUALLY SET THE VARIABLES

#test_signup("Youssef" , "Khalil" , "youssefkhalil" , "youssefkhalil@gmail.com")

#test_login(testUsername, testPassword)

#test_forgetPassword("minatamer11@gmail.com")

#test_bookMeeting("10-08-2024" ,  "12:30" , "P" , "web" , "blablablablablablabla")

##ASSUMING THERE IS A USER WITH USERNAME "youssefemad"
#test_moneyTransaction("youssefemad" , "200" , "Mina Tamer", "28281837192", "533")

#test_redeemBenefits()

#test_reportProblem("Glitch", "description of glitch")

#test_reportFeedback("Web Development", "Excellent product")

#test_signout()

#test_changePassword("temporary")

#test_cancelSlot("11")

#test_cancelLatestSlot()

#test_changeMobile("01228414444")

#test_editLatestSlot("edited description")

#test_editSlot("11" , "edited description")