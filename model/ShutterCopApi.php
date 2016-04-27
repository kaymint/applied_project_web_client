<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 4/13/16
 * Time: 10:57 AM
 */
require_once 'offence.php';

class ShutterCop {

    var $offence ;
    var $licenseNo;
    var $driverPIN;


    function __construct(){
        $this->offence = new Offence();
    }

    /**
     * @param $PIN
     * @return bool
     */
    function getDriverHistory($PIN)
    {
        $this->driverPIN = $PIN;
        return $this->offence->getDriverOffence($this->driverPIN);
    }


    /**
     * @param $licenseNo
     * @return bool|mysqli_result
     */
    function getVehicleHistory($licenseNo){
        $this->licenseNo = $licenseNo;
        return $this->offence->getVehicleOffenceHistory($this->licenseNo);
    }

    /**
     * @param $PIN
     * @return bool|mysqli_result
     */
    function getDriverNumOffences($PIN){
        $this->driverPIN = $PIN;
        return $this->offence->getNumDriverOffences($this->driverPIN);
    }

    /**
     * @param $licenseNo
     * @return bool|mysqli_result
     */
    function getVehicleNumOffences($licenseNo){
        $this->licenseNo = $licenseNo;
        return $this->offence->getNumVehicleOffences($this->licenseNo);
    }
}

