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
            EC.url_to_be("http://127.0.0.1:8000/superadmin")
        )

    except Exception as e:
        print("An error occurred:", e)
        
        
def test_addUser(username, password, email):
    test_login("superadmin", "superadmin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Users")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin/manageusers")
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
            EC.url_to_be("http://127.0.0.1:8000/addUser")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)
        
        
def test_viewUser(userID):
    test_login("superadmin", "superadmin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Users")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin/manageusers")
        )
        
        userID_input = driver.find_element("id" , "userID")
        parent_div = userID_input.find_element(By.XPATH, "./ancestor::form")
        view_button = parent_div.find_element("css selector", 'button[type="submit"]')
        
        userID_input.send_keys(userID)
        time.sleep(1)
        view_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/viewUserData")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)
 
 
def test_deleteUser(userID):
    test_login("superadmin", "superadmin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Users")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin/manageusers")
        )
        header_div = driver.find_element(By.XPATH, "//div[@class='card-header' and contains(text(), 'Delete User')]")
        parent_div = header_div.find_element(By.XPATH, "./ancestor::div")
        userID_input = parent_div.find_element("id" , "userID2")
        delete_button = parent_div.find_element("css selector", 'button[type="submit"]')
        
        userID_input.send_keys(userID)
        time.sleep(1)
        delete_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/deleteUser")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)
 
       
"""
def test_deleteLatestUser():
    test_login("superadmin", "superadmin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Users")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin/manageusers")
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
            EC.url_to_be("http://127.0.0.1:8000/deleteUser")
        )
 
         
    except Exception as e:
        print("An error occurred:", e)
        
"""
def test_assignManager(userID, managerEmail):
    test_login("superadmin", "superadmin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Users")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin/manageusers")
        )
        header_div = driver.find_element(By.XPATH, "//div[@class='card-header' and contains(text(), 'Assign Manager to User')]")
        parent_div = header_div.find_element(By.XPATH, "./ancestor::div")
        userID_input = parent_div.find_element("id" , "userID3")
        email_input = parent_div.find_element("id" , "managerEmail")
        submit_button = parent_div.find_element("css selector", 'button[type="submit"]')
        
        userID_input.send_keys(userID)
        email_input.send_keys(managerEmail)
        time.sleep(1)
        submit_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/assignManager")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)
        
        
"""
def test_assignManagerToLatestUser(managerEmail):
    test_login("superadmin", "superadmin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Users")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin/manageusers")
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
            EC.url_to_be("http://127.0.0.1:8000/assignManager")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)

"""

def test_addAdmin(username, password, email, mobile):
    test_login("superadmin", "superadmin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Admins")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin/manageadmins")
        )
        header_div = driver.find_element(By.XPATH, "//div[@class='card-header' and contains(text(), 'Add Admin')]")
        parent_div = header_div.find_element(By.XPATH, "..")
        username_input = parent_div.find_element("id" , "username")
        password_input = parent_div.find_element("id" , "password")
        email_input = parent_div.find_element("id" , "email")
        mobile_input = parent_div.find_element("id" , "mobile")
        add_button = parent_div.find_element("css selector", 'button[type="submit"]')
        
        username_input.send_keys(username)
        password_input.send_keys(password)
        email_input.send_keys(email)
        mobile_input.send_keys(mobile)
        time.sleep(1)
        add_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/addAdmin")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)


def test_deleteAdmin(adminID):
    test_login("superadmin", "superadmin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Admins")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin/manageadmins")
        )
        header_div = driver.find_element(By.XPATH, "//div[@class='card-header' and contains(text(), 'Delete Admin')]")
        parent_div = header_div.find_element(By.XPATH, "..")
        adminID_input = parent_div.find_element("id" , "adminID")
        delete_button = parent_div.find_element("css selector", 'button[type="submit"]')
        
        adminID_input.send_keys(adminID)
        time.sleep(1)
        delete_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/deleteAdmin")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)
        
        
        
def test_editAdmin(adminID, email, mobile):
    test_login("superadmin", "superadmin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Admins")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin/manageadmins")
        )
        header_div = driver.find_element(By.XPATH, "//div[@class='card-header' and contains(text(), 'Edit Admin')]")
        parent_div = header_div.find_element(By.XPATH, "..")
        adminID_input = parent_div.find_element("id" , "adminID2")
        email_input = parent_div.find_element("id" , "newEmail")
        mobile_input = parent_div.find_element("id" , "newMobile")
        add_button = parent_div.find_element("css selector", 'button[type="submit"]')
        
        adminID_input.send_keys(adminID)
        email_input.send_keys(email)
        mobile_input.send_keys(mobile)
        time.sleep(1)
        add_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/editAdmin")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)
        
        
        
def test_addSuperAdmin(username, password, email, mobile):
    test_login("superadmin", "superadmin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Admins")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin/manageadmins")
        )
        header_div = driver.find_element(By.XPATH, "//div[@class='card-header' and contains(text(), 'Add Super Admin')]")
        parent_div = header_div.find_element(By.XPATH, "..")
        username_input = parent_div.find_element("id" , "superAdminUsername")
        password_input = parent_div.find_element("id" , "superAdminPassword")
        email_input = parent_div.find_element("id" , "superAdminEmail")
        mobile_input = parent_div.find_element("id" , "superAdminMobile")
        add_button = parent_div.find_element("css selector", 'button[type="submit"]')
        driver.execute_script("arguments[0].scrollIntoView();", parent_div)  
        
        username_input.send_keys(username)
        password_input.send_keys(password)
        email_input.send_keys(email)
        mobile_input.send_keys(mobile)
        time.sleep(1)
        add_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/addSuperAdmin")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)


def test_deleteSuperAdmin(superadminID):
    test_login("superadmin", "superadmin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Admins")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin/manageadmins")
        )
        header_div = driver.find_element(By.XPATH, "//div[@class='card-header' and contains(text(), 'Delete Super Admin')]")
        parent_div = header_div.find_element(By.XPATH, "..")
        superadminID_input = parent_div.find_element("id" , "superadminID")
        delete_button = parent_div.find_element("css selector", 'button[type="submit"]')
        driver.execute_script("arguments[0].scrollIntoView();", parent_div)  
        
        superadminID_input.send_keys(superadminID)
        time.sleep(1)
        delete_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/deleteSuperAdmin")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)
        
        
        
def test_editSuperAdmin(adminID, email, mobile):
    test_login("superadmin", "superadmin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Admins")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin/manageadmins")
        )
        header_div = driver.find_element(By.XPATH, "//div[@class='card-header' and contains(text(), 'Edit Super Admin')]")
        parent_div = header_div.find_element(By.XPATH, "..")
        superadminID_input = parent_div.find_element("id" , "superadminID2")
        email_input = parent_div.find_element("id" , "newSuperAdminEmail")
        mobile_input = parent_div.find_element("id" , "newSuperAdminMobile")
        add_button = parent_div.find_element("css selector", 'button[type="submit"]')
        driver.execute_script("arguments[0].scrollIntoView();", parent_div)  
        
        superadminID_input.send_keys(adminID)
        email_input.send_keys(email)
        mobile_input.send_keys(mobile)
        time.sleep(1)
        add_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/editSuperAdmin")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)
        
        
        
def test_addProject(name, description):
    test_login("superadmin", "superadmin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Projects/Services")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin/manageprojectsandservices")
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
            EC.url_to_be("http://127.0.0.1:8000/addProject")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)


def test_deleteProject(projID):
    test_login("superadmin", "superadmin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Projects/Services")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin/manageprojectsandservices")
        )
        header_div = driver.find_element(By.XPATH, "//div[@class='card-header' and contains(text(), 'Delete Project')]")
        parent_div = header_div.find_element(By.XPATH, "..")
        projID_input = parent_div.find_element("id" , "projID")
        delete_button = parent_div.find_element("css selector", 'button[type="submit"]')
        driver.execute_script("arguments[0].scrollIntoView();", header_div)  
        
        projID_input.send_keys(projID)
        time.sleep(1)
        delete_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/deleteProject")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)

def test_editProject(projID, name, description):
    test_login("superadmin", "superadmin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Projects/Services")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin/manageprojectsandservices")
        )
        header_div = driver.find_element(By.XPATH, "//div[@class='card-header' and contains(text(), 'Edit Project')]")
        parent_div = header_div.find_element(By.XPATH, "..")
        projID_input = parent_div.find_element("id" , "projID2")
        name_input = parent_div.find_element("id" , "newName")
        description_input = parent_div.find_element("id" , "newDescription")
        edit_button = parent_div.find_element("css selector", 'button[type="submit"]')
        driver.execute_script("arguments[0].scrollIntoView();", parent_div)  
        
        projID_input.send_keys(projID)
        name_input.send_keys(name)
        description_input.send_keys(description)
        time.sleep(1)
        edit_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/editProject")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)
        
        
        
def test_approveBrief(briefID):
    test_login("superadmin", "superadmin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Briefs")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin/managebriefs")
        )
        header_div = driver.find_element(By.XPATH, "//div[@class='card-header' and contains(text(), 'Approve Brief')]")
        parent_div = header_div.find_element(By.XPATH, "..")
        briefID_input = parent_div.find_element("id" , "briefID")
        approve_button = parent_div.find_element("css selector", 'button[type="submit"]')
        
        briefID_input.send_keys(briefID)
        time.sleep(1)
        approve_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/approveBrief")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)
        
        
def test_denyBrief(briefID):
    test_login("superadmin", "superadmin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage Briefs")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin/managebriefs")
        )
        header_div = driver.find_element(By.XPATH, "//div[@class='card-header' and contains(text(), 'Deny Brief')]")
        parent_div = header_div.find_element(By.XPATH, "..")
        briefID_input = parent_div.find_element("id" , "briefID2")
        deny_button = parent_div.find_element("css selector", 'button[type="submit"]')
        
        briefID_input.send_keys(briefID)
        time.sleep(1)
        deny_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/denyBrief")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)
        
        
def test_addManager(email, name):
    test_login("superadmin", "superadmin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage AccountManagers")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin/manageaccountmanagers")
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
            EC.url_to_be("http://127.0.0.1:8000/addManager")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)



def test_deleteManager(email):
    test_login("superadmin", "superadmin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Manage AccountManagers")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin/manageaccountmanagers")
        )
        header_div = driver.find_element(By.XPATH, "//div[@class='card-header' and contains(text(), 'Delete Account Manager')]")
        parent_div = header_div.find_element(By.XPATH, "..")
        email_input = parent_div.find_element("id" , "email2")
        delete_button = parent_div.find_element("css selector", 'button[type="submit"]')
        driver.execute_script("arguments[0].scrollIntoView();", parent_div)  
        
        email_input.send_keys(email)
        time.sleep(1)
        delete_button.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/deleteManager")
        )
       
         
    except Exception as e:
        print("An error occurred:", e)


def test_signout():
    test_login("superadmin", "superadmin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "Sign Out")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000")
        )         
    except Exception as e:
        print("An error occurred:", e)
        
        
def test_viewFeedback():
    test_login("superadmin", "superadmin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "View Feedback")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin/viewfeedback")
        )         
    except Exception as e:
        print("An error occurred:", e)
        
        
def test_viewProblems():
    test_login("superadmin", "superadmin")
    try:
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin")
        )
        navbar_element = driver.find_element(By.LINK_TEXT, "View Problems")
        navbar_element.click()
        WebDriverWait(driver, 10).until(
            EC.url_to_be("http://127.0.0.1:8000/superadmin/viewproblems")
        )         
    except Exception as e:
        print("An error occurred:", e)

######################### TEST RUNS ##################################

#test_login("superadmin", "superadmin")

#test_addUser("slimjim", "Slim123", "slim@gmail.com")

#test_viewUser("18")

#test_deleteUser("17")



#test_assignManager("15", "ahmed@gmail.com")



#test_addAdmin("mbappe", "mbappe123", "mbappe@gmail.com", "012301023")

#test_deleteAdmin("8")

#test_editAdmin("7", "salah@gmail.com", "000000000000")

#test_addSuperAdmin("supermbappe", "super123", "supermbappe@gmail.com", "111111111111")

#test_deleteSuperAdmin("3")

#test_editSuperAdmin("1", "super@gmail.com", "00000000000")

#test_addProject("new project", "new project description")

#test_deleteProject("13")

#test_editProject("13", "edited name", "edited description")

#test_approveBrief("11")

#test_denyBrief("11")

#test_addManager("newmanager@gmail.com", "new man")

#test_deleteManager("newmanager@gmail.com")

#test_viewFeedback()

#test_viewProblems()

#test_signout()