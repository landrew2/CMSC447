# Advisor Documentation
---

### Structure:

* Registration Page
* Login Page
* Logout Page
* Advising (dashboard)
* Edit Profile Page
* Controls Page (turn off future advising)
* Utils
* Third Party Libraries

#### Registration Page
---
Let's the user register as an advisor. Currently anyone can register as an advisor so it's recommended that a user

#####registration.php
Holds html information for registering a new user, as well as redirecting users if they have already registered
##### process.php
Uses queries.php to process a users registration. simple POST processing file for the advisor registration form. Only takes in POST requests.

#### Login Page
---
Let's the user login to their account. Perform various errors to the user using URL encoded error messages. Also has links to registration page should user require.

##### login.php
Holds html information for logging users, as well as dynamic error formats to see show users errors
##### process.php
Uses queries.php to process a users registration. simple POST processing file for the advisor registration form. Only takes in POST requests.


#### Logout Page
---
#####logout.html
A confirmation page that lets the user logout of his current active session by deleting all of the session variables in php. If the user says no to the logout then the user is redirected back to advisor dashboard

##### logout.php
Processes user logout deleting his current active session and redirecting that user to the login page. 

#### Advisor Management Page (Big Kahuna)
---
Let's the advisor see the appointments they currently have in a calendar UI using bootstrap-calendar, an open-source calendar. 

#####advising.php
Holding the calendar, modals as well as creating an appointment. Various components are brought through the website.


#####createAppointment.php
POST Request Only
processes logic to generate a new appointment based on information given in advising.php
#####deleteAppointment.php
POST Request Only
deletes an appointment given
#####feedEvents.php
used for AJAX call inside of calendar.js
bootstrap-calendar.js requires this as a part of their schematics.

#####getStudentInfo.php
POST Request Only
a GET request that obtains student information based on student ID. 

#### Edit Profile Information Page
---
Let's the advisor edit all of his profile information, including his password.
#####editProfile.php
Has form that lets user edit their information and update it with whatever information they wish to place. 

#####updateAdvisorProfile.php
Processes information based on submission of user to DB 



#### Controls Page
---
Let's the advisor select whether or not to turn off advising appointments so that users can't login and use the advising site.

#####controls.php
Holds HTML for confirming/declining the appointment for registering on a website.

#####switch.php
Processes logic to turn off the student advisor login page. Edits the table such that it turns off the website.



#### Utils
---

##### dbconfig.php
Has recallable function that manages connection to remote DB. Easily editable

##### queries.php
Holds various functions that all run queries onto the DB. Goal was to orientate all queries within one folder/file to separate complexity.


#### Third Party Libraries:
* Bootstrap - front-end framework for fast designing
* JQuery - animations for frontend as well as Ajax calls to get information
* Bootstrap Calendar - UI for making pristine and elegant calendars 
* Moment - for managing time and dates of meetings 
* Underscore - templating engine and various handy JS functions
