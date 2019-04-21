<!-- INCLUDES -->
<?php 
    $page = __FILE__;
    include "./header.php";
    include "./navbar.php";
    // 1) Connect to BD
    $conn = connectBD();
?>
<!-- bootstrap alert on JS events -->
<div id="alert"></div>
<!-- CHART -->
<div class="container mt-4">
    <h2 id='chartTitle'>Prices Chart</h2>
    <canvas id="myChart" height="70vh" class="chart-container mt-4"></canvas>
</div>
<!-- CHART php -->
<?php 
// Select 50 books
chartQuery();
?>
<!-- CHART js -->
<script> 
// On change input chart title
    function getTitle(){
        $("#chartTitle").html($("#chartInput").val()); 
        $("#chartTitle").show(); 
        $("#chartInput").hide(); 
    }

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
    displayDetails();
?>    
<div class="row mt-5">
    <input type="text" id="pageIndex" style="display:none;">
    <button class="btn-info offset-4 col-md-1" onclick="changePage('prev');" >-</button>
    <input class="text-center" type="text" onchange="changePage('manual');" id="manualPage">
    <button class="btn-info col-md-1" onclick="changePage('next');" >+</button>
</div>
<!--Page button function JS  -->
<script>
    // On page button click
    function changePage(action) {
        if (action === "prev") {
            $("#pageIndex").val( function(i, oldval) {
            return --oldval;
        });                
        }else if (action === "next") {
            $("#pageIndex").val( function(i, oldval) {
                return ++oldval;
            });                
        }else if (action === "manual"){
            $("#pageIndex").val($("#manualPage").val());
        }
        $.post({
            url: "pageBook.php",
            data: {
                index: $("#pageIndex").val(),
            }
        }).done(function (data) {
            // When query done -> display table with data 
            $("#tableBook").html(data);
        });
    }
</script>
<!-- Table and add btn -->
<div class='row mt-3'>
    <!-- ADD BOOK BUTTON -->
    <div class='col-md-1 col-sm-12'>
        <button class='btn bg-success ml-4  text-light' onclick='getDetail(0);' data-toggle='modal'>
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
                            $sql = "SELECT id, title, price, editor, img FROM book ORDER BY id LIMIT 4";
                            try {
                                $result = $conn->query($sql);
                                $all = $result->fetchAll();
                                foreach($all as $row){
                                    echo "<tr>
                                            <th class='align-middle' scope=\'row\'>" . $row['id'] . "</th>
                                            <td class='align-middle'><img height='80px' width='110px'src='" . $row['img'] . "' alt='img'></td>
                                            <td class='align-middle'><h5>" . $row['title'] . "</h5></td>
                                            <td class='align-middle'><h6>" . $row['price'] . "</h6></td>
                                            <td class='align-middle'><h6>" . $row['editor'] . "</h6></td>
                                            <td class='align-middle'>
                                                <button class='btn btn-info p-3'  onclick='getDetail(". $row['id'] .");' id='" . $row['id'] . "'><i class='fas fa-1x fa-cogs '></i></button>
                                                <button class='btn btn-danger m-2 p-3' onclick='removeConfirm(" . $row['id'] .");' id='" . $row['id'] . "'><i class='fas fa-1x fa-dumpster'></i></button>
                                            </td>
                                        </tr>";
                                }
                            } catch (PDOException $e) {
                                    print_alert("Error SELECT table $TB_NAME" . $e->getMessage(), "danger");
                                }finally {
                                    
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
                    <label id="update_title_label" class="labelCheck"></label>
                    <input type="text" id="update_title" class="form-control validate " onchange="controlForm('update_title')">
                    <label data-error="wrong" data-success="right" for="update_title" name="title">Title</label>
                </div>
                <div class="md-form mb-5">
                <label id="update_editor_label" class="labelCheck"></label>
                    <input type="email" id="update_editor" class="form-control validate " onchange="controlForm('update_editor')">
                    <label data-error="wrong" data-success="right" for="update_editor" name="editor">Editor</label>
                </div>

                <div class="md-form mb-4">
                    <label id="update_price_label" class="labelCheck"></label>
                    <input type="number" id="update_price" class="form-control validate " onchange="controlForm('update_price')" name="title">
                    <label data-error="wrong" data-success="right" for="update_price">Price</label>
                </div>

                <div class="md-form mb-4">
                    <label id="update_img_label" class="labelCheck"></label>
                    <input type="text" id="update_img" class="form-control validate " onchange="controlForm('update_img')" name="img">
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
