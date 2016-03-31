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
    function __construct(){
        parent:: __construct();
    }


    /**
     * Executes a query to get the details of the law enforcer
     *
     * @param $id
     * @return bool
     */
    function getLawEnforcer($id){
        $str_query = "SELECT * FROM law_enforcers WHERE PIN = ?";

        $stmt = $this->prepareQuery($str_query);

        if($stmt === false){
            return false;
        }

        $stmt->bind_param("s", $id);

        $stmt->execute();

        return $stmt->get_result();
    }


    /**
     * Executes of a query to add a new law enforcer
     *
     * @param $id
     * @param $firstName
     * @param $lastName
     * @param $position
     * @param $district
     * @param $password
     * @return bool
     */
    function addLawEnforcer($id, $firstName, $lastName, $position, $district, $password){

        $str_query = "INSERT INTO law_enforcers(ID,first_name,last_name,position,district,password)
                      VALUES(?,?,?,?,?,?) ";

        $stmt = $this->prepareQuery($str_query);

        if($stmt === false){
            return false;
        }

        $stmt->bind_param("ssssss", $id, $firstName, $lastName, $position, $district, $password);

        $stmt->execute();

        return $stmt;
    }


    /**
     * Executes a query to fetch the details of a law enforcer
     *
     * @return bool
     */
    function getLawEnforcers(){
        $str_query = "SELECT * FROM law_enforcers";

        $stmt = $this->prepareQuery($str_query);

        if($stmt === false){
            return false;
        }

        $stmt->execute();

        return $stmt->get_result();
    }
}