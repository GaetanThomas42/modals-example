<!-- INCLUDES -->
<?php 
    $page = __FILE__;
    include "./header.php";
    include "./navbar.php";
?>
<!-- bootstrap alert on JS events -->
<div id="alert"></div>
<!-- CHART -->
<div class="container mt-4">
    <h2>Prices Chart</h2>
    <canvas id="myChart" height="60vh" class="chart-container mt-4"></canvas>
</div>
<!-- CHART php -->
<?php 
// Select 20 books
    $sql = "SELECT id, title, price, editor, img FROM book WHERE 1 LIMIT 50";
    $mysqli = mysqli_connect("localhost", "root", "", "testdrive");
    $values = [];
    $labels = [];
    $colors = [];
    // Each book
    foreach($mysqli->query($sql) as $row) {
    // Title for labels
        array_push($labels,$row["title"]);
    // Price for values / data
        array_push($values,$row["price"]);
    // Color conditions
        if ($row["price"] < 10) {
            array_push($colors,"red");   
        }else if ($row["price"] < 20){
            array_push($colors,"orange");   
        }else if ($row["price"] < 30){
            array_push($colors,"yellow");   
        }else {
            array_push($colors,"green");   
        }
    }
?>
<!-- CHART js -->
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'Price',
                backgroundColor: <?php echo json_encode($colors); ?>,
                data: <?php echo json_encode($values); ?>
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    barThickness: 25,
                    gridLines: {
                        offsetGridLines: true
                    }
                }]
            }
        }
    });
</script>
<!-- Details Php-->
<?php
// COUNT
    $sql = "SELECT COUNT(id) FROM `book` WHERE 1";
    $mysqli = mysqli_connect("localhost", "root", "", "testdrive");
    $countBook;
    // Details row and buttons page
    echo '<div class="container"><div class="row text-center mt-3">';
    foreach($mysqli->query($sql) as $row) {
        // Book number
        echo "<h4 class='col-md-4'>Number of books : " .$row['COUNT(id)'] . "</h4>";
        $countBook = $row['COUNT(id)'];
    }
// all Price
    $sql = "SELECT price FROM `book` WHERE 1";
    $mysqli = mysqli_connect("localhost", "root", "", "testdrive");
    $sum = 0;
    foreach($mysqli->query($sql) as $row) {
        $sum += $row['price'];
    }
//Display AVG
    $avg = $sum / $countBook;
    $avgPrice = round($avg,2);
    // Book avg price and sum
    echo "<h4 class='col-md-4'>AveragePrice : " . $avgPrice . " €</h4><h4 class='col-md-4'>Sum of Prices : " . $sum . " €</h4>";
    $nbPages = round($countBook / 5,0);
//Buttons page    
    for ($i=0; $i < $nbPages; $i++) {
        // Onclick $i = nb page -> sql
        echo "<div class='col p-4 mt-3'><button class='btn btn-primary' onclick='changePage(" . $i . ");'>". $i ." <i class='far fa-sticky-note'></i></button></div>";
    }
    echo "</div></div></div>";    
?>
<!--Page button function JS  -->
<script>
    // On page button click
    function changePage(index) {
        // Ajax Post->index 
        $.post({
            url: "pageBook.php",
            data: {
                index: index
            }
        }).done(function (data) {
            // When query done -> display table with data 
            $("#tableBook").html(data);
        });
    }
</script>
<!-- Table and add btn -->
<div class='row mt-5'>
    <!-- ADD BOOK BUTTON -->
    <div class='col-md-1'>
        <button class='btn bg-success ml-5 p-3 text-light' onclick='getDetail(0);' data-toggle='modal'>
            <strong>ADD</strong> <i class="fas fa-2x fa-plus-circle mt-2"></i> </button>
    </div>
    <!-- TABLE -->
    <div class="col md-10">
        <div class="container">
            <table class='table text-center'>

                <thead class='thead-dark'>
                    <tr>
                        <th scope='col'>Index</th>
                        <th scope='col'>Img</th>
                        <th scope='col'>Title</th>
                        <th scope='col'>Price</th>
                        <th scope='col'>Editor</th>
                        <th scope='col'>Actions</th>
                    </tr>
                </thead>
                <tbody id='tableBook'>
                    <?php 
                    // SELECT 4 books for first display 
                            $mysqli = mysqli_connect("localhost", "root", "", "testdrive");
                            $sql = "SELECT id, title, price, editor, img FROM book ORDER BY id LIMIT 4";
                            foreach ($mysqli->query($sql) as $key => $row) {
                                echo "<tr>
                                        <th class='align-middle' scope=\'row\'>" . $row['id'] . "</th>
                                        <td class='align-middle'><img height='80px' width='110px'src='" . $row['img'] . "' alt='img'></td>
                                        <td class='align-middle'><h5>" . $row['title'] . "</h5></td>
                                        <td class='align-middle'><h6>" . $row['price'] . "</h6></td>
                                        <td class='align-middle'><h6>" . $row['editor'] . "</h6></td>
                                        <td class='align-middle'><button class='btn btn-info p-3'  onclick='getDetail(". $row['id'] .");' id='" . $row['id'] . "'><i class='fas fa-1x fa-cogs '></i></button>
                                            <button class='btn btn-danger m-2 p-3' onclick='removeConfirm(" . $row['id'] .");' id='" . $row['id'] . "'><i class='fas fa-1x fa-dumpster'></i></button>
                                        </td>
                                    </tr>"; 
                            }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Button JS -->
<script src="js/books.js"></script>
<!-- bootstrap modal edit + add -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <input type="text" id="hiddenId" style="display:none;">
                <h4 class="modal-title w-100 font-weight-bold" id="formTitle"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                    <input type="text" id="update_title" class="form-control validate ">
                    <label data-error="wrong" data-success="right" for="update_title" name="title">Title</label>
                </div>
                <div class="md-form mb-5">
                    <input type="email" id="update_editor" class="form-control validate ">
                    <label data-error="wrong" data-success="right" for="update_editor" name="editor">Editor</label>
                </div>

                <div class="md-form mb-4">
                    <input type="number" id="update_price" class="form-control validate " name="title">
                    <label data-error="wrong" data-success="right" for="update_price">Price</label>
                </div>

                <div class="md-form mb-4">
                    <input type="text" id="update_img" class="form-control validate " name="img">
                    <label data-error="wrong" data-success="right" for="update_img">Url Img</label>
                </div>

            </div>
            <button class="btn btn-success p-3 mb-3 mx-3" onclick="saveBook();"><i
                    class="fas fa-1x fa-check"></i></button>
        </div>
    </div>
</div>
<!-- bootstrap modal delete -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="text-center" id="deleteMsg"></h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok" onclick="remove();">Delete</a>
                <input type="text" id="deleteId" style="display:none;">
            </div>
        </div>
    </div>
</div>

</body>