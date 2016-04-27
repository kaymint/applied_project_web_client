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

            addOffence();
            break;
        case 2:

            break;
    }
}




