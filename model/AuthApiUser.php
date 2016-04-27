<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 4/13/16
 * Time: 12:18 PM
 */
session_start();
require_once 'adb_object.php';
require_once 'security.php';

class AuthApiUser extends adb_object{

    var $secret ;
    var $key;

    /**
     * AuthApiUser constructor.
     */
    function __construct(){
        parent:: __construct();
    }

    /**
     * @return bool|mysqli_stmt
     */
    function addNewUser(){
        $str_query = "INSERT INTO api_users(user_key, secret)
                      VALUES(?,?)";

        $stmt = $this->prepareQuery($str_query);

        if($stmt === false){
            return false;
        }

        $this->secret = assignSecret();
        $this->key = assignKey();

        $enc_secret = encrypt($this->secret);
        $enc_key = $this->key;

        $stmt->bind_param("ss", $enc_key, $enc_secret);

        $stmt->execute();

        return $stmt;
    }

    /**
     * @param $secret
     * @param $key
     * @return bool
     */
    function authenticateUser($secret, $key){

        $result = $this->getUser($key);
        $row = $result->fetch_assoc();

        if(count($row) == 0){
            return false;
        }else{
            $enc_key = $row['secret'];
            return verifyKey($secret, $enc_key);
        }
    }

    /**
     * @param $user
     * @return bool|mysqli_result
     */
    private function getUser($user){
        $str_query = "SELECT AU.secret, AU.user_key
                      FROM api_users AU
                      WHERE AU.user_key = ?";

        $stmt = $this->prepareQuery($str_query);

        if($stmt === false){
            return false;
        }

        $stmt->bind_param("s", $user);

        $stmt->execute();

        return $stmt->get_result();
    }

    /**
     * @return mixed
     */
    function returnSecret(){
        return $this->secret;
    }

    /**
     * @return mixed
     */
    function returnKey(){
        return $this->key;
    }

}

//$api_user = new AuthApiUser();
//$api_user->addNewUser();
//$secret = $api_user->returnSecret();
//$key = $api_user->returnKey();
//$_SESSION['k'] = $key;
//$_SESSION['s'] = $secret;
//$_SESSION['pin'] = 'BANS-030190-03-01';
//var_dump($_SESSION);



