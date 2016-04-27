<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 4/13/16
 * Time: 3:18 PM
 */

require_once 'HttpHandlers.php';

//vehicle
$params = array(
    "s" => "5awf6h29",
    "k" => "j8qu6g1460563303",
    "cmd" => "2",
    "license_no" => "GR569716"
);

//driver
//$params = array(
//    "s" => "5awf6h29",
//    "k" => "j8qu6g1460563303",
//    "cmd" => "1",
//    "PIN" => "BANS-030190-03-01"
//);

echo httpPost("http://localhost:81/applied_project_web_client/controller/insurance_api/Insurance_Api.php",$params);