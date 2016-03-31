<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 2/15/16
 * Time: 9:36 AM
 */

require_once 'adb_object.php';

class Fines extends adb_object{

    function __construct(){
        parent:: __construct();
    }


    /**
     * Executes a query to add a fine
     *
     * @param $offence_id
     * @return bool
     */
    function addFines($offence_id){
        $str_query = "INSERT INTO fines(offence_id, due_date, date_issued)
                      offence_id = ?,
                      due_date = DATE_ADD(CURDATE(), INTERVAL 7 DAY),
                      date_issued = CURDATE()";

        $stmt = $this->prepareQuery($str_query);

        if($stmt === false){
            return false;
        }

        $stmt->bind_param("i", $offence_id);


        $stmt->execute();

        return $stmt;
    }


    /**
     * Executes a query to fetch all fines by a driver
     *
     * @param $driver
     * @return bool
     */
    function getDriverFines($driver){
        $str_query = "SELECT * FROM
                      fines F INNER JOIN offence O
                      ON F.offence_id = O.offence_id
                      INNER JOIN vehicle V
                      ON O.vehicle_id = V.license_no
                      INNER JOIN driver D
                      ON D.PIN = V.driver
                      WHERE D.PIN = ?";

        $stmt = $this->prepareQuery($str_query);

        if($stmt === false){
            return false;
        }

        $stmt->bind_param("i", $driver);

        $stmt->execute();

        return $stmt->get_result();
    }


    /**
     * Executes a query to retrieve unpaid fines
     *
     * @param $driver
     * @return bool
     */
    function getUnpaidFines($driver){
        $str_query = "SELECT * FROM
                      fines F INNER JOIN offence O
                      ON F.offence_id = O.offence_id
                      INNER JOIN vehicle V
                      ON O.vehicle_id = V.license_no
                      INNER JOIN driver D
                      ON D.PIN = V.driver
                      WHERE D.PIN = ?
                      AND F.payment_status = 'UNPAID'";

        $stmt = $this->prepareQuery($str_query);

        if($stmt === false){
            return false;
        }

        $stmt->bind_param("i", $driver);

        $stmt->execute();

        return $stmt->get_result();
    }


    /**
     * @param $offence_id
     * @return bool|mysqli_stmt
     */
    function payFine($offence_id){
        $str_query = "UPDATE fines SET
                      time_paid = NOW(),
                      payment_status = 'PAID'
                      WHERE fine_id = ?";

        $stmt = $this->prepareQuery($str_query);

        if($stmt === false){
            return false;
        }

        $stmt->bind_param("i", $offence_id);


        $stmt->execute();

        return $stmt;
    }

}