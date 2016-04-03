<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 2/15/16
 * Time: 9:03 AM
 */

require_once 'adb_object.php';

class driver extends adb_object{

    /**
     *
     * driver constructor.
     */
    function __construct(){
        parent:: __construct();
    }

    /**
     * This function fetches the details of a driver given the drivers id
     * or license PIN
     *
     * @param $id
     * @return bool
     */
    function getDriver($id){
        $str_query = "SELECT * FROM driver WHERE PIN = ?";


        $stmt = $this->prepareQuery($str_query);

        if($stmt === false){
            return false;
        }

        $stmt->bind_param("s", $id);

        $stmt->execute();

        return $stmt->get_result();
    }


    /**
     * Executes a query that adds the details of a new driver
     *
     * @param $pin
     * @param $firstName
     * @param $lastName
     * @param $initial
     * @param $dateOfBirth
     * @param $address
     * @param $nationality
     * @param $dateOfIssue
     * @param $dateFirstLicense
     * @param $expiryDate
     * @param $certificationDate
     * @param $phone
     *
     * @return bool
     */
    function addDriver($pin, $firstName, $lastName ,$initial, $dateOfBirth, $address,
        $nationality, $dateOfIssue, $dateFirstLicense, $expiryDate, $certificationDate,
        $phone){

        $str_query = "INSERT INTO driver SET
                      PIN = ?,
                      firstname = ?,
                      lastname = ?,
                      initial = ?,
                      date_of_birth = ?,
                      address = ?,
                      nationality = ?,
                      date_of_issue = ?,
                      date_of_first_license = ?,
                      expiry_date = ?,
                      certificate_date = ?,
                      phone = ?";

        $stmt = $this->prepareQuery($str_query);

        if($stmt === false){
            return false;
        }

        $stmt->bind_param("ssssssssssss", $pin, $firstName, $lastName, $initial, $dateOfBirth, $address,
            $nationality, $dateOfIssue, $dateFirstLicense, $expiryDate, $certificationDate, $phone);

        $stmt->execute();

        return $stmt;
    }


    /**
     * Executes a query to fetch the details of all drivers in the database
     *
     */
    function getAllDrivers(){

        $str_query = "SELECT * FROM driver";

        $stmt = $this->prepareQuery($str_query);

        if($stmt === false){
            return false;
        }

        $stmt->execute();

        return $stmt->get_result();
    }
}


//$driver = new driver();
//////
//$result = $driver->getDriver('ANSA-100294-02-10');
//$row = $result->fetch_assoc();
//var_dump($row);
//if($driver->getDriver('ANSA-100294-02-10')){
//    echo 'Success';
//    $row = $driver->fetch();
//    var_dump($row);
//}


