<html>
  <head>
    <title>GMDb - Movie Database</title>
  </head>

  <body>

    <h1>Add Director to a Movie</h1>

    <form action="./addMovieDirector.php" name="addMovieDirector" method="GET">
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
          <td>Director:</td>
          <td>
            <select name="director">
              <?php

                //<option value="g">G</option>

              ?>
            </select>
          </td>
        </tr><tr>
          <td colspan="2" align="right"><input type="submit" value="Add Relation" /></td>
        </tr>
      </table>
    </form>

    <?php



    ?>

  </body>
</html>

