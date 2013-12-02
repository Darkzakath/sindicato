<?php

require 'Slim/Slim.php';

$app = new Slim();

$app->get('/trabajadores', 'getTrabajadores');
$app->get('/trabajadores/:id',	'getTrabajador');
$app->get('/trabajadores/search/:query', 'findByName');
$app->post('/trabajadores', 'addTrabajador');
$app->put('/trabajadores/:id', 'updateTrabajador');
$app->delete('/trabajadores/:id',	'deleteTrabajador');

$app->run();

function getTrabajadores() {

	$sql = "select * FROM trabajadores ORDER BY name";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$trabajadores = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($trabajadores);
	} catch(PDOException $e) {
		//echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getTrabajador($id) {

	$sql = "SELECT * FROM trabajadores WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$trabajadores = $stmt->fetchObject();  
		$db = null;
		echo json_encode($trabajadores); 
	} catch(PDOException $e) {
		//echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function addTrabajador() {
	global $sql;

	$json = json_decode($app->request()->getBody(), true);
	
	if (is_null($json)) {
		response()->status(400);
		return;
	}
	
	$sql->autocommit(FALSE);
	$sql = "INSERT INTO trabajadores (nombre, apellido, cuil, fingreso, categoria) VALUES (:nombre, :apellido, :cuil, :fingreso, :categoria)";

	//$id = $bluesystem->createObject("book", $json);
	try{
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("nombre", $json->nombre);
		$stmt->bindParam("apellido", $json->apellido);
		$stmt->bindParam("cuil", $json->cuil);
		$stmt->bindParam("fingreso", $json->fingreso);
		$stmt->bindParam("categoria", $json->categoria);
		$stmt->execute();
		$json->id = $db->lastInsertId();
		$db = null;
		echo json_encode($json);
	} catch(PDOException $e) {
		response()->status(400);
	}
}

function updateTrabajador($id) {}

function deleteTrabajador($id) {}

function findByName($query) {}

?>