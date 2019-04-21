<?php
include 'functionsPhp.php'
connectBd();
$sth = $conn->prepare("DELETE FROM book WHERE id= :id");
$sth->bindValue(':id',  $_POST['id'], PDO::PARAM_INT);
$sth->execute();

?>