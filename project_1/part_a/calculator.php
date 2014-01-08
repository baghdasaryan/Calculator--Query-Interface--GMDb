<html>
  <head><title>Calculator</title></head>
  <body>

    <h1>Calculator</h1>

    (Ver 1.1 01/07/2014 by Georgi Baghdasaryan)<br />
    Type an expression in the following box (e.g., 10.5+20*3/25).

    <p>
      <form method="GET">
        <input type="text" name="expr">
        <input type="submit" value="Calculate">
      </form>
    </p>

    <ul>
      <li>Only numbers and +, -, * and / operators are allowed in the expression.
      <li>The evaluation follows the standard operator precedence.
      <li>The calculator does not support parentheses.
      <li>The calculator handles invalid input "gracefully". It does not output PHP error messages.
    </ul>

    <?
      $expr = $_GET["expr"];
      $eqn = $expr;

      if($expr == "") {
      } else {
        $err = 0;

        # replace space with empty character
        $expr = preg_replace("/ /", "", $expr);
        # replace -- with +
        $expr = preg_replace("/--/", "+", $expr);

        # check for division by zero
        $div_zero = preg_match("/.*\/0+\.?0*($|[\+\-\*\/])/", $expr);

        # check that input is valid
        $err |= preg_match("/[()]/", $expr);
        $err |= preg_match("/[^0-9+\/\-\.\*]/", $expr);
      
        echo "<h2>Result</h2>";
        if($err != 0 || $div_zero != 0) {
          if($div_zero == 0) {
            echo "Invalid input expression: " . $eqn . ".";
          } else {
            echo "Invalid input expression (division by zero is not allowed): " . $eqn . ".";
          }
        } else {
          $test = @eval("\$ans =" . $expr . "; return true;");
          if(!$test) {  # bad input if eval fails
            echo "Invalid input expression2 " . $eqn . ".";
          } else {
            echo $eqn . " = " . $ans;
          }
        }
      }
    ?>

  </body>
</html>

