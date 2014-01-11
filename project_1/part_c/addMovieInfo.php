<html>
  <head>
    <title>GMDb - Movie Database</title>
  </head>

  <body>

    <h1>Add Movie</h1>

    <form action="./addMovieInfo.php" name="addMovieInfo" method="GET">
      <table>
        <tr>
          <td>Title:</td>
          <td><input type="text" name="title" maxlength="100" /></td>
        </tr><tr>
          <td>Year:</td>
          <td><input type="text" name="year" maxlength="4" /></td>
        </tr><tr>
          <td>Company:</td>
          <td><input type="text" name="company" maxlength="50" /></td>
        </tr><tr>
          <td>MPAA Rating:</td>
          <td>
            <select name="rating">
              <option value="g">G</option>
              <option value="nc-17">NC-17</option>
              <option value="pg">PG</option>
              <option value="pg-13">PG-13</option>
              <option value="r">R</option>
              <option value="surrendere">surrendere</option>
            </select>
          </td>
        </tr><tr>
          <td colspan="2">Genre: 
            <table>
              <tr><td>
                <label><input type="checkbox" value="Action" name="genre[]" />Action</label><br />
                <label><input type="checkbox" value="Adult" name="genre[]" />Adult</label><br />
                <label><input type="checkbox" value="Adventure" name="genre[]" />Adventure</label><br />
                <label><input type="checkbox" value="Animation" name="genre[]" />Animation</label><br />
                <label><input type="checkbox" value="Comedy" name="genre[]" />Comedy</label><br />
              </td><td>
                <label><input type="checkbox" value="Crime" name="genre[]" />Crime</label><br />
                <label><input type="checkbox" value="Documentary" name="genre[]" />Documentary</label><br />
                <label><input type="checkbox" value="Drama" name="genre[]" />Drama</label><br />
                <label><input type="checkbox" value="Family" name="genre[]" />Family</label><br />
                <label><input type="checkbox" value="Fantasy" name="genre[]" />Fantasy</label><br />
              </td><td>
                <label><input type="checkbox" value="Horror" name="genre[]" />Horror</label><br />
                <label><input type="checkbox" value="Musical" name="genre[]" />Musical</label><br />
                <label><input type="checkbox" value="Mystery" name="genre[]" />Mystery</label><br />
                <label><input type="checkbox" value="Romance" name="genre[]" />Romance</label><br />
                <label><input type="checkbox" value="Sci-Fi" name="genre[]" />Sci-Fi</label><br />
              </td><td>
                <label><input type="checkbox" value="Short" name="genre[]" />Short</label><br />
                <label><input type="checkbox" value="Thriller" name="genre[]" />Thriller</label><br />
                <label><input type="checkbox" value="War" name="genre[]" />War</label><br />
                <label><input type="checkbox" value="Western" name="genre[]" />Western</label><br />
              </td></tr>
            </table>
          </td>
        </tr><tr>
          <td colspan="2" align="right"><input type="submit" value="Add Movie" /></td>
        </tr>
      </table>
    </form>

    <?php



    ?>

  </body>
</html>

