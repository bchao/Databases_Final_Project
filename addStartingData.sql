INSERT INTO Topic VALUES
  (1,'Compsci 316 final Preparation', 'Studying for the Compsci316 final.'),
  (2,'Econ 101 Homework', 'Working on homework for Econ 101.'),
  (3,'Studying for the MCAT', NULL);

INSERT INTO Person VALUES
  (1,'Leonard','Walworth','lenny@gmail.com'),
  (2,'Esmond','Trimble','etrimble@yahoo.com'),
  (3,'Frederick','Muscell','muscleman23@earthlink.net'),
  (4,'Clint','Brownley','cbrownley@gmail.com'),
  (5,'Joshua','Polin','josh_polin@yahoo.com'),
  (6,'Georgiana','Clubberill','gclubs@gmail.com'),
  (7,'Ettie','Hilton','hettie@earthlink.net'),
  (8,'Lenora','Dooly','lenora87@gmail.com'),
  (9,'Bob','Atkinson','batks@gmail.com'),
  (10,'Joe','Lee','jayleez@gmail.com'),
  (11,'Jill','Hall','jillyhall@gmail.com'),
  (12,'Noah','Robinson','nrobby@gmail.com'),
  (13,'Jacob','Lewis','jlewis@gmail.com'),
  (14,'Will','Clark','wilck@gmail.com'),
  (15,'Abigail','Jones','abj84@gmail.com'),
  (16,'Beth','Moore','bethmoore53@gmail.com'),
  (17,'Mia','Lopez','miamia@gmail.com'),
  (18,'Margery','Johnson','margjohnson64@gmail.com'),
  (19,'Mason','Davis','masondavis38@gmail.com'),
  (20,'William','White','willywhites38@gmail.com'),
  (21,'Emma','Jackson','jackem@gmail.com'),
  (22,'Olivia','Garcia','ogarcia@gmail.com'),
  (23,'Daniel','Martin','dmartin@gmail.com'),
  (24,'Margery','Thompson','margthomp@gmail.com'),
  (26,'Alex','Anderson','doubleA@gmail.com'),
  (27,'Alexander','Hernandez','alexandez@gmail.com'),
  (28,'Emily','Thomas','ethomas@gmail.com'),
  (29,'Sophia','Smith','ssmith35@gmail.com'),
  (30,'Madison','Brown','maddybrown10@gmail.com'),
  (31,'Kate','Horahan','katie105@gmail.com');

INSERT INTO Request VALUES
  (1,1,1,'2014-10-11 10:23:54','closed'),
  (2,2,1,'2014-10-11 16:27:34','closed'),
  (3,3,1,'2014-10-15 09:13:11','closed'),
  (4,4,2,'2014-10-24 11:30:01','closed'),
  (5,5,2,'2014-10-13 15:09:08','closed'),
  (6,6,3,'2014-10-05 15:00:00','open');

INSERT INTO TimeSlot VALUES
  (1,'2014-11-01','morning'),
  (2,'2014-11-01','afternoon'),
  (3,'2014-11-01','evening'),
  (4,'2014-11-01','night'),
  (5,'2014-11-02','morning'),
  (6,'2014-11-02','afternoon'),
  (7,'2014-11-02','evening'),
  (8,'2014-11-02','night');

INSERT INTO RequestTimes VALUES
  (1,1),
  (1,2),
  (1,3),
  (2,2),
  (2,3),
  (2,7),
  (3,3),
  (3,5),
  (4,6),
  (4,7),
  (4,8),
  (5,4),
  (5,5),
  (5,6),
  (6,6),
  (6,7),
  (6,8);

INSERT INTO Meeting VALUES
  (1,1,3),
  (2,2,6);

INSERT INTO PersonAttendingMeeting VALUES
  (1,1),
  (2,1),
  (3,1),
  (4,2),
  (5,2);
