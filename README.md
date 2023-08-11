# O-Club
<h3> O-projects internship task </h1> <br>
To run: download composer from https://getcomposer.org/download/ & xampp control panel for the mysql database server and apache server from https://www.apachefriends.org/
<br>

run commands: <br>
step 1 : go to terminal and navigate to the 'myApp' folder and type 'composer install'
<br>
step 2: create an .env file using the .env-example and change its configurations (you will need a gmail account and set it up in the .env file for the changePassword functionality to work) <br>
step 3 : php artisan key:generate
<br>
step 4: php artisan migrate
<br>
step 5: php artisan db:seed
<br>
(before step 3 make sure to run your xampp control panel as admin) <br>
step 6: php artisan serve
<br>
<br> 
Note about the website
<br>
To start, you will either need to signup for a user account, or use the already made staple accounts for admin and superadmin that will be in your database once you do step 5. 


Notes about how to run the Selenium tests
<br>
1.make sure you have python downloaded on your device from https://www.python.org/downloads/ to be able to use pip commands (make sure when you install python to check the setting "add python to PATH")<br>
2.open command prompt and type: pip install selenium <br>
3.download chromedriver that is the same as your chrome version from : https://googlechromelabs.github.io/chrome-for-testing/ OR https://chromedriver.chromium.org/downloads <br>
4.either place the chromedriver.exe in the selenium test folder OR you will have to write a code that links with the chromedriver path using: 
PATH = "your\path\to\chromedriver.exe"
<br>
driver = webdriver.Chrome(PATH)
<br>
<br>
There are 3 seperate test files for each user type in the website. Every website functionality has its own python function that you will need to run to let selenium simulate it. <br>
At the bottom of each python file I wrote and commented all the functions that you can execute.
