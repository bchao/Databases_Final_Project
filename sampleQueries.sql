--Find scheduled sessions for topic 'Studying for the MCAT'
SELECT * FROM Meeting WHERE topic = (SELECT tid FROM Topic WHERE name = 'Studying for the MCAT');

--List of names/emails of everyone in group 'Econ 101 Homework'



--List all scheduled sessions for user 'Leonard Walworth'