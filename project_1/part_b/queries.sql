-- Contains SELECT statements that query the dataset

SELECT * FROM tbl ... WHERE 'Die Another Day';

-- Give me the names of all the actors in the movie 'Die Another Day'. Please also make sure actor names are in this format:  <firstname> <lastname>   (seperated by single space)


-- There might be a more efficient way to do this.....
SELECT COUNT(*) FROM (SELECT aid, COUNT(mid) AS numMovies FROM MovieActor GROUP BY aid) AS MoviesPerActor WHERE MoviesPerActor.numMovies > 1;

