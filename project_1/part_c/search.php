<html>
  <head>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <title>GMDb - Movie Database</title>
    <?php
      include('./utils.php');
      include('./dbBackend.php');
    ?>
  </head>

  <body class="page">

    <h1>Search</h1>

    <form action="./search.php" name="search" method="GET">
      <table>
        <tr>
          <td><input type="text" name="searchInput" class="searchBox" maxlength="100" size="35" placeholder="Search for Actors, Movies and more..." /></td>
        </tr><tr>
          <td align="center"><input type="submit" value="GMDb Search" /></td>
        </tr>
      </table>
    </form>

    <?php
      if(!empty($_GET)) {
        $qResult = dbSearch($_GET);
        if($qResult["data"]) {
          echo '<h2>Search Results:</h2>';

          $actors = $qResult["data"]["actors"];
          $movies = $qResult["data"]["movies"];

          // Construct table with results
          echo '<table border="1">' . PHP_EOL;
          echo '<tr><th>Actors</th><th>Movies</th></tr>' . PHP_EOL;
          echo '<tr><td valign="top">' . PHP_EOL;

          while($row = mysql_fetch_assoc($actors)) {
            echo '<a href=showActorInfo.php?id=' . $row['id'] . '>' . $row['name'] . ' (' . $row['dob'] . ')' . '</a><br />' . PHP_EOL;
          }

          echo '</td><td valign="top">' . PHP_EOL;

          while($row = mysql_fetch_assoc($movies)) {
            echo '<a href=showMovieInfo.php?id=' . $row['id'] . '>' . $row['title'] . '</a><br />' . PHP_EOL;
          }

          echo '</td></tr>' . PHP_EOL;
          echo '</table>' . PHP_EOL;
        } else {
          if(!empty($qResult["err"])) {
            $errors[] = $qResult["err"];
          }
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

