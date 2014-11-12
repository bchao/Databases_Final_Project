CREATE TABLE Topic(
	topid INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL,
	description VARCHAR(300)
);

CREATE TABLE Person(
	pid INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	first_name VARCHAR(20) NOT NULL,
	last_name VARCHAR(20) NOT NULL,
	password VARCHAR(20) NOT NULL default '',
	email VARCHAR(30) NOT NULL
);

CREATE TABLE Request(
	rid INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	pid INTEGER NOT NULL REFERENCES Person(pid),
	topid INTEGER NOT NULL REFERENCES Topic(topid),
	large_group_ok BOOLEAN NOT NULL,
	medium_group_ok BOOLEAN NOT NULL,
	small_group_ok BOOLEAN NOT NULL,
	time VARCHAR(20) NOT NULL,
	status VARCHAR(9) NOT NULL
		CHECK(status = 'open' OR status = 'closed'),
	KEY(pid,topid)
);
	
CREATE TABLE TimeSlot(
	tsid INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	time_slot_date DATE NOT NULL,
	time_slot_time VARCHAR(9)
		CHECK(time_slot_time = 'morning' OR time_slot_time = 'afternoon' OR time_slot_time = 'evening' OR time_slot_time = 'night')
);

CREATE TABLE RequestTimes(
	rid INTEGER NOT NULL REFERENCES Request(rid),
	tsid INTEGER NOT NULL REFERENCES TimeSlot(tsid),
	PRIMARY KEY(rid,tsid)
);

CREATE TABLE Meeting(
	mid INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	topic INTEGER NOT NULL REFERENCES Topic(topid),
	meeting_time INTEGER NOT NULL REFERENCES TimeSlot(tsid)
);

CREATE TABLE PersonAttendingMeeting(
	pid INTEGER NOT NULL REFERENCES Person(pid),
	mid INTEGER NOT NULL REFERENCES Meeting(mid),
	PRIMARY KEY(pid,mid)
);


CREATE VIEW LargeRequestedTimeSlots AS
SELECT topid, tsid, COUNT(*) AS num_people
FROM Request, RequestTimes
WHERE (Request.rid = RequestTimes.rid AND large_group_ok = TRUE)
GROUP BY (topid, tsid)
ORDER BY num_people DESC;

CREATE VIEW MediumRequestedTimeSlots AS
SELECT topid, tsid, COUNT(*) AS num_people
FROM Request, RequestTimes
WHERE (Request.rid = RequestTimes.rid AND medium_group_ok = TRUE)
GROUP BY (topid, tsid)
ORDER BY num_people DESC;

CREATE VIEW SmallRequestedTimeSlots AS
SELECT topid, tsid, COUNT(*) AS num_people
FROM Request, RequestTimes
WHERE (Request.rid = RequestTimes.rid AND small_group_ok = TRUE)
GROUP BY (topid, tsid)
ORDER BY num_people DESC;
