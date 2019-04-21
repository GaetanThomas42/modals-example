<?php
       $page = basename(__FILE__);
       include "./header.php";
       include "./navbar.php";
   ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
    integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin="" />
<link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.css" />
<link rel="stylesheet" type="text/css"
    href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.Default.css" />
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>
<script type='text/javascript' src='https://unpkg.com/leaflet.markercluster@1.3.0/dist/leaflet.markercluster.js'>
</script>
<script type='text/javascript' src="js/map.js"></script>

<div class="container">
    <form method="post">
        <div class="form-group row mt-4">
            <label for="address" class="font-weight-bold">Address</label>
            <input type="string" id="address" class="offset-1 form-control col-md-6 col-sm-2 mx-3"
                placeholder="Ex : 1 place Example ">
            <button type="button" onclick="searchAddress()" class="offset-1 btn btn-info col-md-2 col-sm-2"
                id="cta1">Search</button>
        </div>
    </form>
    <title>Carte</title>
    <div id="mapContainer">
    </div>

</div>



<?php
    include "./footer.php";
  ?>