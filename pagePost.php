<?php
  $page = __FILE__;
include "./header.php"; 
include "./navbar.php";
?>
<form method="post" class='mt-4'>
    <h2>Pow calculation</h2>
  <div class="form-group row mt-5">
    <label class="col-md-1 col-form-label">Number</label>
    <div class="col-md-4">
      <input type="number" class="form-control" id="number" name="number">
    </div>
    <label class="col-md-1 col-form-label">Pow</label>
    <div class="col-md-4">
      <input type="number" class="form-control" name="pow">
    </div>
    <button type='submit' class='btn btn-primary'>Envoyer</button>
  </div>
</form>

<?php
if (isset($_POST['number'],$_POST['pow']) && $_POST['number'] !== "" && $_POST['pow'] !== "") {
    $res = pow($_POST['number'],$_POST['pow']);
    echo "<h2 class='jumbotron p-5'>Result$res</h2>";
}
include "./footer.php";
?>
