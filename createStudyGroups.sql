CREATE TABLE Topic(
	tid INTEGER NOT NULL PRIMARY KEY,
	name VARCHAR(50) NOT NULL,
	description VARCHAR(300)
);

CREATE TABLE Person(
	pid INTEGER NOT NULL PRIMARY KEY,
	first_name VARCHAR(20) NOT NULL,
	last_name VARCHAR(20) NOT NULL,
	email VARCHAR(30) NOT NULL
);

CREATE TABLE Request(
	rid INTEGER NOT NULL PRIMARY KEY,
	pid INTEGER NOT NULL REFERENCES Person(pid),
	tid INTEGER NOT NULL REFERENCES Topic(tid),
	time TIMESTAMP NOT NULL,
	status VARCHAR(9) NOT NULL
		CHECK(status = 'matched' OR status = 'unmatched'),
	
CREATE TABLE TimeSlot(
	tid INTEGER NOT NULL PRIMARY KEY,
	time_slot_date DATE NOT NULL,
	time_slot_time VARCHAR(9)
		CHECK(time_slot_time = 'morning' OR time_slot_time = 'afternoon' OR time_slot_time = 'evening' OR time_slot_time = 'night')
);

CREATE TABLE RequestTimes(
	rid INTEGER NOT NULL REFERENCES Request(rid),
	tid INTEGER NOT NULL REFERENCES TimeSlot(tid),
	PRIMARY KEY(rid,tid)
);

CREATE TABLE Meeting(
	mid INTEGER NOT NULL PRIMARY KEY,
	topic INTEGER NOT NULL REFERENCES Topic(tid),
	meeting_time INTEGER NOT NULL REFERENCES TimeSlot(tid)
);

CREATE TABLE PersonAttendingMeeting(
	pid INTEGER NOT NULL REFERENCES Person(pid),
	mid INTEGER NOT NULL REFERENCES Meeting(mid),
	PRIMARY KEY(pid,gid)
);

