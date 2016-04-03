<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 3/10/16
 * Time: 10:00 AM
 */
session_start();

require_once 'Twig-1.x/lib/Twig/Autoloader.php';
require_once '../model/driver.php';
require_once '../model/fines.php';

Twig_Autoloader::register();


$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);
$template =$twig->loadTemplate('fines.html.twig');
$params = array();

$driver = new driver();


if(isset($_SESSION['PIN'])){
    $params['first_name'] = $_SESSION['first_name'];
    $params['last_name'] = $_SESSION['last_name'];
    $params['initial'] = $_SESSION['initial'];
    $params['PIN'] = $_SESSION['PIN'];

    if(isset($_SESSION['fine_details']) && isset($_REQUEST['fid'])){
        $params['fine_details'] = $_SESSION['fine_details'];
    }
}


$template->display($params);