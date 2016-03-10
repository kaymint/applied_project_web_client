<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 2/15/16
 * Time: 9:03 AM
 */

require_once 'adb_object.php';

class Vehicle extends adb_object{


    function Vehicle(){

    }


    function addVehicle(){

    }

    /**
     * Executes a query to fetch the details of vehicle by their license no.
     *
     * @param $license_no
     * @return bool
     */
    function getVehicleDetails($license_no){
        $str_query = "SELECT *
                      FROM vehicle V LEFT JOIN driver D
                      ON V.driver = D.PIN
                      WHERE V.license_no = '$license_no'";

        return $this->query($str_query);
    }
}