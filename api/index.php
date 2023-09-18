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

    # --- Get all vehicles by one tag 
    Flight::route('/vehicles/tag/@id', function($id){
        include 'controller/vehicles.controller.php';
        $response = VehiclesController::getAllByTag($id);
        Flight::json($response);
    });
    
    # --- Get one vehicle
    Flight::route('/vehicles/@id', function($id){
        include 'controller/vehicles.controller.php';
        $response = VehiclesController::getOne($id);
        Flight::json($response);
    });
    
    # --- Get all categories
    Flight::route('/marks', function(){
        echo 'Hola mundo desde "Categories"';
    });

    # --- Get all tags
    Flight::route('/tags', function(){
        include 'controller/tags.controller.php';
        $response = TagsController::getAll();
        Flight::json($response);
    });
    
    # --- Get all owners
    Flight::route('/owners', function(){
        echo 'Hola mundo desde "Owners"';
        //Flight::json($response);
    });
    
    #************************************************

    # ------------ Start API
    Flight::start();