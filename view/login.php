<?php
session_start();
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 3/10/16
 * Time: 9:38 AM
 */

require_once 'Twig-1.x/lib/Twig/Autoloader.php';


Twig_Autoloader::register();
$invalid_user = '';

if(isset($_POST['PIN'])){
    require_once '../model/driver.php';

    $PIN = $_POST['PIN'];


    $driver = new driver();

    if($driver->getDriver($PIN)){
        $row = $driver->fetch();

        if(count($row) == 0){
            $invalid_user = true;
        }else{
            $_SESSION['PIN'] = $row['PIN'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['initial'] = $row['initial'];
            $_SESSION['dob'] = $row['date_of_birth'];
            $_SESSION['doi'] = $row['date_of_issue'];
            $_SESSION['expiry_date'] = $row['expiry_date'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['phone'] = $row['address'];
            header("Location: index.php");
        }
    }


}


$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);
$template =$twig->loadTemplate('login.html.twig');
$params = array();
$params['invalid'] = $invalid_user;

$template->display($params);