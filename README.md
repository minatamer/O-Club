# O-Club
O-projects internship task <br>
To run: download php laravel & xampp control panel for the mysql database server and apache server

run commands: <br>
step 1 : go to terminal and navigate to the 'myApp' folder and type 'composer install'
<br>
step 2: create an .env file using the .env-example and change its configurations 
<br>
step 3: php artisan migrate
<br>
step 4: php artisan db:seed
<br>
(before step 3 make sure to run your xampp control panel as admin) <br>
step 4: php artisan serve
<br>

Note about the Selenium tests
<br>
1.make sure you have python downloaded on your device <br>
2.in command prompt: pip install selenium <br>
3.download chromedriver that is the same as your chrome version from : https://googlechromelabs.github.io/chrome-for-testing/ OR https://chromedriver.chromium.org/downloads <br>
4.either place the chromedriver.exe in the selenium test folder OR you will have to write a code that links with the chromedriver path using: 
PATH = "your\path\to\chromedriver.exe"
<br>
driver = webdriver.Chrome(PATH)
