<html>
  <head>
    <title>GMDb - Movie Database</title>
    <link rel="shortcut icon" href="assets/gmdb_logo.png">
    <?php
      include('./utils.php');
      include('./dbBackend.php');
    ?>
  </head>

  <body>

    <h1>Add Director to a Movie</h1>

    <form action="./addMovieDirector.php" name="addMovieDirector" method="GET">
      <table>
        <tr>
          <td>Movie:</td>
          <td>
            <?php
              $qResult = dbGetAllMovies();
              if($qResult["data"]) {
                echo '<select name="movie">' . PHP_EOL;
                while($row = mysql_fetch_row($qResult["data"])) {
                  echo '<option value="' . $row[0] . '">' . $row[1] . ' (' . $row[2] . ')' . '</option>' . PHP_EOL;
                }
                echo '</select>' . PHP_EOL;
              } else {
                $errors[] = $qResult["err"];
              }
            ?>
          </td>
        </tr><tr>
          <td>Director:</td>
          <td>
            <?php
              $qResult = dbGetAllDirectors();
              if($qResult["data"]) {
                echo '<select name="director">' . PHP_EOL;
                while($row = mysql_fetch_row($qResult["data"])) {
                  echo '<option value="' . $row[0] . '">' . $row[1] . ' (' . $row[2] . ')' . '</option>' . PHP_EOL;
                }
                echo '</select>' . PHP_EOL;
              } else {
                $errors[] = $qResult["err"];
              }
            ?>
          </td>
        </tr><tr>
          <td colspan="2" align="right"><input type="submit" value="Add Relation" /></td>
        </tr>
      </table>
    </form>

    <?php
      if(!empty($_GET)) {
        $qResult = dbAddMovieDirector($_GET);
        if($qResult["data"]) {
          echo "Success";
        } else {
          $errors[] = $qResult["err"];
        }
      } else {
        // echo "Failure: no info";
      }

      if($errors) {
        printErrors($errors);
      }
    ?>

  </body>
</html>

