<?php 

# ------------ Importar configuraciones
require 'config/app.php';

# ------------ Importar código de flightphp
require 'vendor/flightphp/flight/Flight.php';

$PDO;

 #******************* ENDPOINTS **************************    
    # --- Obtener todos los vehiculos
    Flight::route('/vehicles', function(){
        include 'controller/vehicles.controller.php';
        $response = VehiclesController::getAll();
        Flight::json($response);
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