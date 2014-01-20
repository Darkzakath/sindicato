<?php
// CORS enable
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With');
ini_set('display_errors', 1);

date_default_timezone_set('UTC');

// SLIM Framework, to provide REST capability and scalfolding
<<<<<<< HEAD
require 'libs/Slim/Slim.php';
// small propietary ORM
require 'libs/nd/nd.php';
=======
require_once 'libs/Slim/Slim.php';
// small propietary ORM
require_once 'libs/nd/nd.php';
>>>>>>> 761859af77d15d99ea4a125f63b609ce2ef8d92f
// small propietary Auth
require_once 'libs/Auth/Auth.php';
require_once 'libs/Auth/AuthMiddleware.php';

// SLIM setting up
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

error_reporting(E_ALL);

// Nd settings up
<<<<<<< HEAD
$config_file = 'sindicato.json';
$config_data = file_get_contents($config_file);
//var_dump($config_data);
$config_json = json_decode($config_data, true);
//var_dump($config_json);
=======
$config_data = file_get_contents('config/blackfeather.json');
$config_json = json_decode($config_data, true);
>>>>>>> 761859af77d15d99ea4a125f63b609ce2ef8d92f
$system = new \nd\neodynium($config_json);
$system->startApp("web");

//set Auth middleware
$app->add(new \c2si\AuthMiddleware($system));

// Noop - no operation (for testing)

$app->get('/noop', function () use ($app){
    $response = $app->response();
    $response['Content-Type'] = 'application/json';
    $response->write('{}');
});

require_once 'security/access.php';

// SLIM start point
$app->run();


?>
