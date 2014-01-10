-- test for primary key violation in Movie table
INSERT INTO Movie VALUES (272, 'Einstein', 1879, '10', 'homemade');
-- Produces: ERROR 1062 (23000): Duplicate entry '272' for key 1

-- test for primary key violation in Actor table
INSERT INTO Actor VALUES (1, 'Einstein', 'Albert', 'Male', '1879-03-14', '1955-04-18');
-- Produces: ERROR 1062 (23000): Duplicate entry '1' for key 1

-- test for primary key violation in Director table
INSERT INTO Director VALUES (37146, 'Einstein', 'Albert', '1879-03-14', '1955-04-18');
-- Produces: ERROR 1062 (23000): Duplicate entry '37146' for key 1

-- test for foreign key violation in MovieGenre table
INSERT INTO MovieGenre VALUES (-1, 'fiction');
-- Produces: ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143/MovieGenre`, CONSTRAINT `MovieGenre_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

-- test for foreign key violations in MovieDirector table
INSERT INTO MovieDirector VALUES (-1, 37146);
-- Produces: ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143/MovieDirector`, CONSTRAINT `MovieDirector_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))
INSERT INTO MovieDirector VALUES (272, -1);
-- Produces: ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143/MovieDirector`, CONSTRAINT `MovieDirector_ibfk_2` FOREIGN KEY (`did`) REFERENCES `Director` (`id`))

-- test for foreign key violations in MovieActor table
INSERT INTO MovieActor VALUES (-1, 1, 'all');
-- Produces: ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143/MovieActor`, CONSTRAINT `MovieActor_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))
INSERT INTO MovieActor VALUES (272, -1, 'all');
-- Produces: ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143/MovieActor`, CONSTRAINT `MovieActor_ibfk_2` FOREIGN KEY (`aid`) REFERENCES `Actor` (`id`))

-- test for foreign key violation in Review table
INSERT INTO Review VALUES ('Einstein', '1955-04-18 11:00:00', -1, 10, 'Best movie ever!');
-- Produces: ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143/Review`, CONSTRAINT `Review_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

-- test for CHECK violations in Actor table
INSERT INTO Actor VALUES (123456, 'Einstein', 'Albert', 'NA', '1879-03-14', '1955-04-18');
-- Will Produce: sex check failure
INSERT INTO Actor VALUES (123456, 'Einstein', 'Albert', 'Male', '1879-03-14', '1755-04-18');
-- Will Produce: date check failure

-- test for CHECK violation in Director table
INSERT INTO Director VALUES (888888, 'Einstein', 'Albert', '1879-03-14', '1755-04-18');
-- Will Produce: date check failure

-- test for CHECK violation in Review table
INSERT INTO Review VALUES ('Einstein', '1955-04-18 11:00:00', 272, NULL, NULL);
-- Will Produce: value check failure

