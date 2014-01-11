<?php

  function dbConnect() {
    $err = array();

    $connection = mysql_connect("localhost", "cs143", "");
    if(!$connection) {
      $err[] = mysql_error();
    }

    if(!mysql_select_db("CS143", $connection)) {
      $err[] = mysql_error();
    }

    return array("connection" => $connection,
                 "err" => $err);
  }


  function dbQuery() {

  }


  function dbAddActorDirector() {

  }

  function dbAddMovie() {

  }

  function dbAddReview() {

  }

  function dbAddMovieActor() {

  }

  function dbAddMovieDirector() {

  }


  function dbGetMovie() {

  }

  function dbGetAllMovies() {

  }

  function dbGetGenre() {

  }

  function dbGetActor() {
    $query = "SELECT * FROM Actor WHERE id=$id";
  }

  function dbGetAllActors() {

  }

  function dbGetDirector($movieId) {
    $query = "SELECT first, last FROM MovieDirector md, Director d WHERE mid=$movieId and d.id=md.did";
  }

  function dbGetAllDirectors() {

  }


  function dbSearch() {

  }

?>

