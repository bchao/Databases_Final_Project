In order to view webpage, go to 
http://thnbgr.com/db/index.php

In order to create the database, run:

dropdb studybuddies; createdb studybuddies; psql studybuddies -af createStudyGroups.sql

Then to populate the database with data, run:

psql studybuddies -af addStartingData.sql

Finally in order to run the test SQL queries, run:

psql studybuddies -af TEST-SAMPLE.SQL &> TEST-SAMPLE.OUT
