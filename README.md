Members and time spent:
Peter Yom: 40 hours
David Hemminger: 40 hours
Brandon Chao: 40 hours


In order to view webpage, go to 
http://thnbgr.com/db/index.php

Structure of the code

A more detailed description is contained in our project report, but broadly speaking important files are as follows.  The user accesses the website at index.php and registers at register.php.  Once a user is logged in, the Create, Topics, Scheduled Meetings, Pending Meetings, and Past Meetings tabs are all located in hub.php.  The matching algorithm is run in matchRequests.php.

Platform

We are using PHP and a mySQL database to run our application. Our PHP files are being hosted on a server which is able to connect to our database and run queries to change it.  We're also using Bootstrap for CSS and JS functionalities.

How to set up

To run our production dataset and the matching algorithm, execute createStudyGroups.sql and addTimeSlots.php in a mySQL database.  One can optionally also run addStartingData.sql to add some data for testing purposes.
