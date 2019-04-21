<?php 
    $page = __FILE__;
    include "./header.php";
    include "./navbar.php";
?>

<form method="post">
    <div class="form-group row mt-4 border p-5">
        <label for="title" class="font-weight-bold col-sm-2 col-md-1">Title</label>
        <input type="text" name="title" id="title" class="form-control col-md-5 col-sm-4 mx-3" placeholder="SuperMan"
            value="">
        <label for="book" class="font-weight-bold col-sm-2 col-md-1">Editor</label>
        <input type="text" name="editor" id="editor" class="form-control col-md-4 col-sm-2 mx-3" placeholder="Toei"
            value="">
        <label for="book" class="font-weight-bold col-sm-2 col-md-1 mt-4">Img Url</label>
        <input type="text" name="img" id="img" class="form-control col-md-4 col-sm-2 mt-4" value="">
        <label for="book" class="font-weight-bold col-sm-2 col-md-1 mt-4  offset-4">Price</label>
        <input type="number" min="0" name="price" id="price" class="form-control col-md-2 col-sm-2 mt-4" placeholder="0"
            value="">
        <button type="button" class="btn btn-info col-md-1 col-sm-2 save mt-4" height="5vh" id="save">Save</button>
    </div>
</form>

<script>
      
    $('#save').click(function () {

            $.ajax({
                type: "POST",
                url: "bookEdit.php",
                data: {
                    id: <?php echo $_GET['id'] ?>,
                    title: $('#title').val(),
                    editor: $('#editor').val(),
                    price: $('#price').val(),
                    img: $('#img').val()
                }                
            }).done(function () {
                location.reload();
            });

    });

</script>