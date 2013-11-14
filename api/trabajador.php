<?php

require 'Slim/Slim.php';
require 'Connection.php';

$app = new Slim();

$app->get('/trabajadores', 'getTrabajadores');
$app->get('/trabajadores/:id',	'getTrabajador');
$app->get('/trabajadores/search/:query', 'findByName');
$app->post('/trabajadores', 'addTrabajador');
$app->put('/trabajadores/:id', 'updateTrabajador');
$app->delete('/trabajadores/:id',	'deleteTrabajador');

$app->run();

function getTrabajadores() {

	$sql = "select * FROM trabajador ORDER BY name";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$trabajadores = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($trabajadores);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getTrabajador($id) {

	$sql = "SELECT * FROM trabajador WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$trabajadores = $stmt->fetchObject();  
		$db = null;
		echo json_encode($trabajadores); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function addTrabajador() {}

function updateTrabajador($id) {}

function deleteTrabajador($id) {}

function findByName($query) {}

//function getConnection() {}

?>