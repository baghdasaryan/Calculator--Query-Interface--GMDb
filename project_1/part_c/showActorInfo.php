<html>
  <head>
    <title>GMDb - Movie Database</title>
    <?php
      include('./utils.php');
      include('./dbBackend.php');

      // Get actor info
      $actor = NULL;
      $actorId = $_GET["id"];
      $qResult = dbGetActor($actorId);
      if($qResult["data"]) {
        $actor = $qResult["data"];
      } else {
        $errors[] = $qResult["err"];
      }

      // Get movies that the actor was in
      $movies = NULL;
      $qResult = dbGetActorMovies($actorId);
      if($qResult["data"]) {
        $movies = $qResult["data"];
      } else {
        $errors[] = $qResult["err"];
      }
    ?>
  </head>

  <body>
    <h1>Actor Information</h1>

    <?php
      if($actor) {
        $row = mysql_fetch_assoc($actor);
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
      if($movies){
        echo '<table class=\'movieActor\'>' . PHP_EOL;
        echo '<tr><th>Movie</th><th>Role</th></tr>'. PHP_EOL;
        while($row = mysql_fetch_assoc($movies)) {
          echo '<tr>' . PHP_EOL;
          echo '<td><a href=showMovieInfo.php?id=' . $row['id'] . '>' . $row['title'] . '</a></td>' .
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

