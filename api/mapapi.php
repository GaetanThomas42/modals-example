<?php
	// We are a browser and not a PHP robot ;-)
    $context = stream_context_create(
        array(
            "http" => array(
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko)  Chrome/50.0.2661.102 Safari/537.36"
            )
        )
    );
    $address = urlencode($_GET['address']);
    $url = "https://nominatim.openstreetmap.org/search?q=$address&format=json&addressdetails=1";
    // Return the json !
    echo file_get_contents("$url", false, $context);
?>