<?php

    include "./functionsPhp.php";
	// 1) Connexion to BDD
	try {
        // specify your own database credentials
        $db_config = array();
        $db_config['PDO_SGBD']      = 'mysql';
        $db_config['PDO_PORT']      = '3306';
        $db_config['PDO_HOST']      = 'localhost' . ':' . $db_config['PDO_PORT'];
        $db_config['PDO_USER']      = 'root';
        $db_config['PDO_PASSWORD']  = '';
        $db_config['PDO_OPTIONS']   = array(
            // Activation des exceptions PDO :
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // Change le fetch mode par défaut sur FETCH_ASSOC ( fetch() retournera un tableau associatif ) :
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $conn = new PDO(    $db_config['PDO_SGBD'] . ':host='. $db_config['PDO_HOST'] . ";",
                        //. 'dbname='. $db_config['PDO_DB_NAME'],
                        $db_config['PDO_USER'],
                        $db_config['PDO_PASSWORD'],
                        $db_config['PDO_OPTIONS']
                    );
        print_alert($db_config['PDO_SGBD'] . ':host='. $db_config['PDO_HOST'] . "Connexion is OK ", "success");
    } catch(PDOException $e) {
		print_alert($db_config['PDO_SGBD'] . ':host='. $db_config['PDO_HOST'] . "Connexion is KO " . $e->getMessage(), "danger");
    } finally {
        unset($db_config);
    }
	
	// 2) Create database
	$DB_NAME = "prenom_nom";
    $sql = sprintf("CREATE DATABASE IF NOT EXISTS $DB_NAME");
    try {
        $conn->exec($sql);
        print_alert("Database $DB_NAME CREATE is OK ", "success");
    } catch(PDOException $e) {
        //trigger_error($e->getMessage(), E_USER_ERROR);
        print_alert("Database $DB_NAME CREATE is KO " . $e->getMessage(), "danger");
    }
					
	// 3) Close connexion
	$conn = null;

    // 4) Connexion on dbname testdrive
    try {
        // specify your own database credentials
        $db_config = array();
        $db_config['PDO_SGBD']      = 'mysql';
        $db_config['PDO_PORT']      = '3306';
        $db_config['PDO_HOST']      = 'localhost' . ':' . $db_config['PDO_PORT'];
        $db_config['PDO_DB_NAME']   = 'prenom_nom';
        $db_config['PDO_USER']      = 'root';
        $db_config['PDO_PASSWORD']  = '';
        $db_config['PDO_OPTIONS']   = array(
			// Activation des exceptions PDO :
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // Change le fetch mode par défaut sur FETCH_ASSOC ( fetch() retournera un tableau associatif ) :
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $conn = new PDO(    $db_config['PDO_SGBD'] . ':host='. $db_config['PDO_HOST'] . ";"
                        . 'dbname='. $db_config['PDO_DB_NAME'],
                        $db_config['PDO_USER'],
                        $db_config['PDO_PASSWORD'],
                        $db_config['PDO_OPTIONS']
                    );
        print_alert($db_config['PDO_DB_NAME'] . " database connexion is OK ", "success");
    } catch(PDOException $e) {
        print_alert($db_config['PDO_DB_NAME'] . " database connexion is KO " . $e->getMessage(), "danger");
    } finally {
        unset($db_config);
    }
					
	// 5) Create table...
    // $sql = "CREATE TABLE person (id INT(6) AUTO_INCREMENT PRIMARY KEY, fname VARCHAR(30), lname VARCHAR(30), bday DATE, reg_date TIMESTAMP)";
    // $conn->query($sql);	

    // 6) Création lignes
?>

    <h2>POST</h2>
    <form action="bdd.php" method="POST">
        <label for="fname">First Name</label>
        <input type="text" name="fname">
        <label for="lname">Last Name</label>
        <input type="text" name="lname">
        <label for="Birthday">Birthday</label>
        <input type="date" name="bday">        
        <button>Add</button>
    </form>

    <h2>GET</h2>
    <form action="bdd.php" method="GET">
        <label for="fname">First Name</label>
        <input type="text" name="fname">
        <label for="lname">Last Name</label>
        <input type="text" name="lname">
        <label for="bday">Birthday</label>
        <input type="date" name="bday">        
        <button>Add</button>
    </form>

    <h2>UPDATE</h2>
    <form action="bdd.php" method="POST">
        <label for="fnameUpdate">ID</label>
        <input type="number" name="idUpdate">
        <label for="idUpdate">First Name</label>
        <input type="text" name="fnameUpdate">
        <label for="lnameUpdate">Last Name</label>
        <input type="text" name="lnameUpdate">
        <label for="bdayUpdate">Birthday</label>
        <input type="date" name="bdayUpdate">        
        <button>Add</button>
    </form>

<?php
        var_dump($_POST);
        var_dump($_GET);

    if (isset($_POST['fname'],$_POST['lname'],$_POST['bday']) && $_POST['fname'] !== "" && $_POST['lname'] !== "" && $_POST['bday'] !== "") {
        $sth = $conn->prepare("INSERT INTO person (fname, lname , bday, reg_date) VALUES (:fname, :lname, :bday, NOW())");
        $sth->bindValue(':fname',  $_POST['fname'], PDO::PARAM_STR);
        $sth->bindValue(':lname',  $_POST['lname'], PDO::PARAM_STR);
        $sth->bindValue(':bday',  $_POST['bday'], PDO::PARAM_STR);
        $sth->execute();
    }
    if (isset($_GET['fname'],$_GET['lname'],$_GET['bday']) && $_GET['fname'] !== "" && $_GET['lname'] !== "" && $_GET['bday'] !== "") {
        $sth = $conn->prepare("INSERT INTO person (fname, lname , bday, reg_date) VALUES (:fname, :lname, :bday, NOW())");
        $sth->bindValue(':fname',  $_GET['fname'], PDO::PARAM_STR);
        $sth->bindValue(':lname',  $_GET['lname'], PDO::PARAM_STR);
        $sth->bindValue(':bday',  $_GET['bday'], PDO::PARAM_STR);
        $sth->execute();
    }     
    // 7) UPDATE
    if (isset($_POST['fnameUpdate'],$_POST['lnameUpdate'],$_POST['bdayUpdate']) && $_POST['fnameUpdate'] !== "" && $_POST['lnameUpdate'] !== "" && $_POST['bdayUpdate'] !== "") {
        $sth = $conn->prepare("UPDATE person SET fname = :fnameUpdate, lname = :lnameUpdate, bday = :bdayUpdate WHERE id = :idUpdate");
        $sth->bindValue(':fnameUpdate',  $_POST['fnameUpdate'], PDO::PARAM_STR);
        $sth->bindValue(':lnameUpdate',  $_POST['lnameUpdate'], PDO::PARAM_STR);
        $sth->bindValue(':bdayUpdate',  $_POST['bdayUpdate'], PDO::PARAM_STR);
        $sth->bindValue(':idUpdate',  $_POST['idUpdate'], PDO::PARAM_INT);
        $sth->execute();
    }
    // 8) DELETE
    // $sql = "DELETE FROM book WHERE id= 1";
    // $conn->query($sql);	
	// En of PHP script : close connexion
	$conn = null;

?>