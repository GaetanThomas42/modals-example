// $(function() {
//     $('#modalForm').on('hide.bs.modal', function () {        
//         $(".labelCheck").html("");
//       });
// });
// $(document).ready(function () {
//     window.setTimeout(function() {
//         $(".alert").fadeTo(1000, 50).slideUp(1000, function(){
//             $(this).remove();
//         });
//     }, 1000);
// });

function getDetail(iduser) {
//If add book
    if (iduser === 0) {

        //Delete the labels content 

    } else {
        $.post(
            "userDetail.php", {
                id: iduser
            },
            function (data) {
                // PARSE json data
                // // Assign existing values to the modal popup fields  
                console.log(data);
            }
        );
    }
    // Open modal popup                                                                                                                 
    $("#modalForm").modal("show");
}

function saveBook() {

    if ($("#hiddenId").val() == 0) {

            $.ajax({
                type: "POST",
                url: "userAdd.php",
                data: {
                //Get input value 
                    fname: $('#fname').val(),
                    email: $('#email').val(),
                    id_role: $('#id_role').val(),
                    upassword: $('#upassword').val()
                }

            }).done(function () {
                $("#modalForm").modal("hide");
                $("#alert").html("<div style='position:fixed;top:0;right:50%;' class='alert alert-success alert-dismissible fade show' role='alert'>Add Success<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        
            });

    } else {

            $.ajax({
                type: "POST",
                url: "userEdit.php",
                data: {
                    id: $("#hiddenId").val(),
                    fname: $('#fname').val(),
                    email: $('#email').val(),
                    id_role: $('#id_role').val(),
                    upassword: $('#upassword').val()
                }

            }).done(function () {
                    });
        
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
        url: "removeUser.php",
        data: {
            id: $("#deleteId").val()
        }

    }).done(function () {
        $("#confirm-delete").modal("hide"); 
        $("#alert").html("<div style='position:fixed;top:0;right:50%' class='alert alert-danger alert-dismissible fade show' role='alert'><h3>Delete Success</h3><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
    });
}