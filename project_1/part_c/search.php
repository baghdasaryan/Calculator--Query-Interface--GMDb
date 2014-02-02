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
          echo "Success";
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

