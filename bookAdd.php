<?php  
if (isset($_POST['title'],$_POST['editor'],$_POST['price'],$_POST['img']) && $_POST['title'] !== ""  && $_POST['editor'] !== ""  && $_POST['price'] !== "" && $_POST['img'] !== "") {


    include "./functionsPhp.php";
    connectBd();

    $sth = $conn->prepare("INSERT INTO book (title, price, editor, img) VALUES (:title, :price, :editor, :img)");
    $sth->bindValue(':title',  $_POST['title'], PDO::PARAM_STR);
    $sth->bindValue(':price',  $_POST['price'], PDO::PARAM_INT);
    $sth->bindValue(':editor',  $_POST['editor'], PDO::PARAM_STR);
    $sth->bindValue(':img',  $_POST['img'], PDO::PARAM_STR);
    $sth->execute();

    }


?>