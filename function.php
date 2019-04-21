<?php
  $page = __FILE__;
include "./header.php";
include "./navbar.php";

if (!isset($_GET['number'])){//SI number n'est pas défini
    echo "<p class='p-5 text-center'>Entrez un nombre</p>";
    
}
if (!isset($_GET['pow'])) {//SI pow n'est pas défini
    echo "<p class='p-5 text-center'>Entrez une puissance</p>";
}
if (isset($_GET['number'],$_GET['pow'])) {//SI number et pow sont définis

    $number = $_GET['number'];
    $pow = $_GET['pow'];

    echo "<p class='p-5 text-center'>$number puissance $pow  = " . pow($number,$pow) ."</p>";
}



  include "./footer.php";
?>
