<?php 

# ------------ Importar código de flightphp
require 'vendor/flightphp/flight/Flight.php';


 #******************* ENDPOINTS **************************
    
    # --- Obtener todos los vehiculos
    Flight::route('/vehicles', function(){
        echo 'Hola mundo desde "Vehicles"';
    });
    
    # --- Obtener un vehiculo
    Flight::route('/vehicles/@id', function($id){
        echo 'Hola mundo desde "Vehicles" ('.$id.')';
    });
    
    # --- Obtener todas las categorias
    Flight::route('/marks', function(){
        echo 'Hola mundo desde "Categories"';
    });
    
    # --- Obtener todos los dueños
    Flight::route('/owners', function(){
        echo 'Hola mundo desde "Owners"';
        //Flight::json($response);
    });
    
    #************************************************

    # ------------ Iniciar API
    Flight::start();