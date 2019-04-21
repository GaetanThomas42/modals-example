<?php    
        include "./functionsPDO.php";
        $conn = connectDataBase("gaetan_thomas");
        $sql = "SELECT id, fname, email, upassword FROM users WHERE id=". $_GET['id'];
        foreach ($conn->query($sql) as $key => $value) {
            echo json_encode($value); 
        }

?> 