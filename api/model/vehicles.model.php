<?php

/*
    VEHICLE TABLE STRUCTURE
    ---------------------------------------
	id_vehicle VARCHAR(22) not null
    id_mark INT(2) not null
    id_owner INT(2) not null
    version VARCHAR(50) not null
    model INT(4) not null
    engine VARCHAR(8) not null
    fuel VARCHAR(10)
    color VARCHAR(15)
    traction VARCHAR(10)
    transmission VARCHAR(20) not null
    type VARCHAR(15) not null
    image TEXT not null
    images TEXT
    km INT(8)
    created_at TIMESTAMP not null
*/

# Namespace
namespace Model;

# Variables
global $PDO;

# Uses
use PDO, PDOException;
use DB\Database;
use Util;

#----- BD CONNECTION
require 'config/database.php';
$database = new Database();
$PDO = $database->connect();

#Includes


class Vehicles{

    static function getTotal(array | null $options):int | array
    {
        # Call to the global variable $PDO
        global $PDO;

        # if $PDO is of type PDO, the following code will be executed
        if($PDO instanceof PDO)
        {
        #----------- Create query
            $sql = "SELECT COUNT(v.id_vehicle) as total FROM vehicle v ";

            if(isset($options['mark']) || isset($options['word'])){
                $sql .= 'JOIN mark m ON m.id_mark = v.id_mark ';
            }
            
            if($options !== null){
                $sql .= " ".Util\get_where($options);
            }
            
        #----------- Execute query
            $query = $PDO->query($sql);

        #----------- Get the response of the 'total' field
            $response = $query->fetch(PDO::FETCH_ASSOC)['total'];

            # return response
            return $response;
        }
        # if $PDO is of type PDOException, the following code will be executed
        else if($PDO instanceof PDOException){
            return [
                'Error'=>500,
                'Message'=>'Ocurrio un error al conectarse a la base de datos',
                'Error-Message' => $PDO->getMessage()
            ];
        }
    }

    
    static function getAll(int $offset, int $limit, array | null $options, string $order) : array
    {
        # Call to the global variable $PDO
        global $PDO;

        # if $PDO is of type PDO, the following code will be executed
        if($PDO instanceof PDO){
            #------------------- CREATE QUERY
                # Create the basic query
                $sql = "SELECT v.id_vehicle,v.id_mark,m.mark,v.version,v.model,v.engine,v.image,v.traction,v.price
                FROM vehicle v 
                JOIN mark m ON m.id_mark = v.id_mark";
                
                if($options !== null){
                    $sql .= " ".Util\get_where($options);
                }

                # Order the results
                $sql .= ' '.$order;

                # Add the pagination
                $sql .= ' LIMIT :limit OFFSET :offset';
                //var_dump($sql); exit();
            #-------------------- PREPARE AND EXECUTE QUERY
                # Preparamos the query
                $query = $PDO->prepare($sql);

                # Define the parameters values
                $query->bindParam(':limit', $limit);
                $query->bindParam(':offset', $offset);

                # EXecute the query
                $query->execute();

                # Get array with the received data
                $data = $query->fetchAll(PDO::FETCH_ASSOC);

            # Return response;
            return $data;
        }
        # if $PDO is of type PDOException, the following code will be executed
        else if($PDO instanceof PDOException){
            return [
                'Error'=>500,
                'Message'=>'Ocurrio un error al conectarse a la base de datos',
                'Error-Message' => $PDO->getMessage()
            ];
        }
    }

    static function getOne($id)
    {

    }
}