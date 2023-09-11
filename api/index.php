<?php 

    # ------------ System configs
    require 'config/app.php';

    # ------------ flightphp code
    require 'vendor/flightphp/flight/Flight.php';

    # ------------ Is more important instance this variable
    $PDO;

 #******************* ENDPOINTS **************************    
    # --- Get all vehicles
    Flight::route('/vehicles', function(){
        include 'controller/vehicles.controller.php';
        $response = VehiclesController::getAll();
        Flight::json($response);
    });
    
    # --- Get one vehicle
    Flight::route('/vehicles/@id', function($id){
        echo 'Hola mundo desde "Vehicles" ('.$id.')';
    });
    
    # --- Get all categories
    Flight::route('/marks', function(){
        echo 'Hola mundo desde "Categories"';
    });
    
    # --- Get all owners
    Flight::route('/owners', function(){
        echo 'Hola mundo desde "Owners"';
        //Flight::json($response);
    });
    
    #************************************************

    # ------------ Start API
    Flight::start();