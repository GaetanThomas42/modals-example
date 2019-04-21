<?php       
        include 'functionsPDO.php';
        $conn = connectDataBase('gaetan_thomas');
        $sth = $conn->prepare("UPDATE users SET fname = :fname, email = :email, id_role = :id_role, upassword = :upassword WHERE id = :id");
        $sth->bindValue(':fname',  $_POST['fname'], PDO::PARAM_STR);
        $sth->bindValue(':email',  $_POST['email'], PDO::PARAM_STR);
        $sth->bindValue(':id_role',  $_POST['id_role'], PDO::PARAM_INT);
        $sth->bindValue(':upassword',  $_POST['upssaword'], PDO::PARAM_INT);
        $sth->execute();
    
?>