-- SQL commands used to create all the necessary tables for project 1

-- Movie(id, title, year, rating, company)
CREATE TABLE Movie
(
  id INT,
  title VARCHAR(100),
  year INT,
  rating VARCHAR(10),
  company VARCHAR(50)
);

-- Actor(id, last, first, sex, dob, dod)
CREATE TABLE Actor
(
  id INT,
  last VARCHAR(20),
  first VARCHAR(20),
  sex VARCHAR(6),
  dob DATE,
  dod DATE
);

-- Director(id, last, first, dob, dod)
CREATE TABLE Director
(
  id INT,
  last VARCHAR(20),
  first VARCHAR(20),
  dob DATE,
  dod DATE
);

-- MovieGenre(mid, genre)
CREATE TABLE MovieGenre
(
  mid INT,
  genre VARCHAR(20)
);

-- MovieDirector(mid, did)
CREATE TABLE MovieDirector
(
  mid INT,
  did INT
);

-- MovieActor(mid, aid, role)
CREATE TABLE MovieActor
(
  mid INT,
  aid INT,
  role VARCHAR(50)
);

-- Review(name, time, mid, rating, comment)
CREATE TABLE Review
(
  name VARCHAR(20),
  time TIMESTAMP,
  mid INT,
  rating INT,
  comment VARCHAR(500)
);

-- MaxPersonID(id)
CREATE TABLE MaxPersonID
(
  id INT
);

-- MaxMovieID(id)
CREATE TABLE MaxMovieID
(
  id INT
);

