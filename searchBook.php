<?php 
$mysqli = mysqli_connect("localhost", "root", "", "testdrive");
$sql =  'SELECT id,title, price, editor, img FROM book WHERE LOWER(title) LIKE CONCAT(LOWER("' . $_POST['title'] . '"),"%")';

foreach  ($mysqli->query($sql) as $row) {
    echo "<div class='col-md-4'>
    <img height='80px' width='110px'src='" . $row['img'] . "' alt='img'>
    <h5>" . $row['title'] . "</h5>
    <h6>" . $row['price'] . "</h6>
    <h6>" . $row['editor'] . "</h6></div>";
}
?>