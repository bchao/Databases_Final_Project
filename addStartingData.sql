INSERT INTO StudyGroup VALUES
  (1,'Compsci316 Study Group', 'open'),
  (2,'Econ101 Homework Group', 'private'),
  (3,'MCAT Study Group', 'open');

INSERT INTO Person VALUES
  (1,'Leonard','Walworth','lenny@gmail.com'),
  (2,'Esmond','Trimble','etrimble@yahoo.com'),
  (3,'Frederick','Muscell','muscleman23@earthlink.net'),
  (4,'Clint','Brownley','cbrownley@gmail.com'),
  (5,'Joshua','Polin','josh_polin@yahoo.com'),
  (6,'Georgiana','Clubberill','gclubs@gmail.com'),
  (7,'Ettie','Hilton','hettie@earthlink.net'),
  (8,'Lenora','Dooly','lenora87@gmail.com'),
  (9,'Margery','Atkinson','matkins@yahoo.com'),
  (10,'Kate','Horahan','katie105@gmail.com');

INSERT INTO PersonAdminOfGroup VALUES
  (1,1),
  (1,2),
  (6,2),
  (9,3);

INSERT INTO PersonMemberOfGroup VALUES
  (1,1),
  (1,2),
  (6,2),
  (9,3),
  (2,2),
  (7,2),
  (3,1),
  (4,1),
  (8,3),
  (10,3),
  (5,3);

INSERT INTO GroupJoinRequest VALUES
  (1,2,2,'approved','2014-10-11 10:23:54','2014-10-11 16:27:34','1',NULL),
  (2,8,2,'denied','2014-09-15 09:13:11','2014-09-24 11:30:01','6','Please please please let me join this group!'),
  (3,7,2,'approved','2014-10-13 15:09:08','2014-10-15 18:06:56','6',NULL);

INSERT INTO Event VALUES
  (1,NULL,NULL,'MCAT Study Session','We should get together and study for the MCAT!  Reply to my post with times that would work for you!'),
  (2,'2014-11-05 15:00:00','2014-11-05 18:00:00','Studying for Econ101 exam','Hey guys studying for the Econ101 exam will be in Social Sciences 105.  See you there!');

INSERT INTO PersonAdminOfEvent VALUES
  (9,1),
  (1,2),
  (6,2);

INSERT INTO Thread VALUES
  (1,'Deciding time for MCAT Study Session'),
  (2,'What is the best way to study for Compsci316?');


INSERT INTO Post VALUES
  (1,1,9,'When should we meet for the MCAT Study Session?  Any of Tuesday, Wednesday, or Friday next week would work for me.','2014-10-13 10:53:11'),
  (2,1,8,'See title.','2014-10-14 18:00:05'),
  (1,2,8,'Tuesday or Wednesday would work for me!','2014-10-14 15:56:00'),
  (1,3,10,'None of those days really work for me, sorry!','2014-10-14 18:54:11'),
  (1,4,5,'Wednesday would be best for me, but I could also do Tuesday','2014-10-15 09:11:53'),
  


INSERT INTO PersonAttendingEvent VALUES
  (9,1,'attending'),
  (1,2,'attending'),
  (6,2,'attending'),
  (3,1,'attending'),
  (5,2,'attending'),
  (3,1,'not_attending'),
  (5,1,'attending');

INSERT INTO ThreadTaggedWithGroup VALUES
  (1,3),
  (2,2);

INSERT INTO ThreadTaggedWithEvent VALUES
  (1,1);

INSERT INTO EventTaggedWithGroup VALUES
  (1,3),
  (2,2);
  
