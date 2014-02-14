<html>
  <head>
    <title>GMDb - Movie Database</title>
    <link rel="shortcut icon" href="assets/gmdb_logo.png">
    <?php
      include('./utils.php');
      include('./dbBackend.php');

      $actor = NULL;
      $movies = NULL;
      $noId = NULL;

      $actorId = $_GET["id"];

      if(is_null($actorId)) {
        $noId = True;
      } else {
        // Get actor info
        $qResult = dbGetActor($actorId);
        if($qResult["data"]) {
          $actor = $qResult["data"];
        } else {
          $errors[] = $qResult["err"];
        }

        // Get movies that the actor was in
        $qResult = dbGetActorMovies($actorId);
        if($qResult["data"]) {
          $movies = $qResult["data"];
        } else {
          $errors[] = $qResult["err"];
        }
      }
    ?>
  </head>

  <body>
    <h1>Actor Information</h1>

    <?php
      if($noId == True) {
        echo '<h2>Please provide an actor ID to view corresponding info.</h2>' . PHP_EOL;
      }
    ?>

    <?php
      if($actor) {
        $row = mysql_fetch_assoc($actor);

        // Build data output table
        echo '<h2>' . $row['first'] . ' ' . $row['last'] . '</h2>' . PHP_EOL;

        echo '<table border="1" cellpadding="5" cellspacing="15"><tr>' . PHP_EOL;
        echo '<td valign="top">' . PHP_EOL;
        foreach($row as $key => $value) {
          if($key == 'id') {
            continue;
          }

          echo '<b>' . ucfirst($key) . ': </b>' . $value . '</br>' . PHP_EOL;
        }
        echo '</td>' . PHP_EOL;

        echo '<td>' . PHP_EOL;
        if($movies){
          echo '<table border="1" cellpadding="3" cellspacing="5">' . PHP_EOL;
          echo '<tr><th align="left">Movie</th><th align="left">Role</th></tr>'. PHP_EOL;
          while($row = mysql_fetch_assoc($movies)) {
            echo '<tr>' . PHP_EOL;
            echo '<td><a href=showMovieInfo.php?id=' . $row['id'] . '>' . $row['title'] . '</a></td>' .
                 '<td>' . $row['role'] . '</td>' . PHP_EOL;
            echo '</tr>' . PHP_EOL;
          }
          echo '</table>' . PHP_EOL;
        }
        echo '</td>' . PHP_EOL;
        echo '</tr></table>' . PHP_EOL;
      }
    ?>

    <?php
      if($errors) {
        printErrors($errors);
      }
    ?>

  </body>
</html>

