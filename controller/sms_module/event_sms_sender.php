<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 3/17/16
 * Time: 7:40 PM
 */

require_once '../Smsgh/Api.php';


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