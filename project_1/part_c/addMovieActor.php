<html>
  <head>
    <title>GMDb - Movie Database</title>
    <?php
      include('./utils.php');
      include('./dbBackend.php');
    ?>
  </head>

  <body>

    <h1>Add Actor to a Movie</h1>

    <form action="./addMovieActor.php" name="addMovieActor" method="GET">
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
          <td>Actor:</td>
          <td>
            <?php
              $qResult = dbGetAllActors();
              if($qResult["data"]) {
                echo '<select name="actor">' . PHP_EOL;
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
          <td>Role:</td>
          <td><input type="text" name="role" maxlength="50" /></td>
        </tr><tr>
          <td colspan="2" align="right"><input type="submit" value="Add Relation" /></td>
        </tr>
      </table>
    </form>


    <?php
      if(!empty($_GET)) {
        $qResult = dbAddMovieActor($_GET);
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

