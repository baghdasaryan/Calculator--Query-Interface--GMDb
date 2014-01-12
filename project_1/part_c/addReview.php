<html>
  <head>
    <title>GMDb - Movie Database</title>
    <?php
      include('./utils.php');
      include('./dbBackend.php');
    ?>
  </head>

  <body>

    <h1>Add Review</h1>

    <form action="./addReview.php" name="addReview" method="GET">
      <table>
        <tr>
          <td>Your Name:</td>
          <td><input type="text" name="name" maxlength="20" /></td>
        </tr><tr>
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
          <td>Rating:</td>
          <td>
            <select name="rating">
              <option value="5">5 - Excellent</option>
              <option value="4">4 - Good</option>
              <option value="3">3 - It's ok</option>
              <option value="2">2 - Not worth</option>
              <option value="1">1 - I hate it</option>
            </select>
          </td>
        </tr><tr>
          <td valign="top">Comments:</td>
          <td><textarea name="comment" cols="80" rows="10" maxlength="500"></textarea></td>
        </tr><tr>
          <td colspan="2" align="right"><input type="submit" value="Submit Review" /></td>
        </tr>
      </table>
    </form>

    <?php
      if(!empty($_GET)) {
        $qResult = dbAddReview($_GET);
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

