<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 2/5/16
 * Time: 8:45 PM
 */

require_once 'config.php';

class adb_object {

    var $link;
    var $result;
    var $mysqli;

    function adb_object(){
        $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PWORD, DB_NAME);
    }

    function connect(){
        if(!isset($this->mysqli)){
            $this->adb_object();
        }

        if($this->mysqli->connect_errno){
            printf("Connection failed %s\n", $this->mysqli->error);
            exit();
        }
    }


    function query($str_query){
        if(!isset($this->mysqli)){
            $this->connect();
        }

        $this->result = $this->mysqli->query($str_query);

        if($this->result){
            return true;
        }

        return false;
    }


    function fetch(){

        //fetch data from query

        if(isset($this->result)){
            return $this->result->fetch_assoc();
        }

        return false;
    }


    function get_num_rows(){

        return $this->mysqli->affected_rows;
    }


    function get_insert_id(){

        return $this->mysqli->insert_id;
    }


    function close_connection(){

        return $this->mysqli->close();
    }
}


//$obj = new adb_object();
//if($obj->query('SELECT * FROM wine')){
//    $row = $obj->fetch();
//
//    echo $row['year'];
//
//    echo $obj->get_num_rows();
//
//    echo $obj->get_insert_id();
//}

