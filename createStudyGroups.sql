CREATE TABLE StudyGroup(
	gid INTEGER NOT NULL PRIMARY KEY,
	name VARCHAR(50) NOT NULL,
	accessibility VARCHAR(7) NOT NULL
		CHECK(accessibility = 'private' OR accessibility = 'open')
);

CREATE TABLE Person(
	pid INTEGER NOT NULL PRIMARY KEY,
	first_name VARCHAR(20) NOT NULL,
	last_name VARCHAR(20) NOT NULL,
	email VARCHAR(30) NOT NULL
);

CREATE TABLE PersonAdminOfGroup(
	pid INTEGER NOT NULL REFERENCES Person(pid),
	gid INTEGER NOT NULL REFERENCES StudyGroup(gid),
	PRIMARY KEY(pid,gid)
);

CREATE TABLE GroupJoinRequest(
	rid INTEGER NOT NULL PRIMARY KEY,
	requesting_person_id INTEGER NOT NULL REFERENCES Person(pid),
	requested_group_id INTEGER NOT NULL REFERENCES StudyGroup(gid),
	status VARCHAR(8) NOT NULL
		CHECK(status = 'new' OR status = 'approved' OR status = 'denied'),
	time_sent TIMESTAMP NOT NULL,
	time_answered TIMESTAMP,
	answering_admin INTEGER REFERENCES Person(pid)
		CHECK(EXISTS(SELECT * FROM PersonAdminOfGroup WHERE pid = answering_admin AND gid = requested_group_id)),
	message VARCHAR(300),
	CHECK((status = 'new' AND time_answered IS NULL) OR (status <> 'new' AND time_answered IS NOT NULL))
);

CREATE TABLE Event(
	eid INTEGER NOT NULL PRIMARY KEY,
	start_time TIMESTAMP,
	end_time TIMESTAMP,
	name VARCHAR(50) NOT NULL,
	description VARCHAR(300)
);

CREATE TABLE PersonAdminOfEvent(
	pid INTEGER NOT NULL REFERENCES Person(pid),
	eid INTEGER NOT NULL REFERENCES Event(eid),
	PRIMARY KEY(pid,eid),
);

CREATE TABLE Thread(
	tid INTEGER NOT NULL PRIMARY KEY,
	title VARCHAR(100) NOT NULL	
);

CREATE TABLE Post(
	tid INTEGER NOT NULL REFERENCES Thread(tid),
	post_number INTEGER NOT NULL,
	poster INTEGER NOT NULL REFERENCES Person(pid),
	post_text VARCHAR(500) NOT NULL,
	time_posted TIMESTAMP NOT NULL,
	PRIMARY KEY(tid, post_number)
);

CREATE TABLE PersonAttendingEvent(
	pid INTEGER NOT NULL REFERENCES Person(pid),
	eid INTEGER NOT NULL REFERENCES Event(eid),
	status VARCHAR(13) NOT NULL
		Check(status = 'attending' OR status = 'not_attending'),
	PRIMARY KEY(pid,eid)
);

CREATE TABLE ThreadTaggedWithGroup(
	tid INTEGER NOT NULL REFERENCES Thread(tid),
	gid INTEGER NOT NULL REFERENCES StudyGroup(gid),
	PRIMARY KEY(tid,gid)
);

CREATE TABLE ThreadTaggedWithEvent(
	tid INTEGER NOT NULL REFERENCES Thread(tid),
	eid INTEGER NOT NULL REFERences Event(eid),
	PRIMARY KEY(tid,eid)
);

CREATE TABLE EventTaggedWithGroup(
	eid INTEGER NOT NULL REFERENCES Event(eid),
	gid INTEGER NOT NULL REFERENCES StudyGroup(gid),
	PRIMARY KEY(eid,gid)
);

