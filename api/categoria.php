<?php

require 'Slim/Slim.php';
require 'Connection.php';

$app = new Slim();

$app->get('/categorias', 'getCategorias');
$app->get('/categorias/:id',	'getCategoria');
$app->get('/categorias/search/:query', 'findByName');
$app->post('/categorias', 'addCategoria');
$app->put('/categorias/:id', 'updateCategoria');
$app->delete('/categorias/:id',	'deleteCategoria');

$app->run();

function getCategorias() {

	$sql = "select * FROM categoria ORDER BY name";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$categorias = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($categorias);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getCategoria($id) {

	$sql = "SELECT * FROM categoria WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$categorias = $stmt->fetchObject();  
		$db = null;
		echo json_encode($categorias); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function addCategoria() {
}

function updateCategoria($id) {
}

function deleteCategoria($id) {
}

function findByName($query) {
}

//function getConnection() {}

?>