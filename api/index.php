<?php
@include 'config.php';
require_once 'vendor/autoload.php';
header('X-Frame-Options: DENY');
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PUT, OPTION, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Max-Age: 86400');
        

date_default_timezone_set ('UTC'); 
// REDBEAN CONFIGURATION
use RedBeanPHP\Facade as RedBean;

if(defined('MYSQL_HOST') && defined('MYSQL_DATABASE') && defined('MYSQL_USER') && defined('MYSQL_PASSWORD')) {
    if(!defined('MYSQL_PORT')) define('MYSQL_PORT', '3306');
    RedBean::setup('mysql:host='. MYSQL_HOST . ';port=' . MYSQL_PORT . ';dbname=' . MYSQL_DATABASE , MYSQL_USER, MYSQL_PASSWORD);
    RedBean::setAutoResolve(true);
    // TODO: Implement freeze
    // RedBean::freeze();
}

// SLIM FRAMEWORK
\Slim\Slim::registerAutoLoader();
$app = new \Slim\Slim();

// LOAD CONTROLLERS
foreach (glob('controllers/*.php') as $controller) {
    include_once $controller;
}

Controller::init();
$app->run();
