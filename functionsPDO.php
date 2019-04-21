<?php 

function print_alert($message, $class = "danger") {
    echo "<div style='width:15vw;' class=\"alert  text-light bg-$class show\" role=\"alert\">";
    echo $message;
    echo '<button type="button" class="close text-light" data-dismiss="alert" aria-label="Close">';
    echo '<span aria-hidden="true">&times;</span>';
    echo '</button>';
    echo '</div>';
}

function connectDb() {
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
}

function connectDataBase($DB_NAME) {

    try {
        // specify your own database credentials
        $db_config = array();
        $db_config['PDO_SGBD']      = 'mysql';
        $db_config['PDO_PORT']      = '3306';
        $db_config['PDO_HOST']      = 'localhost' . ':' . $db_config['PDO_PORT'];
        $db_config['PDO_DB_NAME']   = $DB_NAME;
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
        return $conn;
    } catch(PDOException $e) {
        print_alert($db_config['PDO_DB_NAME'] . " database connexion is KO " . $e->getMessage(), "danger");
    } finally {
        unset($db_config);
    }
}

function createDB($cnx, $DB_NAME) {
    $sql = sprintf("CREATE DATABASE IF NOT EXISTS $DB_NAME");
    try {
        $cnx->exec($sql);
        print_alert("Database $DB_NAME CREATE is OK ", "success");
    } catch(PDOException $e) {
        //trigger_error($e->getMessage(), E_USER_ERROR);
        print_alert("Database $DB_NAME CREATE is KO " . $e->getMessage(), "danger");
    }
}

?>
<script src="js/seedPDO.js"></script>

