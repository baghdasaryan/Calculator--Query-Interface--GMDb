<?php

  function dbConnect() {
    $err = array();

    // Connect to MySQL
    $conn = mysql_connect("localhost", "cs143", "");
    if(!$conn) {
      $err[] = mysql_error();
    }

    // Select databse
    if(!mysql_select_db("CS143", $conn)) {
      $err[] = mysql_error();
    }

    return array("conn" => $conn,
                 "err" => $err);
  }

  function dbDisconnecct($conn) {
    if($conn) {
      mysql_close($conn);
    }
  }


  function dbRunQuery($query) {
    $connData = dbConnect();

    // Check connection
    if(!$connData["conn"]) {
      return $connData;
    }

    // Query the database
    $res = mysql_query($query, $connData["conn"]);
    if(!$res) {
      $connData["err"][] = mysql_error();
    }

    dbDisconnecct($connData["conn"]);

    // Return results
    return array("data" => $res,
                 "err" => $connData["err"]);
  }


  function dbAddActorDirector($input) {
    $identity = $input["identity"];
    $first = $input["first"];
    $last = $input["last"];
    $sex = $input["sex"];
    $dob = $input["dob"];
    $dod = $input["dod"];

    $query = "SELECT id FROM MaxPersonID";
    $qResult = dbRunQuery($query);
    if(!$qResult["data"]) {
      return $qResult;
    }
    $data = mysql_fetch_row($qResult["data"]);
    $id = $data[0] + 1;

    if($identity == "actor") {
      $query = "INSERT INTO Actor VALUES ($id, '$last', '$first', '$sex', '$dob', '$dod')";
    } elseif ($identity == "director") {
      $query = "INSERT INTO Director VALUES ($id, '$last', '$first', '$dob', '$dod')";
    } else {
      return array("data" => NULL,
                   "err" => array("No Identity information was provided."));
    }
    $qResult = dbRunQuery($query);
    if(!$qResult["data"]) {
      return $qResult;
    }
    $retValue = $qResult;

    $query = "UPDATE MaxPersonID SET id=$id";
    $qResult = dbRunQuery($query);
    if(!$qResult["data"]) {
      return $qResult;
    }

    return $retValue;
  }

  function dbAddMovie($input) {
    $title = $input["title"];
    $year = $input["year"];
    $rating = $input["rating"];
    $company = $input["company"];
    $genre = $input["genre"];
    $directorId = $input["director"];

    $query = "SELECT id FROM MaxMovieID";
    $qResult = dbRunQuery($query);
    if(!$qResult["data"]) {
      return $qResult;
    }

    $data = mysql_fetch_row($qResult["data"]);
    $movieId = $data[0] + 1;

    $query = "INSERT INTO Movie VALUES ($movieId, '$title', $year, '$rating', '$company')";
    $qResult = dbRunQuery($query);
    if(!$qResult["data"]) {
      return $qResult;
    }
    $retValue = $qResult;

    $query = "UPDATE MaxMovieID SET id=$movieId";
    $qResult = dbRunQuery($query);
    if(!$qResult["data"]) {
      return $qResult;
    }

    $query = "INSERT INTO MovieDirector VALUES ($movieId, $directorId)";
    $qResult = dbRunQuery($query);
    if(!$qResult["data"]) {
      return $qResult;
    }

    foreach($genre as $data) {
      $query = "INSERT INTO MovieGenre VALUES ($movieId, '$data')";
      $qResult = dbRunQuery($query);
    }

    return $retValue;
  }

  function dbAddReview($input) {
    $name = $input["name"];
    $mid = $input["movie"];
    $rating = $input["rating"];
    $comment = $input["comment"];

    $query = "INSERT INTO Review Values ('$name', NULL, $mid, $rating, '$comment')";
    return dbRunQuery($query);
  }

  function dbAddMovieActor($input) {
    $mid = $input["movie"];
    $aid = $input["actor"];
    $role = $input["role"];

    $query = "INSERT INTO MovieActor VALUES ($mid, $aid, '$role')";
    return dbRunQuery($query);
  }

  function dbAddMovieDirector($input) {
    $mid = $input["movie"];
    $did = $input["director"];

    $query = "INSERT INTO MovieDirector VALUES ($mid, $did)"; 
    return dbRunQuery($query);
  }


  function dbGetMovie($movieId) {
    $query = "SELECT * FROM Movie WHERE id=$movieId";
  }

  function dbGetAllMovies() {
    $query = "SELECT Movie.id, Movie.title, Movie.year FROM Movie ORDER BY Movie.title";
    return dbRunQuery($query);
  }

  function dbGetGenre($movieId) {
    $query = "SELECT MovieGenre.genre FROM MovieGenre WHERE mid=$movieId";
  }

  function dbGetActor($actorId) {
    $query = "SELECT * FROM Actor WHERE id=$actorId";
  }

  function dbGetAllActors() {
    $query = "SELECT Actor.id, CONCAT_WS(' ', Actor.first, Actor.last) AS name, Actor.dob FROM Actor ORDER BY Actor.first";
    return dbRunQuery($query);
  }

  function dbGetDirector($movieId) {
    $query = "SELECT first, last FROM MovieDirector md, Director d WHERE mid=$movieId and d.id=md.did";
  }

  function dbGetAllDirectors() {
    $query = "SELECT Director.id, CONCAT_WS(' ', Director.first, Director.last) AS name, Director.dob FROM Director ORDER BY Director.first";
    return dbRunQuery($query);
  }


  function dbSearch() {

  }

?>

