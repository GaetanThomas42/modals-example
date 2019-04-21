<?php  
    include "./functionsPDO.php";
    $conn = connectDataBase('gaetan_thomas');
    $sth = $conn->prepare("INSERT INTO users (id_role, fname, email, upassword) VALUES (:id_role, :fname, :email, :upassword)");
    $sth->bindValue(':id_role',  $_POST['id_role'], PDO::PARAM_INT);
    $sth->bindValue(':fname',  $_POST['fname'], PDO::PARAM_STR);
    $sth->bindValue(':email',  $_POST['email'], PDO::PARAM_STR);
    $sth->bindValue(':upassword',  $_POST['upassword'], PDO::PARAM_STR);
    $sth->execute();
    

?>