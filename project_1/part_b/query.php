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

        $db_connection = mysql_connect("localhost", "cs143", "");
        if(!$db_connection) {
          die('Could not connect to MySQL: ' . mysql_error());
        }



        echo "<h3>Results from MySQL:</h3>";
        echo "Query: " . $query;

        mysql_close($db_connection);
      }
    ?>

  </body>

</html>

