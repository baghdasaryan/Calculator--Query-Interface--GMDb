<html>
  <head>
    <title>GMDb - Movie Database</title>
    <link rel="shortcut icon" href="assets/gmdb_logo.png">
    <?php
      include('./utils.php');
      include('./dbBackend.php');

      $movie = NULL;
      $genre = NULL;
      $director = NULL;
      $actors = NULL;
      $reviews = NULL;
      $noId = NULL;

      $movieId = $_GET["id"];

      if(is_null($movieId)) {
        $noId = True;
      } else {
        // Get movie info
        $qResult = dbGetMovie($movieId);
        if($qResult["data"]) {
          $movie = $qResult["data"];
        } else {
          $errors[] = $qResult["err"];
        }

        // Get movie genre
        $qResult = dbGetMovieGenre($movieId);
        if($qResult["data"]) {
          $genre = $qResult["data"];
        } else {
          $errors[] = $qResult["err"];
        }

        // Get movie's director
        $qResult = dbGetMovieDirector($movieId);
        if($qResult["data"]) {
          $director = $qResult["data"];
        } else {
          $errors[] = $qResult["err"];
        }

        // Get actors that played in this movie
        $qResult = dbGetMovieActors($movieId);
        if($qResult["data"]) {
          $actors = $qResult["data"];
        } else {
          $errors[] = $qResult["err"];
        }

        // Get actors that played in this movie
        $qResult = dbGetMovieReviews($movieId);
        if($qResult["data"]) {
          $reviews = $qResult["data"];
        } else {
          $errors[] = $qResult["err"];
        }
      }
    ?>
  </head>

  <body>
    <h1>Movie Information</h1>

    <?php
      if($noId == True) {
        echo '<h2>Please provide a movie ID to view corresponding info.</h2>' . PHP_EOL;
      }
    ?>

    <?php
      if($movie) {
        $row = mysql_fetch_assoc($movie);

        // Build data output table
        echo '<h2>' . $row['title'] . '</h2>' . PHP_EOL;

        echo '<table border="1" cellpadding="5" cellspacing="15"><tr>' . PHP_EOL;
        echo '<td valign="top">' . PHP_EOL;
        foreach($row as $key => $value) {
          if($key == 'id') {
            continue;
          }

          echo '<b>' . ucfirst($key) . ': </b>' . $value . '</br>' . PHP_EOL;
        }

        if($genre) {
          echo '<b>Genre:</b> ';
          if($row = mysql_fetch_assoc($genre)) {
            echo $row['genre'];
            while($row = mysql_fetch_assoc($genre)) {
              echo ', ' . $row['genre'];
            }
          }
          echo '</br>';
        }

        if($director) {
          echo '<b>Director:</b> ';
          if($row = mysql_fetch_assoc($director)) {
            echo $row['name'];
            while($row = mysql_fetch_assoc($director)) {
              echo ', ' . $row['name'];
            }
          }
          echo '</br>';
        }

        echo '</td>' . PHP_EOL;

        echo '<td>' . PHP_EOL;
        if($actors){
          echo '<table border="1" cellpadding="3" cellspacing="5">' . PHP_EOL;
          echo '<tr><th align="left">Actor</th><th align="left">Role</th></tr>'. PHP_EOL;
          while($row = mysql_fetch_assoc($actors)) {
            echo '<tr>' . PHP_EOL;
            echo '<td><a href=showActorInfo.php?id=' . $row['id'] . '>' . $row['name'] . '</a></td>' .
                 '<td>' . $row['role'] . '</td>' . PHP_EOL;
            echo '</tr>' . PHP_EOL;
          }
          echo '</table>' . PHP_EOL;
        }
        echo '</td>' . PHP_EOL;
        echo '</tr></table></br>' . PHP_EOL;

        // Reviews
        echo '<button onclick="location.href=\'addReview.php?id=' . $movieId . '\'">Add a Review</button>' . PHP_EOL;
        if($reviews) {
          echo '<h3>Reviews:</h3>' . PHP_EOL;
          $qResult = dbGetMovieAverageRating($movieId);
          if($qResult["data"]) {
            $res = $qResult["data"];
          } else {
            $errors[] = $qResult["err"];
          }
          $score = mysql_fetch_assoc($res);
          echo 'Average Score: ' . round($score['avgScore'], 2) . '<br /><br />' . PHP_EOL;

          if(mysql_num_rows($reviews) > 0) {
            echo '<table border="1" cellpadding="3" cellspacing="5">' . PHP_EOL;
            while($row = mysql_fetch_assoc($reviews)) {
              echo '<tr><th><table align="left">' . PHP_EOL;
              echo '<tr align="left"><th>Date:</th><td>' . $row['time'] . '</td></tr>' . PHP_EOL;
              echo '<tr align="left"><th>Name:</th><td>' . $row['name'] . '</td></tr>' . PHP_EOL;
              echo '<tr align="left"><th>Rating:</th><td>' . $row['rating'] . '</td></tr>' . PHP_EOL;
              echo '<tr align="left"><th>Comment:</th><td>' . $row['comment'] . '</td></tr>' . PHP_EOL;
              echo '</table></td></tr>' . PHP_EOL;
            }
            echo '</table>' . PHP_EOL;
          }

          $qResult = dbGetMovieAverageRating($movieId);
        }
      }
    ?>

    <?php
      if($errors) {
        printErrors($errors);
      }
    ?>

  </body>
</html>

