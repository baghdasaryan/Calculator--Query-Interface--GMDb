<?php

  function printErrors($errors) {
    if(empty($errors)) {
      return;
    }

    echo '<b>Errors:</b>' . PHP_EOL;
    echo '<ul style="list-style: none;">' . PHP_EOL;
    foreach($errors as $errorList) {
      foreach($errorList as $error) {
        echo '<li>' . $error . '</li' . PHP_EOL;
      }
    }
    echo '</ul>' . PHP_EOL;
  }

?>
