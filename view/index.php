<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 3/10/16
 * Time: 10:00 AM
 */

require_once 'Twig-1.x/lib/Twig/Autoloader.php';


Twig_Autoloader::register();


$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);
$template =$twig->loadTemplate('index.html.twig');
$params = array();

$template->display($params);