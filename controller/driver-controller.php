<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 2/15/16
 * Time: 9:43 AM
 */

session_start();



if(isset($_POST['cmd'])){

    $cmd = intval($_POST['cmd']);

    switch($cmd){

        case 1:
            //driver login controller
            loginDriver();
            break;
        case 2:

            break;
    }


}


function loginDriver(){
    if(isset($_POST['PIN'])){
        require_once '../model/driver.php';

        $PIN = $_POST['PIN'];


        $driver = new driver();
        $result = $driver->getDriver($PIN);


        $row = $result->fetch_assoc();

        if(count($row) == 0){
            $_SESSION['message'] = 'invalid user';
            header("Location: ../view/login.php");
        }else{
            $_SESSION['PIN'] = $row['PIN'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['initial'] = $row['initial'];
            $_SESSION['dob'] = $row['date_of_birth'];
            $_SESSION['doi'] = $row['date_of_issue'];
            $_SESSION['expiry_date'] = $row['expiry_date'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['phone'] = $row['phone'];
            header("Location: ../view/index.php");
        }
    }
}