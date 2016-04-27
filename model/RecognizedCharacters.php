<?php

/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 4/27/16
 * Time: 7:31 PM
 */

require_once 'adb_object.php';

class RecognizedCharacters extends adb_object
{

    function __construct()
    {
        parent:: __construct();
    }


    /**
     * @param $charSequence
     * @return bool|mysqli_stmt
     */
    function addRecognizedCharacter($charSequence, $assoc_char){

        $str_query = "INSERT INTO recognized_characters(characters, associated_vehicle_no)
                      VALUES (?, ?)";

        $stmt = $this->prepareQuery($str_query);

        if($stmt === false){
            return false;
        }

        $stmt->bind_param("ss", $charSequence, $assoc_char);


        $stmt->execute();

        return $stmt;
    }


    /**
     * @return bool|mysqli_result
     */
    function getRecognizedCharacter(){
        $str_query = "SELECT R.characters, R.time_recognized FROM recognized_characters R";

        $stmt = $this->prepareQuery($str_query);

        if($stmt === false){
            return false;
        }

        $stmt->execute();

        return $stmt->get_result();
    }

}