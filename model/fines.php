<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 2/15/16
 * Time: 9:36 AM
 */

require_once 'adb_object.php';

class Fines extends adb_object{

    function Fines(){

    }


    /**
     * Executes a query to add a fine
     *
     * @param $offence_id
     * @return bool
     */
    function addFines($offence_id){
        $str_query = "INSERT INTO fines SET
                      offence_id = $offence_id,
                      due_date = DATE_ADD(CURDATE(), INTERVAL 7 DAY),
                      date_issued = CURDATE()";

        return $this->query($str_query);
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
                      WHERE D.PIN = $driver";

        return $this->query($str_query);
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
                      WHERE D.PIN = $driver
                      AND F.payment_status = 'UNPAID'";

        return $this->query($str_query);
    }


    function payFine($offence_id){
        $str_query = "UPDATE fines SET
                      time_paid = NOW(),
                      payment_status = 'PAID'
                      WHERE fine_id = $offence_id";

        return $this->query($str_query);
    }

}