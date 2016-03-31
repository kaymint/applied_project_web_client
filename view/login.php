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

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);
$template =$twig->loadTemplate('login.html.twig');
$params = array();

if(isset($_SESSION['message'])){
    $params['message'] = $_SESSION['message'];
}


$template->display($params);