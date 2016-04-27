<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 2/15/16
 * Time: 9:03 AM
 */

require_once 'adb_object.php';

class Vehicle extends adb_object{


    /**
     * Vehicle constructor.
     */
    function __construct(){
        parent:: __construct();
    }


    /**
     * Add details of a new vehicle
     *
     * @param $license_no
     * @param $driver
     * @param $chassis
     * @param $model_yr
     * @param $color
     * @param $desc
     * @param $brand
     * @return bool|mysqli_stmt
     */
    function addVehicle($license_no, $driver, $chassis, $model_yr, $color, $desc, $brand){

        $str_query = "INSERT INTO vehicle(license_no, driver, chassis_no, model_year, color, description, brand)
                       VALUES(?,?,?,?,?,?,?) ";

        $stmt = $this->prepareQuery($str_query);

        if($stmt === false){
            return false;
        }

        $stmt->bind_param("sssssss", $license_no, $driver, $chassis, $model_yr, $color, $driver, $desc, $brand);

        $stmt->execute();

        return $stmt;
    }

    /**
     * Executes a query to fetch the details of vehicle by their license no.
     * @param $license_no
     * @return bool|mysqli_result
     */
    function getVehicleDetails($license_no){
        $str_query = "SELECT *
                      FROM vehicle V LEFT JOIN driver D
                      ON V.driver = D.PIN
                      WHERE V.license_no = ?";

        $stmt = $this->prepareQuery($str_query);

        if($stmt === false){
            return false;
        }

        $stmt->bind_param("s", $license_no);

        $stmt->execute();

        return $stmt->get_result();
    }
}