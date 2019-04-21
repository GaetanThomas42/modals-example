<?php
  $page = __FILE__;
    include "./header.php";
    include "./navbar.php";
?>

<!-- creation formulaire -->
  <form method="post">
    <div class="form-group">
      <label for="to" class = "font-weight-bold">To</label>
      <input type="string" name="to" class="form-control" placeholder="To">
    </div>
    <div class="form-group">
      <label for="cc" class = "font-weight-bold">cc</label>
      <input type="text" name="cc" class="form-control" placeholder="From">
    </div>
    <div class="form-group">
      <label for="objet_mail" class = "font-weight-bold">Objet</label>
      <input type="text" name="objet_mail" class="form-control" placeholder="Objet">
    </div>
    <div class="form-group">
      <label for="message" class = "font-weight-bold">Message</label>
      <textarea type="string" name="message" class="form-control">
      </textarea>
    </div>
    <button type="submit" class="btn btn-danger">Envoyer</button>
  </form>
  

<?php
//from est constante , doit etre la meme addresse mail qu'on a mis sur  fichier sendmail.ini
if ( isset($_POST['to'],$_POST['objet_mail'],$_POST['message']) && $_POST['to'] != '' && $_POST['message'] != '' &&
      isset($_POST['cc']) && $_POST['cc'] != '' && $_POST['objet_mail'] != '' ) {
        
      $header = "From:mbrunetti@humanbooster.com \r\n";
      $header .= "Cc:".$_POST['cc']."\r\n";
      $header .= "MIME-Version: 1.0\r\n";
      $header .= "Content-type: text/html\r\n";

    $result = mail($_POST['to'], $_POST['objet_mail'],$_POST['message'], $header);
} else {
    // Si ce n'est pas correct on affiche une erreur.
    echo "Completez les champs<br>";
}


// if (!file_exists("tmp/test.txt")) {
//   die("Error file not found");
// }
$fileName = "tmp/test.txt";
try {
  if(!file_exists($fileName)){
    throw new Exception("File not found !");
  }
} catch ( Exception $e ) {
  // echo "Exception line :", $e->getLine() ," on File : ", $e->getFile() ," Error : ", $e->getMessage() ;
  // var_dump($e);
} finally {
  // echo " Status ";
}

function inverse($x) {
    if ($x === 0) {
        throw new Exception('Division par zéro.');
    }
    return 1/$x;
}

try {
    echo inverse(1) . "\n <br>";
} catch (Exception $e) {
    echo 'Exception reçue : ',  $e->getMessage(), "\n <br>";
} finally {
    echo "Première fin.\n <br>";
}

try {
    echo inverse(0) . "\n <br>";
} catch (Exception $e) {
    echo 'Exception reçue : ',  $e->getMessage(), "\n <br>";
} finally {
    echo "Seconde fin.\n <br>";
}

// On continue l'exécution
echo "Bonjour le monde !\n <br>";


include "./footer.php";
?>