<html>
  <head>
    <title>GMDb - Movie Database</title>
    <?php
      include('./utils.php');
      include('./dbBackend.php');

      // Get movie info
      $movie = NULL;
      $movieId = $_GET["id"];
      $qResult = dbGetMovie($movieId);
      if($qResult["data"]) {
        $movie = $qResult["data"];
      } else {
        $errors[] = $qResult["err"];
      }

      // Get movie genre
      $genre = NULL;
      $qResult = dbGetMovieGenre($movieId);
      if($qResult["data"]) {
        $genre = $qResult["data"];
      } else {
        $errors[] = $qResult["err"];
      }

      // Get movie's director
      $director = NULL;
      $qResult = dbGetMovieDirector($movieId);
      if($qResult["data"]) {
        $director = $qResult["data"];
      } else {
        $errors[] = $qResult["err"];
      }

      // Get actors that played in this movie
      $actors = NULL;
      $qResult = dbGetMovieActors($movieId);
      if($qResult["data"]) {
        $actors = $qResult["data"];
      } else {
        $errors[] = $qResult["err"];
      }

      // Get actors that played in this movie
      $reviews = NULL;
      $qResult = dbGetMovieReviews($movieId);
      if($qResult["data"]) {
        $reviews = $qResult["data"];
      } else {
        $errors[] = $qResult["err"];
      }
    ?>
  </head>

  <body>
    <h1>Movie Information</h1>

    <?php
      if($movie) {
        $row = mysql_fetch_assoc($movie);
        echo '<h2>' . $row['first'] . ' ' . $row['last'] . '</h2>' . PHP_EOL;

        foreach($row as $key => $value) {
          if($key == 'id') {
            continue;
          }

          echo '<label>' . ucfirst($key) . ': </label><span>' . $value . '</span></br>' . PHP_EOL;
        }
      }
    ?>

    <?php
      if($actors){
        echo '<table class=\'movieActor\'>' . PHP_EOL;
        echo '<tr><th>Movie</th><th>Role</th></tr>'. PHP_EOL;
        while($row = mysql_fetch_assoc($actors)) {
          echo '<tr>' . PHP_EOL;
          echo '<td><a href=movie.php?id=' . $row['id'] . '>' . $row['title'] . '</a></td>' .
               '<td>' . $row['role'] . '</td>' . PHP_EOL;
          echo '</tr>' . PHP_EOL;
        }
        echo '</table>' . PHP_EOL;
      }
    ?>

    <?php
      if($errors) {
        printErrors($errors);
      }
    ?>

  </body>
</html>

