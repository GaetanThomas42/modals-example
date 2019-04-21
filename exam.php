<?php
    $page = __FILE__;
    include "./header.php";
    include "./navbar.php";

    //Création des variables relatives à la page
    $user = "Thomas Gaëtan";
    $date = date('l j F Y');
    $fileName = basename($page);
    echo "<div class='container'><h3>$fileName,$user $date </h3>";

    //Création des tableaux
    $months = [];
    $temps = [];

    //Fonction anonyme dans une variable qui créé un bouton radio pour un certain entier
    $createRadioButton = function($int){
        $month = date('M',mktime(0,0,0,$int,1));//On récupère le mois en string de 3 caractères
        //On créé pour chaque mois un bouton radio
        echo "<input class='form-check-input mx-2' type='radio' name='inlineRadioOptions' id='inline-radio$int' value='$int'></input><label class='form-check-label' for='inline-radio$int'>$month</label>";
    };
    //Remplissage tableaux
    for ($month=1; $month < 13; $month++) { 
        array_push($months,$month);
        array_push($temps,rand(-10,30));
    }
    //Test de la fonction annonyme pour 1 et 10
    // echo $createRadioButton(1) . "<br>" . $createRadioButton(10);

    //Création du formulaire
    echo "<form class='form-check form-check-inline' method='post'>";
    //On parcours le tableau $months et a chacun des éléments on appel la fonction $createRadioButton avec la valeur de l'element en argument
    array_walk($months,$createRadioButton);
    //Boutton pour recupérer le $_POST
    echo "<button class='btn bg-info mx-5'>Display the Temp</button></form>";
    
    //Si $_POST est défini  
    if (isset($_POST["inlineRadioOptions"])) {
        $monthStr = date('F',mktime(0,0,0,$_POST["inlineRadioOptions"],1));
        //On affiche le mois relatif au bouton et la temperature relative au mois
        echo "<p class='mt-4'>Sur Mars la température moyenne du mois de " . $monthStr . " est de " .$temps[$_POST["inlineRadioOptions"]-1]."</p>";
    }

    //Création du tableau 
    echo "<div class='container text-center p-2'>
    <table class='table'><thead><tr>
    <th scope='col'>Index</th>
    <th scope='col'>Month</th>
    <th scope='col'>Moy Temp</th></tr></thead><tbody>";
    //Pour chaque mois
    for ($i=0; $i < 12; $i++) {
        $month = date('M',mktime(0,0,0,$months[$i],1));
        //On affiche tous le mois et sa température 
        echo "<tr><th scope='row'>".$i."</th><td>".$month."</td><td>".$temps[$i]."</td></tr>";
    }
    echo "</tbody></table></div></div>";

  	include "./footer.php";
?>