#This code executes the SQL statements that matchRequests.php will make when run with our current starting data set.

INSERT INTO Meeting (topic,meeting_time) VALUES (3,6);

INSERT INTO PersonAttendingMeeting VALUES (6, 1);
UPDATE Request SET status = 'closed' WHERE (pid = 6 AND topid = 3);
INSERT INTO PersonAttendingMeeting VALUES (7, 1);
UPDATE Request SET status = 'closed' WHERE (pid = 7 AND topid = 3);
INSERT INTO PersonAttendingMeeting VALUES (8, 1);
UPDATE Request SET status = 'closed' WHERE (pid = 8 AND topid = 3);
INSERT INTO PersonAttendingMeeting VALUES (9, 1);
UPDATE Request SET status = 'closed' WHERE (pid = 9 AND topid = 3);
INSERT INTO PersonAttendingMeeting VALUES (10, 1);
UPDATE Request SET status = 'closed' WHERE (pid = 10 AND topid = 3);
INSERT INTO PersonAttendingMeeting VALUES (11, 1);
UPDATE Request SET status = 'closed' WHERE (pid = 11 AND topid = 3);
INSERT INTO PersonAttendingMeeting VALUES (12, 1);
UPDATE Request SET status = 'closed' WHERE (pid = 12 AND topid = 3);
INSERT INTO PersonAttendingMeeting VALUES (13, 1);
UPDATE Request SET status = 'closed' WHERE (pid = 13 AND topid = 3);
INSERT INTO PersonAttendingMeeting VALUES (14, 1);
UPDATE Request SET status = 'closed' WHERE (pid = 14 AND topid = 3);
INSERT INTO PersonAttendingMeeting VALUES (15, 1);
UPDATE Request SET status = 'closed' WHERE (pid = 15 AND topid = 3);
INSERT INTO PersonAttendingMeeting VALUES (16, 1);
UPDATE Request SET status = 'closed' WHERE (pid = 16 AND topid = 3);


INSERT INTO Meeting (topic,meeting_time) VALUES (3,9);

INSERT INTO PersonAttendingMeeting VALUES (17, 2);
UPDATE Request SET status = 'closed' WHERE (pid = 17 AND topid = 3);
INSERT INTO PersonAttendingMeeting VALUES (18, 2);
UPDATE Request SET status = 'closed' WHERE (pid = 18 AND topid = 3);
INSERT INTO PersonAttendingMeeting VALUES (19, 2);
UPDATE Request SET status = 'closed' WHERE (pid = 19 AND topid = 3);
INSERT INTO PersonAttendingMeeting VALUES (20, 2);
UPDATE Request SET status = 'closed' WHERE (pid = 20 AND topid = 3);
INSERT INTO PersonAttendingMeeting VALUES (21, 2);
UPDATE Request SET status = 'closed' WHERE (pid = 21 AND topid = 3);
INSERT INTO PersonAttendingMeeting VALUES (22, 2);
UPDATE Request SET status = 'closed' WHERE (pid = 22 AND topid = 3);


INSERT INTO Meeting (topic,meeting_time) VALUES (3,8);

INSERT INTO PersonAttendingMeeting VALUES (23, 3);
UPDATE Request SET status = 'closed' WHERE (pid = 23 AND topid = 3);
INSERT INTO PersonAttendingMeeting VALUES (24, 3);
UPDATE Request SET status = 'closed' WHERE (pid = 24 AND topid = 3);
INSERT INTO PersonAttendingMeeting VALUES (25, 3);
UPDATE Request SET status = 'closed' WHERE (pid = 25 AND topid = 3);
INSERT INTO PersonAttendingMeeting VALUES (26, 3);
UPDATE Request SET status = 'closed' WHERE (pid = 26 AND topid = 3);


INSERT INTO Meeting (topic,meeting_time) VALUES (3,3);

INSERT INTO PersonAttendingMeeting VALUES (27, 4);
UPDATE Request SET status = 'closed' WHERE (pid = 27 AND topid = 3);
INSERT INTO PersonAttendingMeeting VALUES (28, 4);
UPDATE Request SET status = 'closed' WHERE (pid = 28 AND topid = 3);
INSERT INTO PersonAttendingMeeting VALUES (29, 4);
UPDATE Request SET status = 'closed' WHERE (pid = 29 AND topid = 3);
INSERT INTO PersonAttendingMeeting VALUES (30, 4);
UPDATE Request SET status = 'closed' WHERE (pid = 30 AND topid = 3);
