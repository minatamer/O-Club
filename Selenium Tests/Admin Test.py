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
            EC.url_to_be("http://127.0.0.1:8000/admin")
        )

    except Exception as e:
        print("An error occurred:", e)
        
        
def test_addUser(username, password, email):
    test_login("admin", "admin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Users")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin/manageusers")
        )
        
        username_input = driver.find_element("id" , "username")
        password_input = driver.find_element("id" , "password")
        email_input = driver.find_element("id" , "email")
        parent_div = username_input.find_element(By.XPATH, "./ancestor::div")
        add_button = parent_div.find_element("css selector", 'button[type="submit"]')
        
        username_input.send_keys(username)
        password_input.send_keys(password)
        email_input.send_keys(email)
        time.sleep(1)
        add_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/addUser-Admin")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)
        
        
def test_viewUser(userID):
    test_login("admin", "admin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Users")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin/manageusers")
        )
        
        userID_input = driver.find_element("id" , "userID")
        parent_div = userID_input.find_element(By.XPATH, "./ancestor::form")
        view_button = parent_div.find_element("css selector", 'button[type="submit"]')
        
        userID_input.send_keys(userID)
        time.sleep(1)
        view_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/viewUserData-Admin")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)
 
 
def test_deleteUser(userID):
    test_login("admin", "admin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Users")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin/manageusers")
        )
        header_div = driver.find_element(By.XPATH, "//div[@class='card-header' and contains(text(), 'Delete User')]")
        parent_div = header_div.find_element(By.XPATH, "./ancestor::div")
        userID_input = parent_div.find_element("id" , "userID")
        delete_button = parent_div.find_element("css selector", 'button[type="submit"]')
        
        userID_input.send_keys(userID)
        time.sleep(1)
        delete_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/deleteUser-Admin")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)
 
       

def test_deleteLatestUser():
    test_login("admin", "admin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Users")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin/manageusers")
        )
        header_div = driver.find_element(By.XPATH, "//div[@class='card-header' and contains(text(), 'Delete User')]")
        parent_div = header_div.find_element(By.XPATH, "./ancestor::div")
        userID_input = parent_div.find_element("id" , "userID")
        delete_button = parent_div.find_element("css selector", 'button[type="submit"]')
        
        users_table = driver.find_elements(By.XPATH , "//table//tbody/tr")
        list=[]
        for row in users_table:
            user_id_element = row.find_element(By.XPATH, "./td[1]")
            userID = user_id_element.text
            list.append(userID)
        
        userID_input.send_keys(list[-1])
        time.sleep(1)
        delete_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/deleteUser-Admin")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)
        

def test_assignManager(userID, managerEmail):
    test_login("admin", "admin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Users")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin/manageusers")
        )
        header_div = driver.find_element(By.XPATH, "//div[@class='card-header' and contains(text(), 'Assign Manager to User')]")
        parent_div = header_div.find_element(By.XPATH, "./ancestor::div")
        userID_input = parent_div.find_element("id" , "userID")
        email_input = parent_div.find_element("id" , "email")
        submit_button = parent_div.find_element("css selector", 'button[type="submit"]')
        
        userID_input.send_keys(userID)
        email_input.send_keys(managerEmail)
        time.sleep(1)
        submit_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/assignManager-Admin")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)
        
        

def test_assignManagerToLatestUser(managerEmail):
    test_login("admin", "admin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Users")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin/manageusers")
        )
        header_div = driver.find_element(By.XPATH, "//div[@class='card-header' and contains(text(), 'Assign Manager to User')]")
        parent_div = header_div.find_element(By.XPATH, "./ancestor::div")
        userID_input = parent_div.find_element("id" , "userID")
        email_input = parent_div.find_element("id" , "email")
        submit_button = parent_div.find_element("css selector", 'button[type="submit"]')
        
        users_table = driver.find_elements(By.XPATH , "//table//tbody/tr")
        list=[]
        for row in users_table:
            user_id_element = row.find_element(By.XPATH, "./td[1]")
            userID = user_id_element.text
            list.append(userID)
        
        userID_input.send_keys(list[-1])
        email_input.send_keys(managerEmail)
        time.sleep(1)
        submit_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/assignManager-Admin")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)



def test_addProject(name, description):
    test_login("admin", "admin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Projects/Services")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin/manageprojectsandservices")
        )
        header_div = driver.find_element(By.XPATH, "//div[@class='card-header' and contains(text(), 'Add Project')]")
        parent_div = header_div.find_element(By.XPATH, "..")
        name_input = parent_div.find_element("id" , "name")
        description_input = parent_div.find_element("id" , "description")
        add_button = parent_div.find_element("css selector", 'button[type="submit"]')
        driver.execute_script("arguments[0].scrollIntoView();", parent_div)  
        
        name_input.send_keys(name)
        description_input.send_keys(description)
        time.sleep(1)
        add_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/addProject-Admin")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)


def test_deleteProject(projID):
    test_login("admin", "admin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Projects/Services")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin/manageprojectsandservices")
        )
        header_div = driver.find_element(By.XPATH, "//div[@class='card-header' and contains(text(), 'Delete Project')]")
        parent_div = header_div.find_element(By.XPATH, "..")
        projID_input = parent_div.find_element("id" , "projID")
        delete_button = parent_div.find_element("css selector", 'button[type="submit"]')
        driver.execute_script("arguments[0].scrollIntoView();", parent_div)  
        
        projID_input.send_keys(projID)
        time.sleep(1)
        delete_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/deleteProject-Admin")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)

def test_editProject(projID, name, description):
    test_login("admin", "admin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Projects/Services")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin/manageprojectsandservices")
        )
        header_div = driver.find_element(By.XPATH, "//div[@class='card-header' and contains(text(), 'Edit Project')]")
        parent_div = header_div.find_element(By.XPATH, "..")
        projID_input = parent_div.find_element("id" , "projID")
        name_input = parent_div.find_element("id" , "name")
        description_input = parent_div.find_element("id" , "description")
        edit_button = parent_div.find_element("css selector", 'button[type="submit"]')
        driver.execute_script("arguments[0].scrollIntoView();", header_div)  
        
        projID_input.send_keys(projID)
        name_input.send_keys(name)
        description_input.send_keys(description)
        time.sleep(1)
        edit_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/editProject-Admin")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)
        
        
        
def test_approveBrief(briefID):
    test_login("admin", "admin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Briefs")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin/managebriefs")
        )
        header_div = driver.find_element(By.XPATH, "//div[@class='card-header' and contains(text(), 'Approve Brief')]")
        parent_div = header_div.find_element(By.XPATH, "..")
        briefID_input = parent_div.find_element("id" , "briefID")
        approve_button = parent_div.find_element("css selector", 'button[type="submit"]')
        
        briefID_input.send_keys(briefID)
        time.sleep(1)
        approve_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/approveBrief-Admin")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)
        
        
def test_denyBrief(briefID):
    test_login("admin", "admin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Briefs")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin/managebriefs")
        )
        header_div = driver.find_element(By.XPATH, "//div[@class='card-header' and contains(text(), 'Deny Brief')]")
        parent_div = header_div.find_element(By.XPATH, "..")
        briefID_input = parent_div.find_element("id" , "briefID")
        deny_button = parent_div.find_element("css selector", 'button[type="submit"]')
        
        briefID_input.send_keys(briefID)
        time.sleep(1)
        deny_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/denyBrief-Admin")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)
        
        
def test_addManager(email, name):
    test_login("admin", "admin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage AccountManagers")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin/manageaccountmanagers")
        )
        header_div = driver.find_element(By.XPATH, "//div[@class='card-header' and contains(text(), 'Add Account Manager')]")
        parent_div = header_div.find_element(By.XPATH, "..")
        email_input = parent_div.find_element("id" , "email")
        name_input = parent_div.find_element("id" , "name")
        add_button = parent_div.find_element("css selector", 'button[type="submit"]')
        driver.execute_script("arguments[0].scrollIntoView();", parent_div)  
        
        email_input.send_keys(email)
        name_input.send_keys(name)
        time.sleep(1)
        add_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/addManager-Admin")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)



def test_deleteManager(email):
    test_login("admin", "admin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage AccountManagers")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin/manageaccountmanagers")
        )
        header_div = driver.find_element(By.XPATH, "//div[@class='card-header' and contains(text(), 'Delete Account Manager')]")
        parent_div = header_div.find_element(By.XPATH, "..")
        email_input = parent_div.find_element("id" , "email")
        delete_button = parent_div.find_element("css selector", 'button[type="submit"]')
        driver.execute_script("arguments[0].scrollIntoView();", parent_div)  
        
        email_input.send_keys(email)
        time.sleep(1)
        delete_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/deleteManager-Admin")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)


def test_signout():
    test_login("admin", "admin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Sign Out")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000")
        )         
    except Exception as e:
        print("An error occurred:", e)
        
        
def test_viewFeedback():
    test_login("admin", "admin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "View Feedback")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin/viewfeedback")
        )         
    except Exception as e:
        print("An error occurred:", e)
        
        
def test_viewProblems():
    test_login("admin", "admin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "View Problems")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/admin/viewproblems")
        )         
    except Exception as e:
        print("An error occurred:", e)

######################### TEST RUNS ##################################

test_login("admin", "admin")

#test_addUser("slimjim", "Slim123", "slim@gmail.com")

#test_viewUser("19")

#test_deleteUser("19")

#test_assignManager("15", "ahmed@gmail.com")

#test_addProject("new project", "new project description")

#test_deleteProject("14")

#test_editProject("14", "edited name", "edited description")

#test_approveBrief("11")

#test_denyBrief("11")

#test_addManager("newmanager@gmail.com", "new man")

#test_deleteManager("newmanager@gmail.com")

#test_viewFeedback()

#test_viewProblems()

#test_signout()