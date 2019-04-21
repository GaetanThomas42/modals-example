<?php
   session_start();

   if( isset( $_SESSION['counter'] ) ) {
      $_SESSION['counter'] += 1;
   }else {
      $_SESSION['counter'] = 1;
   }
   include "./functionsPhp.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <title>My PHP Lab on LAMP docker</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
   <script type="text/javascript" src="js/popper.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
   <!-- <script type="text/javascript" src="js/bootstrap.min.js"></script> -->

   <!-- Custom JS file -->
   <!-- <script type="text/javascript" src="js/script.js"></script> -->
   <script type="text/javascript" src="js/palette.js"></script>
   <link rel="stylesheet" href="css/style.css">
   <script type="text/javascript" src="js/lax.min.js"></script>
   

</head>

<body>