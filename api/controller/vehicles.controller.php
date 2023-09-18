<?php

# Uses
use Model\Vehicles;
use Model\Tags;

# Models
require 'model/vehicles.model.php';
require 'model/tags.model.php';

# Utils
include 'utils/query.util.php';
include 'utils/data.util.php';


class VehiclesController{

    static function getAll():array
    {
    //------------- Define pagination parameters
        # If the parameter exists it takes its value, else it takes a default value defined in the system configurations 
        $page = (isset($_GET['page']) && ($_GET['page'] > 0)) ? ($_GET['page'] - 1) : constant('PAGE');
        $limit = (isset($_GET['limit'])) ? $_GET['limit'] : constant('LIMIT');
        
    //------------- Handler parameters
        # The order of the data is defined for the parameters or it takes a default value
        $order = (isset($_GET['order'])) ? Util\get_order($_GET['order']) : '';
        
        # Format the search options recived for parameters
        $options = Util\formaterOptions($_GET ?? []);
        
        # Get the offset by multypling the page by the limit
        $offset = $page * $limit;
        
        //-------------- Get data
        # Get vehicles
        $vehicles = Vehicles::getAll($offset, $limit, $options, $order);
    
        # If the vehicles array has zero elements or its length is less than the $limit
        # Then the total of elements is the returned
        $total = ((count($vehicles) < $limit && $page == 0))
            ? count($vehicles)
            : Vehicles::getTotal($options);
        

        if(is_int($total) && !isset($vehicles['Error']))
        {
            # If the tag filter doesn't exist, then its isn't showed
            return [
                'page' => ((int)$page + 1),
                'limit' => (int)$limit,
                'total' => (int)$total,
                'data' => $vehicles
            ];
        }
        else
        {
            return [
                'Error' => 500,
                'Message' => 'An error was detected'
            ];
        }
    }

    static function getAllByTag($tagID):array
    {
    //------------- Define pagination parameters   
        # If the parameter exists it takes its value, else it takes a default value defined in the system configurations 
        $page = (isset($_GET['page']) && ($_GET['page'] > 0)) ? ($_GET['page'] - 1) : constant('PAGE');
        $limit = (isset($_GET['limit'])) ? $_GET['limit'] : constant('LIMIT');
        
    //------------- Handler parameters
        # The order of the data is defined for the parameters or it takes a default value
        $order = (isset($_GET['order'])) ? Util\get_order($_GET['order']) : '';
        
        # Format the search options recived for parameters
        $options = Util\formaterOptions($_GET ?? []);
        
        # Get the offset by multypling the page by the limit
        $offset = $page * $limit;
        
        //-------------- Get data
        # Get vehicles
        $vehicles = Vehicles::getAllByTag($tagID, $offset, $limit, $options, $order);
    
        # If the vehicles array has zero elements or its length is less than the $limit
        # Then the total of elements is the returned
        $total = ((count($vehicles) < $limit && $page == 0))
            ? count($vehicles)
            : Vehicles::getTotalByTag($options);
        

        if(is_int($total) && !isset($vehicles['Error']))
        {
            # If the tag filter doesn't exist, then its isn't showed
            return [
                'page' => ((int)$page + 1),
                'limit' => (int)$limit,
                'total' => (int)$total,
                'data' => $vehicles
            ];
        }
        else
        {
            return [
                'Error' => 500,
                'Message' => 'An error was detected'
            ];
        }
    }

    static function getOne($id)
    {  
    //-------------- Send variables to the Model
        # Get total of data
        try{
            $vehicle = Vehicles::getOne($id);
    
            if(!isset($vehicle['Error']) && isset($vehicle['id_vehicle'])){
                $tags = Tags::getAllByVehicle($id);
    
                if(!isset($tags['Error'])){
                    return [
                        ...$vehicle,
                        'tags' => $tags
                    ];
                }
            }
            else{ throw new Exception("Error al consultar los datos"); }
        }
        catch(Exception $e){
            return [
                'Error' => 500,
                'Message' => $e
            ];
        }
    }

}