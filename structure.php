<?php
  $page = __FILE__;
include "./header.php";
include "./navbar.php";
?>

<?php
   //  setlocale(LC_ALL, 'fra_FRA');
   //  $array = [];
   //  for ($i=0; $i < 101; $i++) {
   //    $array[] = $i;
   //  }

   //  foreach ($array as $value ) {
   //    if ($value % 10 === 0 && $value !== 0) {
   //       echo "<span class='text-danger m-3'>$value</span><br>";
   //    } else if ($value % 2 === 0) {
   //             echo "<span class='text-primary m-3'>$value</span>";
   //    } else {
   //       echo "<span class='m-3'>$value</span>";
   //    }
   //  }
?>

<?php
//     if (isset($_GET['var1']) && isset($_GET['var2'])) {
//         if ($_GET['var1'] === $_GET['var2']) {
//             echo "Égalité";
//         }else {
//             echo "Inégalité";
//     }
// }   
//     echo "<br>" . strftime("%A %d %B %Y") . "<br>";
//      $d = date("D");
         
//          switch ($d){
//             case "Mon":
//                echo "Aujourd'hui c'est Lundi";
//                break;
            
//             case "Tue":
//                echo "Aujourd'hui c'est Mardi";
//                break;
            
//             case "Wed":
//                echo "Aujourd'hui c'est Mercredi";
//                break;
            
//             case "Thu":
//                echo "Aujourd'hui c'est Jeudi";
//                break;
            
//             case "Fri":
//                echo "Aujourd'hui c'est Vendredi";
//                break;
            
//             case "Sat":
//                echo "Aujourd'hui c'est Samedi";
//                break;
            
//             case "Sun":
//                echo "Aujourd'hui c'est Dimanche";
//                break;
            
//             default:
//                echo "Wonder which day is this ?";
//          }
?>

<?php 

         $myArray = ["Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre"];
         shuffle($myArray);
         for ($i=0; $i < count($myArray); $i++) { 
            $myArray[$i] = ucfirst(str_shuffle(strtolower($myArray[$i])));
         }
         var_dump($myArray);
?>

<?php 
  include "./footer.php";
?>