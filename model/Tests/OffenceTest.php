<?php

/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 4/17/16
 * Time: 4:05 PM
 */

require_once '../offence.php';

class OffenceTest extends PHPUnit_Framework_TestCase
{


    public function testAddOffence(){

        $testObj = new Offence();
        $vehicle_no = 'GR111111';
        $location = 'Test Location';
        $this->assertType(mysqli_stmt, $testObj->addOffence($vehicle_no, $location));

    }


    public function testGetDriverOffence(){
        $testObj = new Offence();
        $driver = 'XXXXXXXXXXXXX';
        $this->assertType(mysqli_result, $testObj->getDriverOffence($driver));
    }


    public function testGetNumDriverOffences(){
        $testObj = new Offence();
        $driver = 'XXXXXXXXXXXXX';
        $this->assertType(mysqli_result, $testObj->getNumDriverOffences($driver));
    }

}
