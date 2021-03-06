--Find scheduled sessions for topic 'Studying for the MCAT'
SELECT * FROM Meeting WHERE topic = (SELECT tid FROM Topic WHERE name = 'Studying for the MCAT');

--List of names/emails of everyone attending meeting with mid = 1
SELECT first_name, last_name, email FROM Person WHERE pid IN (SELECT pid FROM PersonAttendingMeeting WHERE mid = 1);

--List all scheduled sessions with userID '6'
SELECT * FROM Meeting WHERE id IN (SELECT mid from PersonAttendingMeeting WHERE pid = 6)

--List all requests with same topic and times
