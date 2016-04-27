<?php
/**
 * Created by PhpStorm.
 * User: Kenneth Mintah Mensah
 * Date: 2/15/16
 * Time: 9:41 AM
 */


if(isset($_REQUEST['cmd'])){
    $cmd = intval($_REQUEST['cmd']);

    switch($cmd){
        case 1:
            matchNumberPlate();
            break;
        case 2:

            break;
    }
}


function matchNumberPlate(){

    if(isset($_REQUEST['numPlate'])){
        $numPlate = sanitize_string($_REQUEST['numPlate']);


        $vehicle = getVehicleModel();

        $result = $vehicle->getVehicleDetails($numPlate);
        $row = $result->fetch_assoc();

        $recognizedChars = getRecognizedCharModel();

        if(count($row) == 0){
            $recognizedChars->addRecognizedCharacter($numPlate, 'No Record');
        }else{
            $recognizedChars->addRecognizedCharacter($numPlate, $row['license_no']);
            addOffence($numPlate);
            sendSMSNotification($row);
        }

    }
}


/**
 * @param $vehicle
 */
function addOffence($vehicle){
    $offence = getOffenceModel();
    $offence->addOffence($vehicle, 'Ashesi University Junction');
    $offenceId = $offence->get_insert_id();

    $fine = getFineModel();
    $fine->addFines($offenceId);
}


function sendSMSNotification($row){
    $phone = $row['phone'];
    $message = "Dear ". $row['first_name']." ".$row['last_name'];
    $message .= "\n\r You have been fined.";
    $message .= "\n\r Amount: GHS 500 @ Ashesi University Junction";
    $message .= "\n\r Vehicle: {$row['license_no']} {$row['brand']} {$row['description']}";

    var_dump($message);
    sendSMS($phone, $message);
}



/**
 * @return Offence
 */
function getOffenceModel(){
    require_once '../model/offence.php';
    $offence = new Offence();
    return $offence;
}


/**
 * @return RecognizedCharacters
 */
function getRecognizedCharModel(){
    require_once '../model/RecognizedCharacters.php';
    $recognizedChar = new RecognizedCharacters();
    return $recognizedChar;
}


/**
 * @return Fines
 */
function getFineModel(){
    require_once '../model/fines.php';
    $fine = new Fines();
    return $fine;
}


/**
 * @return Vehicle
 */
function getVehicleModel(){
    require_once '../model/vehicle.php';
    $vehicle = new Vehicle();
    return $vehicle;
}


/**
 * @param $val
 * @return string
 */
function sanitize_string($val){
    $val = stripslashes($val);
    $val = strip_tags($val);
    $val = htmlentities($val);

    return $val;
}


require_once 'Smsgh/Api.php';

/**
 * @return MessagingApi
 */
function setupSMS(){

    //$auth = new BasicAuth("yralkzfn", "znbzlsho");

    //$auth = new BasicAuth("jokyhrvs", "volkzmqn");

    $auth = new BasicAuth("igkoydll", "dngiqlfo");
    $apiHost = new ApiHost($auth);

    $messagingApi = new MessagingApi($apiHost);
    return $messagingApi;
}


/**
 * @param $phone
 * @param $message
 */
function sendSMS($phone, $message){
    $messagingApi = setupSMS();
    try{

        $messageResponse = $messagingApi->sendQuickMessage("ShutterCop", $phone, $message);
        if ($messageResponse instanceof MessageResponse) {
            echo $messageResponse->getStatus();
        } elseif ($messageResponse instanceof HttpResponse) {
            echo "\nServer Response Status : " . $messageResponse->getStatus();
        }
    }catch (Exception $ex) {
        echo $ex->getTraceAsString();
    }
}



