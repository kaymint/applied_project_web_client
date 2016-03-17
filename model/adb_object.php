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


    function escape($str_sql){
        return $this->mysqli->real_escape_string($str_sql);
    }


    function query($str_query){
        if(!isset($this->mysqli)){
            $this->connect();
        }

//        $str_query = $this->escape($str_query);

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



    function fetch_all(){

        //fetch data from query

        if(isset($this->result)){
            return $this->result->fetch_all(MYSQLI_ASSOC);
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
//if($obj->query('SELECT * FROM driver')){
//    $row = $obj->fetch_all();
//
////    echo ['PIN'];
//
//    print_r($row);
//    echo $obj->get_num_rows();
//
//    echo $obj->get_insert_id();
//}

