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
    function driver(){

    }

    /**
     * This function fetches the details of a driver given the drivers id
     * or license PIN
     *
     * @param $id
     * @return bool
     */
    function getDriver($id){
        $str_query = "SELECT * FROM driver WHERE PIN = '$id'";


        return $this->query($str_query);
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
                      PIN = '$pin',
                      firstname = '$firstName',
                      lastname = '$lastName',
                      initial = '$initial',
                      date_of_birth = '$dateOfBirth',
                      address = '$address',
                      nationality = '$nationality',
                      date_of_issue = '$dateOfIssue',
                      date_of_first_license = '$dateFirstLicense',
                      expiry_date = '$expiryDate',
                      certificate_date = '$certificationDate',
                      phone = '$phone'";

        return $this->query($str_query);
    }


    /**
     * Executes a query to fetch the details of all drivers in the database
     *
     */
    function getAllDrivers(){

        $str_query = "SELECT * FROM driver";

        return $this->query($str_query);
    }
}


//$driver = new driver();
////
////echo $driver->getDriver('ANSA-100294-02-10');
//if($driver->getDriver('ANSA-100294-02-10')){
//    echo 'Success';
//    $row = $driver->fetch();
//    var_dump($row);
//}


