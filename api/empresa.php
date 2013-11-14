<?php

require 'Slim/Slim.php';
require 'Connection.php';

$app = new Slim();

$app->get('/empresas', 'getEmpresas');
$app->get('/empresas/:id',	'getEmpresa');
$app->get('/empresas/search/:query', 'findByName');
$app->post('/empresas', 'addEmpresa');
$app->put('/empresas/:id', 'updateEmpresa');
$app->delete('/empresas/:id',	'deleteEmpresa');

$app->run();

function getEmpresas() {

	$sql = "select * FROM empresa ORDER BY name";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$empresas = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($empresas);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getEmpresa($id) {

	$sql = "SELECT * FROM empresa WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$empresas = $stmt->fetchObject();  
		$db = null;
		echo json_encode($empresas); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function addEmpresa() {}

function updateEmpresa($id) {}

function deleteEmpresa($id) {}

function findByName($query) {}

//function getConnection() {}

?>