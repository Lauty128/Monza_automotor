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

    ////////////////////////////////////////////////////////
    //////////////////// GET ALL ///////////////////////////
    ////////////////////////////////////////////////////////
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
    
        # If the vehicles array has zero elements or its length is less than the $limit (in the page 0)
        # Then the total of elements is the returned
        $total = ((count($vehicles) < $limit && $page == 0))
            ? count($vehicles)
            : Vehicles::getTotal($options);
        

        if(is_int($total) && !isset($vehicles['Error']))
        {
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

    ///////////////////////////////////////////////////////////////
    /////////////////////// GET ALL BY TAG ////////////////////////
    ///////////////////////////////////////////////////////////////
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
    
        # If the vehicles array has zero elements or its length is less than the $limit (in the page 0)
        # Then the total of elements is the returned
        $total = ((count($vehicles) < $limit && $page == 0))
            ? count($vehicles)
            : Vehicles::getTotalByTag($tagID, $options);
        

        if(is_int($total) && !isset($vehicles['Error']))
        {
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

    ////////////////////////////////////////////////////////
    //////////////////// GET ONE ///////////////////////////
    ////////////////////////////////////////////////////////
    static function getOne($id)
    {  
        try{
            $vehicle = Vehicles::getOne($id);
    
            if(!isset($vehicle['Error']) && isset($vehicle['id_vehicle'])){
                # Get a list of tags wich has the vehicle
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