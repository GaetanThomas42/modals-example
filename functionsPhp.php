<?php

// function print_alert($message, $class = "danger") {
//     echo "<div style='width:15vw;' class=\"alert  text-light bg-$class show\" role=\"alert\">";
//     echo $message;
//     echo '<button type="button" class="close text-light" data-dismiss="alert" aria-label="Close">';
//     echo '<span aria-hidden="true">&times;</span>';
//     echo '</button>';
//     echo '</div>';
// }
function connectBd() {
          // 1) specify your own database credentials
    $DB_PORT = '3306';
    $DB_HOST = 'localhost';
    $DB_USERNAME = 'root';
    $DB_PASSWORD = '';
    $DB_NAME ='testdrive';
    $TB_NAME = 'book';

    // 2) get connection
    // Connexion à une bdd MySQL avec l'invocation de pilote
    $dsn = "mysql:dbname=$DB_NAME;host=$DB_HOST:$DB_PORT";
    try {
        $conn = new PDO($dsn, $DB_USERNAME, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo"Connexion $DB_NAME KO." . $e->getMessage();
        return null;
    }finally{
        
    }
}
function chartQuery() {
    $conn = connectBd();
    $sql = "SELECT id, title, price, editor, img FROM book ORDER BY price DESC LIMIT 100";
    try {
        $result = $conn->query($sql);
        $values = [];
        $labels = [];
        $colors = [];
        // Each book
        foreach($conn->query($sql) as $row) {
        // Title for labels
            array_push($labels,$row["title"]);
        // Price for values / data
            array_push($values,$row["price"]);
        // Color conditions
            if ($row["price"] < 10) {
                array_push($colors,"red");   
            }else if ($row["price"] < 20){
                array_push($colors,"orange");   
            }else if ($row["price"] < 30){
                array_push($colors,"yellow");   
            }else {
                array_push($colors,"green");   
            }
        }
    } catch (PDOException $e) {
        print_alert("Error SELECT table $TB_NAME" . $e->getMessage(), "danger");
    }finally {

    }
    
}
function displayDetails() {
    $conn = connectBd();
// COUNT
    $sql = "SELECT COUNT(id) FROM `book` WHERE 1";
    try {
        $result = $conn->query($sql);
        $countBook;
        // Details row and buttons page
        echo '<div class="container"><div class="row text-center mt-3">';
        foreach($conn->query($sql) as $row) {
        // Book number
            echo "<h4 class='col-md-4'>Number of books : " .$row['COUNT(id)'] . "</h4>";
            $countBook = $row['COUNT(id)'];
        }
        
    } catch (PDOException $e) {
        print_alert("Error SELECT table $TB_NAME" . $e->getMessage(), "danger");
    }finally {}

 
    $sql = "SELECT price FROM `book` WHERE 1";
    try {
// all Price
    $sum = 0;
    foreach($conn->query($sql) as $row) {
        $sum += $row['price'];
    }
//Display AVG
    $avg = $sum / $countBook;
    $avgPrice = round($avg,2);
    // Book avg price and sum
    echo "<h4 class='col-md-4'>AveragePrice : " . $avgPrice . " €</h4><h4 class='col-md-4'>Sum of Prices : " . $sum . " €</h4>";
        echo "</div></div></div>"; 
    } catch (PDOException $e) {
        print_alert("Error SELECT table $TB_NAME" . $e->getMessage(), "danger");
    }finally {
        
    }
   }

?>