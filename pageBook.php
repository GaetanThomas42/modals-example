<?php
include "./functionsPhp.php";
$conn = connectBd();

if (isset( $_POST['index'])) {
    $index = $_POST['index'] * 3;
    $sql = "SELECT id, title, price, editor, img FROM book ORDER BY id LIMIT ". $index . ",4";
    $result = $conn->query($sql);
    $all = $result->fetchAll();
    foreach($all as $row){
        echo "<tr>
                <th class='align-middle' scope=\'row\'>" . $row['id'] . "</th>
                <td class='align-middle'><img height='100px' width='100px'src='" . $row['img'] . "' alt='img'></td>
                <td class='align-middle'><h5>" . $row['title'] . "</h5></td>
                <td class='align-middle'><h6>" . $row['price'] . "</h6></td>
                <td class='align-middle'><h6>" . $row['editor'] . "</h6></td>
                <td class='align-middle'><button class='btn btn-info m-2 p-3'  onclick='getDetail(". $row['id'] .");' id='" . $row['id'] . "'><i class='fas fa-2x fa-cogs '></i></button>
                    <button class='btn btn-danger m-2 p-3' onclick='removeConfirm(" . $row['id'] . ");' id='" . $row['id'] . "'><i class='fas fa-2x fa-dumpster'></i></button>
                </td>
            </tr>";
    }
}    
?>
