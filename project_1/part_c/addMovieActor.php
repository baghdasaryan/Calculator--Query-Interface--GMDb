<html>
  <head>
    <title>GMDb - Movie Database</title>
  </head>

  <body>

    <h1>Add Actor to a Movie</h1>

    <form action="./addMovieActor.php" name="addMovieActor" method="GET">
      <table>
        <tr>
          <td>Movie:</td>
          <td>
            <select name="movie">
              <?php

                //<option value="g">G</option>

              ?>
            </select>
          </td>
        </tr><tr>
          <td>Actor:</td>
          <td>
            <select name="actor">
              <?php

                //<option value="g">G</option>

              ?>
            </select>
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



    ?>

  </body>
</html>

