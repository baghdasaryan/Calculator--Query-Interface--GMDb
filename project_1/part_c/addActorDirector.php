<html>
  <head>
    <title>GMDb - Movie Database</title>
    <?php
      include('./utils.php');
      include('./dbBackend.php');
    ?>
  </head>

  <body>

    <h1>Add Actor/Director</h1>

    <form action="./addActorDirector.php" name="addActorDirector" method="GET">
      <table>
        <tr>
          <td>Identity:</td>
          <td>
            <label><input type="radio" name="identity" value="actor" checked="true" onclick="document.getElementById('submitBtn').value='Add Actor'">Actor</input></label>
            <label><input type="radio" name="identity" value="director" onclick="document.getElementById('submitBtn').value='Add Director'">Director</input></label><br />
            <label><input type="radio" name="identity" value="actor&director" onclick="document.getElementById('submitBtn').value='Add Actor and Director'">Actor and Director</input></label>
          </td>
        </tr><tr>
          <td>First Name:</td>
          <td><input type="text" name="first" maxlength="20" /></td>
        </tr><tr>
          <td>Last Name:</td>
          <td><input type="text" name="last" maxlength="20" /></td>
        </tr><tr>
          <td>Sex:</td>
          <td>
            <label><input type="radio" name="sex" value="Male" checked="true">Male</input></label>
            <label><input type="radio" name="sex" value="Female">Female</input></label>
          </td>
        </tr><tr>
          <td>Date of Birth (yyyy-mm-dd):</td>
          <td><input type="text" name="dob" maxlength="10" /></td>
        </tr><tr>
          <td>Date of Death (yyyy-mm-dd<br />or blank if alive):</td>
          <td><input type="text" name="dod" maxlength="10" /></td>
        </tr><tr>
          <td colspan="2" align="right"><input type="submit" value="Add Actor" id="submitBtn" /></td>
        </tr>
      </table>
    </form>

    <?php
      if(!empty($_GET)) {
        $qResult = dbAddActorDirector($_GET);
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

