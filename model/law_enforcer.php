<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 2/15/16
 * Time: 9:07 AM
 */

class LawEnforcer extends adb_object{

    /**
     *
     * law_enforcer constructor.
     */
    function LawEnforcer(){

    }


    function getLawEnforcer($id){
        $str_query = "SELECT * FROM law_enforcers WHERE PIN = '$id'";

        return $this->query($str_query);
    }


    function addLawEnforcer($id, $firstName, $lastName, $position, $district){

        $str_query = "INSERT INTO law_enforcers SET
                      ";

        return $this->query($str_query);
    }


    function getLawEnforcers(){

    }
}