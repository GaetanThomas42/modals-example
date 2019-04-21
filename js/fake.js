function generate(){	
    
    // Le nb_name est récupéré dans le php
    nb_name = document.getElementById("num").value;
    
    //Si nb_name est vide => nb_name = 5
    if(nb_name == '' || nb_name < 0){
        nb_name = 5;
    }
    
    console.log(nb_name);
    
    // On complète le GET avec le nb_name
    var url = window.location.origin + '/public/api/faketest.php?nb_name=' + nb_name;

		noms = '';

	$.ajax({

		url: url,

		method: "GET",

		success: function(data) {
			$(jQuery.parseJSON(data)).each(function() {

				noms += '<a class="dropdown-item" href="#">'+ this.name +'</a>';

			});

			document.getElementById("faker").innerHTML = noms;

		},

		error: function(data) {

			console.log(data);

		}

	});

      

};