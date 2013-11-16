<?php

require 'Slim/Slim.php';

$app = new Slim();

$app->get('/boletas', 'getBoletas');
$app->get('/boletas/:id',	'getBoleta');
$app->get('/boletas/search/:query', 'findByName');
$app->post('/boletas', 'addBoleta');
$app->put('/boletas/:id', 'updateCategoria');
$app->delete('/boletas/:id',	'deleteBoleta');

$app->run();

function getBoletas() {

	$sql = "select * FROM boleta ORDER BY name";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$boletas = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($boletas);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getBoleta($id) {

	$sql = "SELECT * FROM boleta WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$boletas = $stmt->fetchObject();  
		$db = null;
		echo json_encode($boletas); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function addBoleta() {
}

function updateCategoria($id) {
}

function deleteBoleta($id) {
}

function findByName($query) {
}

?>