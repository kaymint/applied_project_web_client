<?php
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
        $result = $fines->$fines->getFine($fid);
        $row = $result->fetch_assoc();
        $_SESSION['fine_details'] = $row;
        header("Location: ../view/payment.php?fid={$fid}");
    }
}