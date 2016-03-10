<?php
/**
 * Created by
 * User: Kenneth Mintah Mensah
 * Date: 2/15/16
 * Time: 9:07 AM
 */

require_once 'adb_object.php';

class LawEnforcer extends adb_object{

    /**
     *
     * law_enforcer constructor.
     */
    function LawEnforcer(){

    }


    /**
     * Executes a query to get the details of the law enforcer
     *
     * @param $id
     * @return bool
     */
    function getLawEnforcer($id){
        $str_query = "SELECT * FROM law_enforcers WHERE PIN = '$id'";

        return $this->query($str_query);
    }


    /**
     * Executes of a query to add a new law enforcer
     *
     * @param $id
     * @param $firstName
     * @param $lastName
     * @param $position
     * @param $district
     * @return bool
     */
    function addLawEnforcer($id, $firstName, $lastName, $position, $district){

        $str_query = "INSERT INTO law_enforcers SET
                      ID = '$id',
                      first_name = '$firstName',
                      last_name = '$lastName',
                      position = '$position',
                      district = '$district'";

        return $this->query($str_query);
    }


    /**
     * Executes a query to fetch the details of a law enforcer
     *
     * @return bool
     */
    function getLawEnforcers(){
        $str_query = "SELECT * FROM law_enforcers";

        return $this->query($str_query);
    }
}