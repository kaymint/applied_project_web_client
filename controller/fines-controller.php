<?php
session_start();
require_once '../model/fines.php';
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 2/15/16
 * Time: 9:41 AM
 */

if(isset($_REQUEST['cmd'])){
    $cmd = intval($_REQUEST['cmd']);

    switch($cmd){
        case 1:

            getFine();
            break;
        case 2:
            payFine();
            break;
    }
}

/**
 * get fine details
 */
function getFine(){
    if(isset($_REQUEST['fid'])){
        $fid = intval($_REQUEST['fid']);
        $fines = new Fines();
        $result = $fines->getFine($fid);
        $row = $result->fetch_assoc();
        $_SESSION['fine_details'] = $row;
        header("Location: ../view/payment.php?fid={$fid}");
    }
}


/**
 * pay fines
 */
function payFine(){
    if(isset($_REQUEST['fid'])) {
        $fid = intval($_REQUEST['fid']);
        $fines = new Fines();

        $result = $fines->payFine($fid);
        $result = $fines->addPayment($fid);
        unset($_SESSION['fine_details']);
        $result = $fines->getReceipt($fid);
        $row = $result->fetch_assoc();
        $_SESSION['receipt_details'] = $row;

        header("Location: ../view/receipt.php?fid={$fid}");
    }
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