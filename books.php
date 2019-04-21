<?php 
    $page = __FILE__;
    include "./header.php";
    include "./navbar.php";
?>

<div class="container mt-5">
<form method="post">
        <div class="form-group row mt-4">
            <label for="bookTitle" class="font-weight-bold">Search a Book</label>
            <input type="string" name="bookTitle" id="bookTitle" class="offset-1 form-control col-md-6 col-sm-2 mx-3">            
            <button type="submit" class="offset-1 btn btn-info col-md-2 col-sm-2"id="cta1">Search</button>
        </div>
    </form>
    <div id="booksFound" class="row my-5">
        <?php 
            if (isset($_POST["bookTitle"]) && $_POST["bookTitle"] !== "" ) {
            $mysqli = mysqli_connect("localhost", "root", "", "testdrive");
            $sql =  'SELECT id,title, price, editor, img FROM book WHERE LOWER(title) LIKE CONCAT(LOWER("' . $_POST['bookTitle'] . '"),"%")';
            
            foreach  ($mysqli->query($sql) as $row) {
                echo "<div class='col-md-4 col-sm-6'>
                <img height='80px' width='110px'src='" . $row['img'] . "' alt='img'>
                <h5>" . $row['title'] . "</h5>
                <h6>" . $row['price'] . "</h6>
                <h6>" . $row['editor'] . "</h6></div>";
            }
            }
            
        ?>
    </div>
</div>

