$(function() {
    $('#modalForm').on('hide.bs.modal', function () {        
        $(".labelCheck").html("");
      });
});

function checkForm() {

    if ($('#update_title').val() !== "" && $('#update_img').val() !== "" && $('#update_price').val() !== "" && $('#update_editor').val() !== "") {
        return true;
    } else {
        return false;
    }
}
function getDetail(idBook) {
//If add book
    if (idBook === 0) {
// Delete the value of fields to add a new book                                                                 
        $('.validate').each(function(){
            this.value = "";
        });
        //Delete the labels content 

    } else {
        $.post(
            "getDetail.php", {
                id: idBook
            },
            function (data, status) {
                // PARSE json data 
                var book = JSON.parse(data);
                // // Assign existing values to the modal popup fields                                                                 
                $("#update_title").val(book.title);
                $("#update_price").val(book.price);
                $("#update_editor").val(book.editor);
                $("#update_img").val(book.img);
                $("#formTitle").html("Edit your Book");
                $("#hiddenId").val(idBook);
            }
        );
    }
    // Open modal popup                                                                                                                 
    $("#modalForm").modal("show");
}

function saveBook() {

    if ($("#hiddenId").val() == 0) {

        if (checkForm()) {
            $.ajax({
                type: "POST",
                url: "bookAdd.php",
                data: {
                //Get input value 
                    title: $('#update_title').val(),
                    editor: $('#update_editor').val(),
                    price: $('#update_price').val(),
                    img: $('#update_img').val()
                }

            }).done(function () {
                $("#modalForm").modal("hide");
                $("#alert").html("<div style='position:fixed;top:0;right:50%;' class='alert alert-success alert-dismissible fade show' role='alert'>Add Success<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
                changePage(0);

            });

        }else{

            $('.validate').each(function(){
                controlForm(this.id);                
            });
        }
    } else {

        if (checkForm()) {

            $.ajax({
                type: "POST",
                url: "bookEdit.php",
                data: {
                    id: $("#hiddenId").val(),
                    title: $('#update_title').val(),
                    editor: $('#update_editor').val(),
                    price: $('#update_price').val(),
                    img: $('#update_img').val()
                }

            }).done(function () {
                changePage(0);
            });
        }
    }
}
function controlForm(id){    
    if ($(`#${id}`).val() === "") {
        $(`#${id}_label`).html("Fill this field please!");
        $(`#${id}_label`).css("color","red");
    }else{
        $(`#${id}_label`).html("");
    }
}
function removeConfirm(idBook) {

    $("#deleteId").val(idBook);
    $("#deleteMsg").html(`Are you sure to delete book n°${idBook} ?`);
    $("#confirm-delete").modal("show");
}
function remove() {

    $.ajax({
        type: "POST",
        url: "removeBook.php",
        data: {
            id: $("#deleteId").val()
        }

    }).done(function () {
        $("#confirm-delete").modal("hide"); 
        $("#alert").html("<div style='position:fixed;top:0;right:50%' class='alert alert-danger alert-dismissible fade show' role='alert'><h3>Delete Success</h3><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        changePage(0);
    });
}