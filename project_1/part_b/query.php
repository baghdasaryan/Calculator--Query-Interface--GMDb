<html>
  <head>
    <title>CS143 Project 1B Demo</title>
  </head>

  <body>

    <h1>Web Query Interface</h1>

    <small>
      (Ver 1.0 01/09/2014 by Georgi Baghdasaryan and Michael Sweatt)
    </small>

    <p>
      Type a SQL query in the following box:
      <form action="" method="GET">
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

      if($query != "") {
        $err = false;

        if(!preg_match("/^(select\s|show\s)/i", $query)) {
          echo 'Sorry, only SELECT and SHOW queries are allowed!';
          $err = true;
        }

        if(!$err) {
          echo '<h3>Results from MySQL:</h3>' . PHP_EOL;

          $db_connection = mysql_connect("localhost", "cs143", "");
          if(!$db_connection) {
            $errmsg = mysql_error($db_connection);
            echo 'Connection failed: ' . $errmsg;
            $err = true;
          }
        }

        if(!$err) {
          $db_selected = mysql_select_db("CS143", $db_connection);
          if(!$db_selected) {
            $errmsg = mysql_error($db_selected);
            echo 'Failed to select a database: ' . $errmsg;
            $err = true;
          }
        }

        if(!$err) {
          $result = mysql_query($query, $db_connection);
          if(!$result) {
            echo '<b>Query:</b> ' . $query . '<br />' . PHP_EOL;
            echo mysql_error();
            $err = true;
          }
        }

        if(!$err) {
          echo '<table border=1 cellspacing=1 cellpadding=2>' . PHP_EOL;

          echo '<tr align=center>';
          $numfields = mysql_num_fields($result);
          for($i = 0; $i < $numfields; $i++) {
            echo '<th>' . mysql_field_name($result, $i) . '</th>';
          }
          echo '</tr>' . PHP_EOL;

          while($row = mysql_fetch_row($result)) {
            echo '<tr align=center>';
            foreach($row as $data) {
              echo '<td>' . $data . '</td>';
            }
            echo '</tr>' . PHP_EOL;
          }

          echo '</table>' . PHP_EOL;
        }

        if($db_selected) {
          mysql_close($db_connection);
        }
      }
    ?>

  </body>

</html>

