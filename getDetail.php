<?php
        include "./functionsPhp.php";
        
        $mysqli = mysqli_connect("localhost", "root", "", "testdrive");
        $sql = "SELECT id, title, editor, price, img FROM book WHERE id=". $_POST['id'];
        // var_dump($mysqli->query($sql));
        foreach ($mysqli->query($sql) as $key => $value) {
            echo json_encode($value); 
        }
        @$mysqli->close();

?> 