<?php

/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 4/13/16
 * Time: 10:57 AM
 */

if(isset($_POST['cmd'])){

    $cmd = intval($_POST['cmd']);

    switch($cmd){
        case 1:
            //get driver history
            getDriverHistory();
            break;
        case 2:
            //get vehicle history
            getVehicleHistory();
            break;
    }
}


/**
 * @return bool
 */
function authenticateUser(){
    if(isset($_POST['s']) & isset($_POST['k'])){
        $secret = $_POST['s'];
        $key = $_POST['k'];
        $api_user = getAuthUserModel();
        $res = $api_user->authenticateUser($secret, $key);
        return $res;
    }else{
        return false;
    }
}


/**
 *
 */
function getDriverHistory(){
    if(authenticateUser()){
        if(isset($_POST['PIN'])){
            $pin = $_POST['PIN'];
            $api = getShutterCopApiModel();
            $result = $api->getDriverHistory($pin);
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $result2 = $api->getDriverNumOffences($pin);
            $numOffences = $result2->fetch_assoc();

            if(count($rows) == 0){
                $response = [];
                $response['response'] = "No Offences";
                $json_response = json_encode($response);
                echo $json_response;
            }else{
                $offences = [];
                $offences['offences'] = $rows;
                $offences['offenceCount'] = $numOffences;
                $response = [];
                $response['DriverHistory'] = $offences;
                $json_response = json_encode($response);
                echo $json_response;
            }
        }
    }else{
        $response = [];
        $response['response'] = "Forbidden Request";
        $json_response = json_encode($response);
        echo $json_response;
    }
}


function getVehicleHistory(){
    if(authenticateUser()){
        if(isset($_POST['license_no'])){
            $license_no = $_POST['license_no'];
            $api = getShutterCopApiModel();
            $result = $api->getVehicleHistory($license_no);
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $result2 = $api->getVehicleNumOffences($license_no);
            $numOffences = $result2->fetch_assoc();

            if(count($rows) == 0){
                $response = [];
                $response['response'] = "No Offences";
                $json_response = json_encode($response);
                echo $json_response;
            }else{
                $offences = [];
                $offences['offences'] = $rows;
                $offences['offenceCount'] = $numOffences;
                $response = [];
                $response['VehicleHistory'] = $offences;
                $json_response = json_encode($response);
                echo $json_response;
            }
        }
    }else{
        $response = [];
        $response['response'] = "Forbidden Request";
        $json_response = json_encode($response);
        echo $json_response;
    }
}

/**
 * @return ShutterCop
 */
function getShutterCopApiModel(){
    require_once '../../model/ShutterCopApi.php';
    $shutterCopApi = new ShutterCop();
    return $shutterCopApi;
}

/**
 * @return AuthApiUser
 */
function getAuthUserModel(){
    require_once '../../model/AuthApiUser.php';
    $api_user = new AuthApiUser();
    return $api_user;
}


