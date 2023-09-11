<?php

# Uses
use Model\Vehicles;

# Models
require 'model/vehicles.model.php';

# Utils
include 'utils/query.util.php';


class VehiclesController{

    static function getAll():array
    {
    //------------- Define pagination queries
        # If the parameter exists it takes its value, else it takes a default value defined in the system configurations 
        $page = (isset($_GET['page']) && ($_GET['page'] > 0)) ? ($_GET['page'] - 1) : constant('PAGE');
        $limit = (isset($_GET['limit'])) ? $_GET['limit'] : constant('LIMIT');
        
    //------------- Handler queries
        # The order of the data is defined for the parameters or it takes a default value
        //$order = (isset($_GET['order'])) ? formaterOrder($_GET['order']) : constant('ORDER');
        
        # Format the search options recived for parameters
        //$options = formaterOptions($_GET ?? []);
        
        # Get the offset by multypling the page by the limit
        $offset = $page * $limit;
                
    //-------------- Send variables to the Model
        $data = Vehicles::getAll($offset, $limit);
        return $data;            
    }

}