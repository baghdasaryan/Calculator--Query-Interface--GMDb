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
      $qResult = dbRunQuery($query);
      if(!$qResult["data"]) {
        return $qResult;
      }
    } elseif ($identity == "director") {
      $query = "INSERT INTO Director VALUES ($id, '$last', '$first', '$dob', '$dod')";
      $qResult = dbRunQuery($query);
      if(!$qResult["data"]) {
        return $qResult;
      }
    } elseif ($identity == "actor&director") {
      $query = "INSERT INTO Actor VALUES ($id, '$last', '$first', '$sex', '$dob', '$dod')";
      $qResult = dbRunQuery($query);
      if(!$qResult["data"]) {
        return $qResult;
      }
      $query = "INSERT INTO Director VALUES ($id, '$last', '$first', '$dob', '$dod')";
      $qResult = dbRunQuery($query);
      if(!$qResult["data"]) {
        return $qResult;
      }
    } else {
      return array("data" => NULL,
                   "err" => array("No Identity information was provided."));
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
    return dbRunQuery($query);
  }

  function dbGetMovieGenre($movieId) {
    $query = "SELECT MovieGenre.genre FROM MovieGenre WHERE mid=$movieId";
    return dbRunQuery($query);
  }

  function dbGetMovieDirector($movieId) {
    $query = "SELECT CONCAT_WS(' ', d.first, d.last) AS name FROM Director d INNER JOIN MovieDirector md ON d.id=md.did WHERE md.mid=$movieId";
    return dbRunQuery($query);
  }

  function dbGetMovieActors($movieId) {
    $query = "SELECT a.id, CONCAT_WS(' ', a.first, a.last) AS name, ma.role FROM Actor a INNER JOIN MovieActor ma ON a.id = ma.aid WHERE ma.mid=$movieId";
    return dbRunQuery($query);
  }

  function dbGetMovieReviews($movieId) {
    $query = "SELECT * FROM Review WHERE mid = $movieId ORDER BY time DESC";
    return dbRunQuery($query);
  }

  function dbGetMovieAverageRating($movieId) {
    $query = "SELECT AVG(rating) AS avgScore FROM Review WHERE mid = $movieId";
    return dbRunQuery($query);
  }

  function dbGetAllMovies() {
    $query = "SELECT Movie.id, Movie.title, Movie.year FROM Movie ORDER BY Movie.title";
    return dbRunQuery($query);
  }

  function dbGetActor($actorId) {
    $query = "SELECT * FROM Actor WHERE id=$actorId";
    return dbRunQuery($query);
  }

  function dbGetActorMovies($actorId) {
    $query = "SELECT m.*, ma.role FROM Movie m INNER JOIN MovieActor ma ON m.id = ma.mid WHERE ma.aid=$actorId";
    return dbRunQuery($query);
  }

  function dbGetAllActors() {
    $query = "SELECT Actor.id, CONCAT_WS(' ', Actor.first, Actor.last) AS name, Actor.dob FROM Actor ORDER BY Actor.first";
    return dbRunQuery($query);
  }

  function dbGetAllDirectors() {
    $query = "SELECT Director.id, CONCAT_WS(' ', Director.first, Director.last) AS name, Director.dob FROM Director ORDER BY Director.first";
    return dbRunQuery($query);
  }


  function dbSearchActor($search) {
    $query = "SELECT id, CONCAT_WS(' ', first, last) AS name, dob FROM Actor WHERE ";

    $firstEntry = TRUE;
    foreach($search as $data) {
      if($firstEntry) {
        $query .= "(first LIKE '%$data%' OR last LIKE '%$data%')";
        $firstEntry = FALSE;
      } else {
        $query .= " AND (first LIKE '%$data%' OR last LIKE '%$data%')";
      }
    }

    return dbRunQuery($query);
  }

  function dbSearchMovie($search) {
    $query = "SELECT id, title FROM Movie WHERE ";

    $firstEntry = TRUE;
    foreach($search as $data) {
      if($firstEntry) {
        $query .= "title LIKE '%$data%'";
        $firstEntry = FALSE;
      } else {
        $query .= "AND title LIKE '%$data%'";
      }
    }

    return dbRunQuery($query);
  }

  function dbSearch($input) {
    $searchData = $input["searchInput"];
    if(empty($searchData)) {
      return array("data" => NULL,
                   "err" => array());  // Empty search box
    }

    // Parse the input string
    $constraints = preg_split("/[\s]+/", $searchData);  // need to use mysql_real_escape_string()

    if(empty($constraints)) {
      return array("data" => NULL,
                   "err" => array());  // Empty search box
    }

    $actors = dbSearchActor($constraints);
    $movies = dbSearchMovie($constraints);

    return array("data" => array("actors" => $actors["data"],
                                 "movies" => $movies["data"]),
                 "err" => array_merge($actors["err"], $movies["err"]));
  }

?>

