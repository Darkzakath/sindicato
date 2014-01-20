<?php
// CORS enable
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With');
ini_set('display_errors', 1);

// SLIM Framework, to provide REST capability and scalfolding
require 'libs/Slim/Slim.php';
// small propietary ORM
require 'libs/nd/nd.php';
// small propietary Auth
require_once 'libs/Auth/Auth.php';
require_once 'libs/Auth/AuthMiddleware.php';

// SLIM setting up
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

// Nd settings up
$config_file = 'sindicato.json';
$config_data = file_get_contents($config_file);
//var_dump($config_data);
$config_json = json_decode($config_data, true);
//var_dump($config_json);
$system = new \nd\neodynium($config_json);
$system->startApp("web");

$app->get('/', function () use ($app){
    $response = $app->response();
    $response['Content-Type'] = 'application/json';
    $response->write('nothing');
});

require 'users.php';

$app->run();

?>