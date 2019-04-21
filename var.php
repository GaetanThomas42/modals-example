<?php
  $page = __FILE__;
include "./header.php";
include "./navbar.php";
?>

<?php

  $array = [];
  $sum = 0;
  for ($i=0; $i < 100; $i++) {
    $array[] = $i;
  }
  foreach ($array as $var) {
    if ($var % 10 === 0) {
      echo "<br>";
    }
    echo "<span class='text-primary'>$var</span>" . " ";
    $sum += $var;
  }
  echo "<p>$sum</p>";
  
  var_dump($page);
  var_dump($_GET);
 ?>

<?php 
  include "./footer.php";
?>
