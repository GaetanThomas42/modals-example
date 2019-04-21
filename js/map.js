let currentSearch;

function initMap(addressJson) { //La fonction prend en parm la longitude et latitude
    //On efface la div qui contient la map afin de la rechargez lors d'une nouvelle recherche
    document.getElementById('mapContainer').innerHTML = null;
    //On recréé une div qui contient la map
    document.getElementById('mapContainer').innerHTML = "<div id='map' style='width: 80vw; height: 72vh;'></div>";
    // On crée un objet map dans la div avec l'id "map"
    let map = L.map('map').setView([addressJson.lat, addressJson.lon], 11); //
    // Leaflet never ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous sou
    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
        minZoom: 1,maxZoom: 20
    }).addTo(map);
    let marker = L.marker([addressJson.lat, addressJson.lon]).addTo(map);
    if (addressJson.address.town) {
        marker.bindPopup(`<p>${addressJson.address.town}, <small>${addressJson.address.state} lat: ${addressJson.lat} lon: ${addressJson.lon} </small> </p>`).openPopup();
    } else{
        marker.bindPopup(`<small>${addressJson.address.state} lat: ${addressJson.lat} lon: ${addressJson.lon}</small>`).openPopup();
    }
}

function searchAddress() {
    let address = document.getElementById('address').value;
    if (address !== "") { //Si le formulaire est bien rempli
        if (address != currentSearch) {
            document.getElementById('mapContainer').innerHTML = "<div id='map' style='width: 80vw; height: 72vh;'><img src='http://chittagongit.com//images/loading-icon-gif/loading-icon-gif-19.jpg' alt='loading'></div>";
            let url = window.location.origin + "/public/api/mapapi.php?address=" + address;
            $.ajax({
                url: url,
                method: "GET",
                success: function (data) {
                    currentSearch = address;
                    $(jQuery.parseJSON(data)).each(function () {                        
                        if (this.length !== 0) {
                            initMap(this);
                        } else {
                            alert("Adress not found!");
                        }
                    });
                },
                error: function (data) {
                    alert("Request failed!");
                    console.log(data);
                }
            });
        } else {
            alert("Enter other Address please!");
        }
    } else {
        alert("Enter an Address please!");
    }
}