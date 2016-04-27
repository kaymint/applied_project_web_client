<?php
/**
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
     * @param $vehicle_id
     * @param $location
     * @return bool|mysqli_stmt
     */
    function addOffence($vehicle_id, $location){
        $str_query = "INSERT INTO offence SET
                      vehicle_id = ?,
                      location = ?,
                      date = ?";

        $stmt = $this->prepareQuery($str_query);

        $date = date("Y-m-d");

        if($stmt === false){
            return false;
        }

        $stmt->bind_param("sss", $vehicle_id, $location, $date);

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
        $str_query = "SELECT
                      D.first_name,
                      D.last_name,
                      D.initial,
                      V.license_no,
                      V.chassis_no,
                      V.description,
                      V.model_year,
                      V.color,
                      V.brand,
                      O.offence_id,
                      O.location,
                      O.date,
                      O.time,
                      D.PIN,
                      D.phone,
                      D.expiry_date,
                      D.address
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


    /**
     * @param $driver
     * @return bool|mysqli_result
     */
    function getNumDriverOffences($driver){
        $str_query = "SELECT
                      COUNT(*) AS numOffences
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


    /**
     * @param $vehicle_no
     * @return bool|mysqli_result
     */
    function getVehicleOffenceHistory($vehicle_no){
        $str_query = "SELECT
                      D.first_name,
                      D.last_name,
                      D.initial,
                      V.license_no,
                      V.chassis_no,
                      V.description,
                      V.model_year,
                      V.color,
                      V.brand,
                      O.offence_id,
                      O.location,
                      O.date,
                      O.time,
                      D.PIN,
                      D.phone,
                      D.expiry_date,
                      D.address
                    FROM offence O INNER JOIN vehicle V
                        ON O.vehicle_id = V.license_no
                      INNER JOIN driver D
                        ON V.driver = D.PIN
                    WHERE V.license_no = ?";

        $stmt = $this->prepareQuery($str_query);

        if($stmt === false){
            return false;
        }

        $stmt->bind_param("s", $vehicle_no);

        $stmt->execute();

        return $stmt->get_result();
    }


    function getNumVehicleOffences($vehicle_no){
        $str_query = "SELECT
                      COUNT(*) AS numOffences
                    FROM offence O INNER JOIN vehicle V
                        ON O.vehicle_id = V.license_no
                      INNER JOIN driver D
                        ON V.driver = D.PIN
                    WHERE V.license_no = ?";

        $stmt = $this->prepareQuery($str_query);

        if($stmt === false){
            return false;
        }

        $stmt->bind_param("s", $vehicle_no);

        $stmt->execute();

        return $stmt->get_result();
    }
}