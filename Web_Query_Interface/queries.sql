-- Contains SELECT statements that query the dataset

-------------
-- QUERY 1 --
-------------

-- Returns first and last names of all actors from the movie 'Die Another Day'.

-- Here, first we joined Movie and Actor tables using an interconnecting
--   MovieActor table, and then filtered out all the entries that had
--   'Die Another Day' as a title. Finally, we used CONCAT_WS to concatenate
--   actors' first and last names.

SELECT CONCAT_WS(' ', Actor.first, Actor.last) AS Name
FROM Movie
INNER JOIN MovieActor ON Movie.id=MovieActor.mid
INNER JOIN Actor ON MovieActor.aid=Actor.id 
WHERE Movie.title='Die Another Day'
ORDER BY Actor.first;


-------------
-- QUERY 2 --
-------------

-- Returns the count of all the actors who acted in more than one movie.

-- We grouped actors by their ids and counted how many movies each of them
--   acted in. Then, out of this data all the actors with more than 1 movies
--   were counted

SELECT COUNT(*) 
FROM (
  SELECT aid, COUNT(mid) AS numMovies
  FROM MovieActor
  GROUP BY aid
) AS MoviesPerActor 
WHERE MoviesPerActor.numMovies > 1;


-------------
-- QUERY 3 --
-------------

-- Returns a sorted list of all actors that acted in movies directed by
--   Steven Spielberg as well as titles and years of those movies.

-- To do this, three main tables (Director, Movie, and Actor) were joined
--   together using MovieDirector and MovieActor interconnecting tables. Then
--   all the entries with Steven Spielberg as director's name were chosen and
--   ordered by actors' first names. Also, CONCAT_WS was used to concatenate
--   actors' first and last names.

SELECT CONCAT_WS(' ', Actor.first, Actor.last) AS Actors,
  Movie.title AS Title, Movie.year AS Year
FROM Director
INNER JOIN MovieDirector ON Director.id=MovieDirector.did
INNER JOIN Movie ON MovieDirector.mid=Movie.id
INNER JOIN MovieActor ON MovieDirector.mid=MovieActor.mid
INNER JOIN Actor ON MovieActor.aid=Actor.id
WHERE Director.last='Spielberg' and Director.first='Steven'
ORDER BY Actor.first;

