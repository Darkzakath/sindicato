<?php

require 'Slim/Slim.php';

$app = new Slim();

$app->get('/admins', 'getAdmins');
$app->get('/admins/:id',	'getAdmin');
$app->get('/admins/search/:query', 'findByName');
$app->post('/admins', 'addAdmin');
$app->put('/admins/:id', 'updateAdmin');
$app->delete('/admins/:id',	'deleteAdmin');

$app->run();

function getAdmins() {

	$sql = "select * FROM administrador ORDER BY name";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$administradores = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($administradores);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getAdmin($id) {

	$sql = "SELECT * FROM administrador WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$administradores = $stmt->fetchObject();  
		$db = null;
		echo json_encode($administradores); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function addAdmin() {
}

function updateAdmin($id) {
}

function deleteAdmin($id) {
}

function findByName($query) {
}

?>