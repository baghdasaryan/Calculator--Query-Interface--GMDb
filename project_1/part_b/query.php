<html>
  <head>
    <title>CS143 Project 1B Demo</title>
  </head>

  <body>

    <h1>Web Query Interface</h1>

    <small>
      (Ver 1.0 01/08/2014 by Georgi Baghdasaryan and Michael Sweatt)
    </small>

    <p>
      Type a SQL query in the following box:
      <form method="GET"> <!-- action="." -->
        <textarea name="query" cols="60" rows="8"></textarea>
        <input type="submit" value="Submit" />
      </form>
    </p>

    <p>
      <small>
        Note: tables and fields are case sensitive. Run "show tables" to see
        the list of available tables.
      </small>
    </p>

    <?php
      $query =  $_GET["query"];

      if($query == "") {
      } else {
        echo '<h3>Results from MySQL:</h3>';

        $db_connection = mysql_connect("localhost", "cs143", "");
        if(!$db_connection) {
          $errmsg = mysql_error($db_connection);
          echo 'Connection failed: ' . $errmsg . '<br />';
          exit(1);
        }

        $db_selected = mysql_select_db("CS143", $db_connection);
        if(!$db_selected) {
          $errmsg = mysql_error($db_selected);
          echo 'Failed to select a database: ' . $errmsg . '<br />';
          exit(1);
        }

        /*$result = mysql_query($query, $db_connection);
        if(!$result) {
          echo 'Could not run query: ' . $query . '<br />';
          echo 'Error: ' . mysql_error() . '<br />';
          exit(1);
        }*/
/*
        while($row = mysql_fetch_row($rs)) {
          $sid = $row[0];
          $name = $row[1];
          $email = $row[2];
          print "$sid, $name, $email<br />";
        }
*/

        echo 'Query: ' . $query;

        mysql_close($db_connection);
      }
    ?>

  </body>

</html>

