<?php    
    if (isset($_POST['title'],$_POST['editor'],$_POST['price'],$_POST['img']) && $_POST['title'] !== ""  && $_POST['editor'] !== ""  && $_POST['price'] !== "" && $_POST['img'] !== "") {
        $mysqli = mysqli_connect("localhost", "root", "", "testdrive");
        if (mysqli_connect_error()) {
            die('Erreur de connexion ('. mysqli_connect_errno() . ')' . mysqli_connect_error()); 
        }
        $stmt = $mysqli->prepare("UPDATE book SET title=?,price=?,editor=?,img=?  WHERE id=?;");
        $stmt->bind_param('sdssd', $_POST['title'],$_POST['price'], $_POST['editor'], $_POST['img'], $_POST['id']);
        $stmt->execute();
        $mysqli->close();
    }
?>