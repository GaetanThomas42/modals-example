<?php

    $page = __FILE__;
    include "./header.php";
    include "./navbar.php";

    // 1) specify your own database credentials
    $DB_PORT = '3306';
    $DB_HOST = 'localhost';
    $DB_USERNAME = 'root';
    $DB_PASSWORD = '';
    $DB_NAME ='testdrive';
    $TB_NAME = 'Voiture';

    // 2) get connection
    // Connexion à une bdd MySQL avec l'invocation de pilote
    $dsn = "mysql:dbname=$DB_NAME;host=$DB_HOST:$DB_PORT";
    try {
        $conn = new PDO($dsn, $DB_USERNAME, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        print_alert("Connexion $DB_NAME KO." . $e->getMessage(), "danger");
    }


    // 5) Drop de la table voiture avec exec => renvoie les caaprès exécution
     $sql = "DROP TABLE IF EXISTS $TB_NAME";
    // try {
    //     $result = $conn->exec($sql);
    //     var_dump ($result);
    //     print_alert("Suppression de la table $TB_NAME OK.", "success");
    // } catch (PDOException $e) {
    //     print_alert("Suppression de la table $TB_NAME échouée" . $e->getMessage(), "danger");
    // }

    // 5) Drop de la table voiture avec query => renvoie la commande SQL
    // $sql = "DROP TABLE IF EXISTS $TB_NAME";
    // try {
    //     $result = $conn->query($sql);
    //     var_dump ($result);
    //     print_alert("Suppression de la table $TB_NAME OK.", "success");
    // } catch (PDOException $e) {
    //     print_alert("Suppression de la table $TB_NAME échouée" . $e->getMessage(), "danger");
    // }

    
    // 6) Pour créer la table voiture
    // $sql = "CREATE TABLE IF NOT EXISTS $TB_NAME (
    //             id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //             title VARCHAR(30) NOT NULL,
    //             price DECIMAL (6,2) NOT NULL
    //         )";
    // try {
    //     $result = $conn->query($sql);
    //     var_dump ($result);
    //     print_alert("Création Table $TB_NAME OK.", "success");
    // } catch (PDOException $e) {
    //     print_alert("Erreur création table $TB_NAME" . $e->getMessage(), "danger");
    // }


    // // 7) Insertion données
    // //créer quatre voitures avec quatre prix sur une requete sql
    // $sql = "INSERT INTO $TB_NAME
    //             (title, price)
    //         VALUES
    //             ('Voiture 1', 80),
    //             ('Voiture 2', 40),
    //             ('Voiture 3', 150),
    //             ('Voiture 4', 110)
    //         ";

    // try {
    //     $result = $conn->exec($sql);
    //     var_dump ($result);
    //     print_alert("Création ligne dans table $TB_NAME OK.", "success");
    // } catch (PDOException $e) {
    //     print_alert("Erreur création ligne dans table $TB_NAME" . $e->getMessage(), "danger");
    // }


    // 8) Afficher les données avec un fetch dans un while
    $query = "SELECT id, title, price FROM $TB_NAME ORDER BY id LIMIT 5";
    try {
        //execute query
        $result = $conn->query($query);
//        $count = $result->rowCount();
        while($row = $result->fetch()) {
            // withassociative or numeric
            // var_dump ($row);
            echo "(" . $row['id'] . ")" ." ". $row[1] . " => ". $row['price'] . "€" ."<br>";
        }
    } catch (PDOException $e) {
        //echo '<br>Exception received: ',  $e->getMessage(), "\n";
        print_alert("Query $query not executed." . $e->getMessage(), "danger");
    } finally {
    }

    echo "<br>";

    // 8) Afficher les données avec fetchAll dans un foreach
    $query = "SELECT id, title, price FROM $TB_NAME ORDER BY id LIMIT 5";
    try {
        //execute query
        $result = $conn->query($query);
        $count = $result->rowCount();
        $all = $result->fetchAll();
        foreach($all as $value){
            echo "(" . $value['id'] . ")" ." ". $value[1] . " => ". $value['price'] . "€" ."<br>";
        }
    } catch (PDOException $e) {
        //echo '<br>Exception received: ',  $e->getMessage(), "\n";
        print_alert("Query $query not executed." . $e->getMessage(), "danger");
    } finally {
    }

    echo "<br>";

    // 8) Afficher les colonnes avec un fetchColumn
    $query = "SELECT id, title, price FROM $TB_NAME ORDER BY id LIMIT 5";
    try {
        //execute query
        $result = $conn->query($query);
        // $count = $result->rowCount();
        while($col = $result->fetchColumn(1)) {
            // withassociative or numeric
             var_dump ($col);
        }
    } catch (PDOException $e) {
        //echo '<br>Exception received: ',  $e->getMessage(), "\n";
        print_alert("Query $query not executed." . $e->getMessage(), "danger");
    } finally {
    }

    exit;