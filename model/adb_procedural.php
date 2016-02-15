<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 2/5/16
 * Time: 7:03 PM
 */


require_once 'config.php';

class adb_procedural extends mysqli{

    var $result;
    var $link;

    /**
     * adb_procedural constructor.
     */
    function adb_procedural(){
        $this->link = $this->connect();
    }

    /**
     *returns a row from a data set
     */
    function connect(){
        $mysqli_link = mysqli_connect(DB_HOST, DB_USER, DB_PWORD, DB_NAME);

        if(mysqli_connect_errno()){
            printf("Connection to database failed: %s\n", mysqli_connect_errno());
            exit();
        }

        return $mysqli_link;
    }

    /**
     * connect to db and run a query
     */
    function query($str_query){

        if(!isset($this->link)){
            $this->link = $this->connect();
        }
        $mysqli_result = mysqli_query($this->link,$str_query);
        $this->result = $mysqli_result;

        if($mysqli_result){

            return true;
        }

        return false;
    }


    function fetch(){

        return mysqli_fetch_assoc($this->result);
    }


    /**
     * returns number of rows in current dataset
     */
    function get_num_rows(){

        return mysqli_num_rows($this->result);
    }

    /**
     *returns last auto generated id
     */
    function get_insert_id(){

        return mysqli_insert_id($this->link);
    }

    /**
     * Function to close the sql connection
     */
    function close_connection(){

        return mysqli_close($this->link);
    }
}



