<?php

# Uses
use Model\Tags;

# Models
require 'model/tags.model.php';

# Utils
include 'utils/query.util.php';
include 'utils/data.util.php';


class TagsController{

    static function getAll($vehicleID = null):array
    {
    //------------- Define pagination queries
        # If the parameter exists it takes its value, else it takes a default value defined in the system configurations 
        //$page = (isset($_GET['page']) && ($_GET['page'] > 0)) ? ($_GET['page'] - 1) : constant('PAGE');
        //$limit = (isset($_GET['limit'])) ? $_GET['limit'] : constant('LIMIT');
        
    //------------- Handler queries
        # The order of the data is defined for the parameters or it takes a default value
        //$order = (isset($_GET['order'])) ? Util\get_order($_GET['order']) : '';
        
        # Format the search options recived for parameters
        //$options = Util\formaterOptions($_GET ?? []);
        
        # Get the offset by multypling the page by the limit
        //$offset = $page * $limit;
        
        //-------------- Get data
        # Get vehicles
        $tags = ($vehicleID == null)
            ? Tags::getAll()
            : Tags::getAllByVehicle($vehicleID);

        # If the vehicles array has zero elements or its length is less than the $limit
        # Then the total of elements is the returned
        // $total = ((count($vehicles) < $limit && $page == 0))
        //     ? count($vehicles)
        //     : Tags::getTotal($options);
        

        if(!isset($vehicles['Error']))
        {
            return $tags;
            # If the tag filter doesn't exist, then its isn't showed
            // return [
            //     'page' => ((int)$page + 1),
            //     'limit' => (int)$limit,
            //     'total' => (int)$total,
            //     'data' => $vehicles
            // ];
        }
        else
        {
            return [
                'Error' => 500,
                'Message' => 'An error was detected'
            ];
        }
    }

}