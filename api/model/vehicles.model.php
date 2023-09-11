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

    static function getAll(int $offset, int $limit) : array
    {
        # Call to the global variable $PDO
        global $PDO;

        # if $PDO is of type PDO, the following code will be executed
        if($PDO instanceof PDO){
            #------------------- CREATE QUERY
                # Create the basic query
                $sql = 'SELECT m.mark,v.version,v.model FROM vehicle v
                JOIN mark m ON m.id_mark = v.id_mark';

                # Add variations to the query for filter the search
                // if($options != null){
                //     $sql .= ' '.defineQueryByOptionsForProviders($options, 'p');
                // }

                # Order the results
                //$sql .= ' '.defineOrder($order);

                # Add the pagination
                $sql .= ' LIMIT :limit OFFSET :offset';
                
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
}