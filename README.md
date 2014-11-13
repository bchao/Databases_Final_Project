In order to view webpage, go to 
http://thnbgr.com/db/main_login.php

Assumptions

An assumption in our matching algorithm is that we have a limited number of people using our product. While the algorithm will work with a large number of users, the algorithm may run slowly due to the number of loops.

Platform

We are using PHP and a mySQL database to run our application. Our PHP files are being hosted on a server which is able to connect to our database and run queries to change it. Currently, we have a minimal working version of our application up and running on the server. Users are able to create an account, log in, and create requests for topics. We also have our matching algorithm finished which will eventually be running with a cron job on the server every few hours to update the Meetings tables in the database and update the Requests table as well. This will then invoke a script which will send out emails to the corresponding group members based on the rows in the Meetings table.

Source Code

To run our production dataset and the matching algorithm, load createStudyGroups.sql, addStartingData.sql, and TEST-PRODUCTION.SQL in a mySQL database. We ran into issues running mySQL in the course VM so we were not able to generate a TEST-PRODUCTION.OUT file. However, we did confirm on our server that the test SQL statements do in fact alter the database as expected. The PHP files for our website are included in the webProject directory. The website can be viewed at www.thnbgr.com/db/<file_name> for any of the PHP files contained in the directory. 