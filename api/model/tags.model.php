<?php

# Namespace
namespace Model;

# Variables
global $PDO;

# Uses
use PDO, PDOException;
use DB\Database;
use Util;

#----- BD CONNECTION
if(!isset($PDO)){
    require 'config/database.php';
    $database = new Database();
    $PDO = $database->connect();
}

class Tags{
    
    static function getTotal():array
    {
        return [];
    }

      /////////////////////////////////////////////// 
     /////////////////// GET ALL ///////////////////
    ///////////////////////////////////////////////
    static function getAll() : array
    {
        # Call to the global variable $PDO
        global $PDO;

        # if $PDO is of PDOException type, the following code will be executed
        if($PDO instanceof PDOException){
            return [
                'Error'=>500,
                'Message'=>'Ocurrio un error al conectarse a la base de datos',
                'Error-Message' => $PDO->getMessage()
            ];
        }

        # if $PDO isn't of PDOException type, then will be of PDO type
            #------------------- CREATE QUERY
                # Create the basic query
                $sql = "SELECT * FROM tag";
    
            #-------------------- PREPARE AND EXECUTE QUERY
                $query = $PDO->query($sql);

                # Get array with the received data
                $data = $query->fetchAll(PDO::FETCH_ASSOC);

            # Return response;
            return $data;
    }

      /////////////////////////////////////////////////////////
     /////////////////// GET ALL BY VEHICLE //////////////////
    /////////////////////////////////////////////////////////
    static function getAllByVehicle(string $vehicleID)
    {
        # Call to the global variable $PDO
        global $PDO;

        # if $PDO is of PDOException type, the following code will be executed
        if($PDO instanceof PDOException){
            return [
                'Error'=>500,
                'Message'=>'Ocurrio un error al conectarse a la base de datos',
                'Error-Message' => $PDO->getMessage()
            ];
        }

        # if $PDO isn't of PDOException type, then will be of PDO type
            #------------------- CREATE QUERY
                # Create the basic query
                $sql = "SELECT t.id_tag, t.tag as name
                FROM vehicle_tag vt
                JOIN tag t ON t.id_tag = vt.id_tag
                WHERE vt.id_vehicle = :id";

            #-------------------- PREPARE AND EXECUTE QUERY
                # Preparamos the query
                $query = $PDO->prepare($sql);

                # Define the parameters values
                $query->bindParam(':id', $vehicleID);

                # EXecute the query
                $query->execute();

                # Get array with the received data
                $data = $query->fetchAll(PDO::FETCH_ASSOC);

            # Return response;
            return $data;
    }

      ///////////////////////////////////////////////
     /////////////////// GET ONE /////////////////// 
    ///////////////////////////////////////////////  
    static function getOne($id)
    {
        # Call to the global variable $PDO
        global $PDO;

        # if $PDO is of PDOException type, the following code will be executed
        if($PDO instanceof PDOException){
            return [
                'Error'=>500,
                'Message'=>'Ocurrio un error al conectarse a la base de datos',
                'Error-Message' => $PDO->getMessage()
            ];
        }

        # if $PDO isn't of PDOException type, then will be of PDO type
            #------------------- CREATE QUERY
                # Create the basic query
                $sql = "SELECT * 
                FROM tag
                WHERE id_tag = :id";

            #-------------------- PREPARE AND EXECUTE QUERY
                # Preparamos the query
                $query = $PDO->prepare($sql);

                # Define the parameters values
                $query->bindParam(':id', $id);

                # EXecute the query
                $query->execute();

                # Get array with the received data
                $data = $query->fetch(PDO::FETCH_ASSOC);

            # Return response;
            return $data;
    }

}