-- SQL commands used to create all the necessary tables for project 1

-- Movie(id, title, year, rating, company)
CREATE TABLE Movie
(
  id INT NOT NULL,
  title VARCHAR(100) NOT NULL,  -- Every movie must have a title
  year INT NOT NULL,            -- Every movie must have release year
  rating VARCHAR(10),
  company VARCHAR(50) NOT NULL, -- Company is necessary
  PRIMARY KEY(id)
) ENGINE=INNODB;

-- Actor(id, last, first, sex, dob, dod)
CREATE TABLE Actor
(
  id INT NOT NULL,
  last VARCHAR(20) NOT NULL,    -- Every actor must have a last name
  first VARCHAR(20) NOT NULL,   -- Every actor must have a first name
  sex VARCHAR(6) NOT NULL,      -- Sex must be specified for every human being
  dob DATE NOT NULL,            -- Every person should have DOB
  dod DATE DEFAULT NULL,
  PRIMARY KEY(id),
  CHECK (sex IN ('Male', 'Female')),
  CHECK (dod IS NULL OR dob < dod)
) ENGINE=INNODB;

-- Director(id, last, first, dob, dod)
CREATE TABLE Director
(
  id INT NOT NULL,
  last VARCHAR(20) NOT NULL,    -- Every actor must have a last name
  first VARCHAR(20) NOT NULL,   -- Every actor must have a first name
  dob DATE NOT NULL,            -- Every person should have DOB
  dod DATE DEFAULT NULL,
  PRIMARY KEY(id),
  CHECK (dod IS NULL OR dob < dod)
) ENGINE=INNODB;

-- MovieGenre(mid, genre)
CREATE TABLE MovieGenre
(
  mid INT NOT NULL,
  genre VARCHAR(20) NOT NULL,
  FOREIGN KEY (mid) REFERENCES Movie(id),
  UNIQUE(mid, genre)
) ENGINE=INNODB;

-- MovieDirector(mid, did)
CREATE TABLE MovieDirector
(
  mid INT NOT NULL,
  did INT NOT NULL,
  FOREIGN KEY (mid) REFERENCES Movie(id),
  FOREIGN KEY (did) REFERENCES Director(id),
  UNIQUE(mid, did)
) ENGINE=INNODB;

-- MovieActor(mid, aid, role)
CREATE TABLE MovieActor
(
  mid INT NOT NULL,
  aid INT NOT NULL,
  role VARCHAR(50),
  FOREIGN KEY (mid) REFERENCES Movie(id),
  FOREIGN KEY (aid) REFERENCES Actor(id),
  UNIQUE(mid, aid, role)
) ENGINE=INNODB;

-- Review(name, time, mid, rating, comment)
CREATE TABLE Review
(
  name VARCHAR(20),
  time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  mid INT NOT NULL,
  rating INT,
  comment VARCHAR(500),
  FOREIGN KEY (mid) REFERENCES Movie(id),
  CHECK (rating IS NOT NULL OR comment IS NOT NULL)
) ENGINE=INNODB;

-- MaxPersonID(id)
CREATE TABLE MaxPersonID
(
  id INT NOT NULL
) ENGINE=INNODB;

-- MaxMovieID(id)
CREATE TABLE MaxMovieID
(
  id INT NOT NULL
) ENGINE=INNODB;

