<?php
include 'functionsPDO.php';
$conn = connectDataBase('gaetan_thomas');
$sth = $conn->prepare("DELETE FROM users WHERE id= :id");
$sth->bindValue(':id',  $_POST['id'], PDO::PARAM_INT);
$sth->execute();

?>