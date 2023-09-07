<?php

# ----------- CORS
    // Specify domains from which requests are allowed
    header('Access-Control-Allow-Origin: *');
    // Specify which request methods are allowed
    header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
    // Additional headers which may be sent along with the CORS request
    header('Access-Control-Allow-Headers: X-Requested-With,Authorization,Content-Type');

//----- Timezone config
    date_default_timezone_set("America/Argentina/Buenos_Aires");

//----- Connection to database
    define('DB_SERVER','host');
    define('DB_NAME','db-name');
    define('DB_USER','root');
    define('DB_PASSWORD','');

//------ Default values
    define('PAGE', 0);
    define('LIMIT', 8);
