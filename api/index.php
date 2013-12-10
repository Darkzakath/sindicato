<?php
// CORS enable
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With');

// helper functions
function getConnection() {
	$dbhost="hostingbahia3.com.ar";
	$dbuser="goldmoll_user";
	$dbpass="a9GnAeJL";
	$dbname="goldmoll_sindicato";
	$handler = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	return $habdler;
}

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();
// Instantiate a new Slim application
$app = new \Slim\Slim();

$app->get('/', function () use ($app){
    echo "Undefined";
});

require 'test.php';
require 'trabajador.php';
require 'empresa.php';
require 'categoria.php';
require 'boleta.php';
require 'administrador.php';

$sql = getConnection();
$app->run();

?>