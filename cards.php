<?php
  $page = __FILE__;
include "./header.php";
include "./navbar.php";
?>
<?php 
   $playerNames = ['Romain','Greg nul','Som','Roland'];
   $deck = createDeck();
   $wonCards = createArrays($playerNames);
   $playersCards = createArrays($playerNames);
   shuffle($deck);

 if (isset($_GET['nbCards'])) {

    for ($turn=0; $turn < $_GET['nbCards']; $turn++) {//Boucle déterminant le nombre de cartes par main 
      
      foreach ($playersCards as $key => $player) {//Boucle pour distribuer a chaque joueur
        $card = array_pop($deck);//On retire la carte du deck
        $card[] = $key;// On ajoute a la carte un élement qui sera le nom du joueur la possédant
        array_push($playersCards[$key],$card); 
      }
    }
    for ($turn = 0;$turn < $_GET['nbCards']; $turn++) {//On boucle selon le nombre de cartes par main
        
      $playedCards = array();
        
      foreach ($playersCards as $key => $playerHand) {//Chaque joueur 'joue' sa premiere carte qui sera 
        
        array_push($playedCards, array_pop($playersCards[$key]));//temporairement dans 'playedCards'
        
      }
        
      rsort($playedCards); //On tri le tableau par ordre croissant (ici par le premier element du tableau les "points")
        
        
      foreach($playerNames as $player) {//Pour chaque joueur
          
        array_push($wonCards[$playedCards[0][3]],array_pop($playedCards));
        
      }//Ici playedCards[0] correspond a la premiere carte du tableau vu que nous l'avons trié c'est la meilleure des 4 cartes    
    
    }//Ici playedCards[0][3] correspond au nom du propriètaire de la meilleure carte, afin de push dans le bon tableau
    
    displayCards($wonCards);
  
  }else {
    echo "<p>Entrez un nombre de cartes par joueur entre 1 et 12 :</p><blockquote class='text-center'>Exemple :  '?nbCards=4'  a la suite de l'url</blockquote> ";
  }

  function createDeck() :array {
    $signs = ["♣","♥","♦","♠"];
    $values = ["2","3","4","5","6","7","8","9","10","J","Q","K","A"];
    $points = [2,3,4,5,6,7,8,9,10,11,12,13,14];
    
    for ($i=0; $i < 2; $i++) {    //Création joker
      $deck[] = array(
          15,
          "Joker",
          "☺"
      );
    }
    for ($sign=0; $sign < count($signs); $sign++) {    // Boucle des signes
    
      for ($value=0; $value < count($values); $value++) { // Boucle des valeurs
        $deck[] = array(//Création carte sous forme de tableau 
          $points[$value],
          $values[$value],
          $signs[$sign]
        );
      }
    }
    return $deck;
 }
  function createArrays(array $basisArray) {
    $array = array();
    foreach ($basisArray as $arrayItem) {
      $array[$arrayItem] = array();//Chaque joueur a un [] de cartes 
    }
    return $array;
  }
  function displayCards(array $wonCards){
    echo "<div class='container'><div class='row'>";
    foreach ($wonCards as $key => $playerCards) {//On recupere le tableau de gains de chaque joueur
      $sums[$key] = 0;//Création des tableaux de sommes par joueur (  [$key]  )
      rsort($playerCards);//Tri du tab
      echo "<div class='col-md-3 text-center border'><h3> Joueur $key </h3><div class='row'>";//Affichage nom du joueur grace a la key
      foreach ($playerCards as $playerCard) {//Chaque carte d'un seul joueur
        if ($playerCard[2] == "♦" || $playerCard[2] == "♥") {
          $color = "danger";
        }else if ($playerCard[2] == "♣" || $playerCard[2] == "♠"){
          $color = "dark";
        }else{
          $color = "success";
        }
        echo "<p class='col-md-4' style='font-size:25px'> $playerCard[1] <span class='text-$color' style='font-size:25px'>$playerCard[2]</span></p>";//Affichage de chaque attribut d'une carte
        $sums[$key] += $playerCard[0];//Addition dans le tableau sum d'un joueur avec key
      }
      echo "</div><h4 class='text-info '>Resultat : $sums[$key] </h4></div>";
  }
  echo "</div></div>";
 }
?>