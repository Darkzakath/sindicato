<?php

require 'Slim/Slim.php';

$app = new Slim();

$app->get('/trabajadores', 'getTrabajadores' use ($app) );
$app->get('/trabajadores/:id',	'getTrabajador' use ($app) );
$app->get('/trabajadores/search/:query', 'findByName' use ($app));
$app->post('/trabajadores', 'addTrabajador' use ($app) );
$app->put('/trabajadores/:id', 'updateTrabajador');
$app->delete('/trabajadores/:id',	'deleteTrabajador');

$app->run();

function getTrabajadores(){

	global $sql;
	$query = "SELECT * FROM trabajadores WHERE deleted = 0";
	$resource = $sql->query($query);

	$response = $app->response();
	$response['Content-Type'] = 'application/json';

	if ($resource === false) {
		$app->response()->status(400);
	} else {
		$ret_array = array();
		while($row = $resource->fetch_assoc()){
			$ret_array[] = $row;
		};
		$response->write(json_encode($ret_array));
	};
}

function getTrabajador($id){

	global $sql;
	$query = "SELECT * FROM trabajadores WHERE deleted = 0 AND id = " . $id;
	$resource = $sql->query($query);

	$response = $app->response();
	$response['Content-Type'] = 'application/json';

	if ($resource === false) {
		response()->status(400);
	} else {
		$obj = $resource->fetch_assoc();

		if (is_null($obj)) {
			response()->status(400);
		} else {
			$response->write(json_encode($obj));
		};
	};
}

function addTrabajador() {

	global $sql;
	$json = json_decode($app->request()->getBody(), true);

	if (is_null($json)) {
		response()->status(400);
		return;
	}
	$sql->autocommit(FALSE);

	$id = $bluesystem->createObject("trabajador", $json);
	
	if ($id) {
		$bluesystem->handler->commit();
		$app->response()->write($id);
	} else {
		response()->status(400);
	};
}

function updateTrabajador($id) {

	global $sql;
	$json = json_decode($app->request()->getBody(), true);
	$query = "SELECT * FROM trabajadores WHERE deleted = 0 AND id = " . $id;
	$resource = $sql->query($query);

	$response = $app->response();
	$response['Content-Type'] = 'application/json';

	$sql->autocommit(FALSE);
	$id = $bluesystem->createObject("trabajador", $json);

	if ($resource === false && is_null($json)) {
		response()->status(400);
	} else {
		$obj = $resource->fetch_assoc();

		if (is_null($obj)) {
			response()->status(400);
		} else {
			$bluesystem->handler->commit();
			$app->response()->write($id);
		};
	};
}

function deleteTrabajador($id) {

}

function findByName($query) {
}

?>