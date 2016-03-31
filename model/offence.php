<?php
/**
 * Created by PhpStorm.
 * User: Kenneth Mintah Mensah
 * Date: 2/15/16
 * Time: 9:08 AM
 */

require_once 'adb_object.php';

class Offence extends adb_object{

    /**
     * Offence constructor.
     */
    function __construct(){
        parent:: __construct();
    }


    /**
     * Executes a query to add an offence
     *
     * @param $vehicle_id
     * @param $location
     * @return bool
     */
    function addOffence($vehicle_id, $location){
        $str_query = "INSERT INTO offence SET
                      vehicle_id = ?,
                      location = ?";

        $stmt = $this->prepareQuery($str_query);

        if($stmt === false){
            return false;
        }

        $stmt->bind_param("ss", $vehicle_id, $location);

        $stmt->execute();

        return $stmt;
    }

    /**
     * Executes a query to get the offences by a driver
     *
     * @param $driver
     * @return bool
     */
    function getDriverOffence($driver){
        $str_query = "SELECT *
                      FROM offence O INNER JOIN vehicle V
                      ON O.vehicle_id = V.license_no
                      INNER JOIN driver D
                      ON V.driver = D.PIN
                      WHERE D.PIN = ?";

        $stmt = $this->prepareQuery($str_query);

        if($stmt === false){
            return false;
        }

        $stmt->bind_param("s", $driver);

        $stmt->execute();

        return $stmt->get_result();
    }
}