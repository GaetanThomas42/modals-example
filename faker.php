<?php
$page="faker";
include "./header.php";

include "./navbar.php";?>

<script src="./js/fake.js"></script>
<!-- Formulaire -->
<div class="container"><br/><br/>
        <!-- Important : Ne pas oublier le method="post" -->
    <form method="post">
        <div class="form-group">
            <label for="exampleInputNum">Combien de noms ?</label>
            <input type="number" name="num" class="form-control" id="num" aria-describedby="numHelp" placeholder="Nombre de noms" min="0" max="12">
        </div>
    </form>
    <!-- Le bouton exécute la fonction generate dans le javascript -->
    <button class="btn btn-primary" onclick="generate()">Envoyer</button>

    <br/><br/>
    
	<div class="dropdown">

		<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false";>

			Dropdown button

		</button>

		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="faker"></div>

	</div>

	

	<br/><br/>

</div>