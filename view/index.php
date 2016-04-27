<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 3/10/16
 * Time: 10:00 AM
 */
session_start();

if(!isset($_SESSION['PIN'])){
    header("Location: login.php");
}

require_once 'Twig-1.x/lib/Twig/Autoloader.php';
require_once '../model/driver.php';
require_once '../model/fines.php';

Twig_Autoloader::register();


$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);
$template =$twig->loadTemplate('index.html.twig');
$params = array();

$driver = new driver();


if(isset($_SESSION['PIN'])){
    $params['first_name'] = $_SESSION['first_name'];
    $params['last_name'] = $_SESSION['last_name'];
    $params['initial'] = $_SESSION['initial'];
    $params['PIN'] = $_SESSION['PIN'];

    $fines = new Fines();
    $result = $fines->getDriverFines($_SESSION['PIN']);
    $row = $result->fetch_all(MYSQLI_ASSOC);
    $params['fines'] = $row;
}


$template->display($params);