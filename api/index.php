<?php
// CORS enable
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With');
ini_set('display_errors', 1);

// SLIM Framework, to provide REST capability and scalfolding
require 'Slim/Slim.php';
// small propietary ORM
require 'nd/nd.php';

// SLIM setting up
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

// Nd settings up
$config_file = 'sindicato.json';
$config_data = file_get_contents($config_file);
$config_json = json_decode($config_data, true);
$system = new \nd\neodymium($config_json);
$system->startApp("web");

$app->get('/', function () use ($app){
    $response = $app->response();
    $response['Content-Type'] = 'application/json';
    $response->write('nothing');
});

<<<<<<< HEAD
require 'test.php';
require 'trabajador.php';
=======
require 'users.php';
>>>>>>> cf0cda4c74d1dcf674aa06b7e7421b51c78071e3

$app->run();

?>