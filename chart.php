<?php
$page = __FILE__;
include "./header.php";
include "./navbar.php";

$userLabels = [];
$userDatas = [];
$currentMonth = date("n");
$datas = [100,20,30,40,50,40,10,40,50,40,30,20];
?>
<form method="post" class='mt-4'>
    <h2>Pow calculation</h2>
  <div class="form-group row mt-5">

    <label class="col-md-1 col-form-label">Nombre de mois</label>
    <div class="col-md-3">
      <input type="number" class="form-control" id="nbMonth" name="nbMonth">
    </div>

    <label class="col-md-1 col-form-label">Label Name</label>
    <div class="col-md-3">
      <input type="text" class="form-control" id="labelName" name="userLabel">
    </div>
    <label class="col-md-1 col-form-label">Color</label>
    <div class="col-md-1">
      <input type="color" class="form-control" id="colorChart" name="colorChart">
    </div>
    <button type='submit' class='btn btn-primary'>Envoyer</button>
  </div>
</form>
<?php
if (isset($_POST['nbMonth'],$_POST['userLabel']) && $_POST['nbMonth'] !== "" && $_POST['userLabel'] !== ""){
  //Remplissage du tableau
  for ($month = 0; $month <=11; $month++) {
    array_push($userLabels,date('F',mktime(0,0,0,$month,1)));
    // array_push($userDatas,rand(0,100));
}
//Tri du tableau
for ($i=1; $i <= $currentMonth; $i++) { 
  array_push($userLabels,array_shift($userLabels));
  // array_push($userDatas,array_shift($userDatas));
}
//Nombre d'éléments a supprimer
$nbPop = intval(count($userLabels) - $_POST['nbMonth']);

for ($i=0; $i < $nbPop; $i++) { 
  array_pop($userLabels);
  // array_pop($userDatas);
}
?>
  <canvas id="myChart" class="chart-container"></canvas>
  <script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
      // The type of chart we want to create
      type: 'radar',
      // The data for our dataset
      data: {
        labels: <?php echo json_encode($userLabels); ?>,
        datasets: [{
            label: <?php echo "'". $_POST['userLabel'] ."'"; ?>,
            backgroundColor: <?php echo "'". $_POST['colorChart'] ."'"; ?>,
            borderColor: '#666',
            data: <?php echo json_encode($datas); ?> 
        }]
    },
    options: {
      animation: {
					duration: 2000,
					onProgress: function(animation) {
						progress.value = animation.currentStep / animation.numSteps;
					},
					onComplete: function() {
						window.setTimeout(function() {
							progress.value = 0;
						}, 2000);
					}
				}
    }
  });
  </script>
<?php  
}
?>

<?php
  include "./footer.php";
?>