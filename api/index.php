<?php
// CORS enable
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With');

require 'Slim/Slim.php';
require 'nd/nd.php';

\Slim\Slim::registerAutoloader();

// Instantiate a new Slim application
$app = new \Slim\Slim(array(
    'debug' => true,
    'log.level' => \Slim\Log::DEBUG
));

$app->get('/', function () use ($app){
    $app->response()->write('hola');
});

require 'users.php';

$app->run();

?>