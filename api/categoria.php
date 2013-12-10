<?php

//require 'Slim/Slim.php';

//$app = new Slim();

$app->get('/categorias', function() use ($app){

	global $sql;
	$query = "SELECT * FROM categorias WHERE deleted = 0";
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
});

$app->get('/categorias/:id', function($id) use ($app){

	global $sql;
	$query = "SELECT * FROM categorias WHERE deleted = 0 AND id = " . $id;
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
});

$app->post('/categorias', function() use ($app){

	global $sql;
	$json = json_decode($app->request()->getBody(), true);

	if (is_null($json)) {
		response()->status(400);
		return;
	}
	$sql->autocommit(FALSE);

	$id = $bluesystem->createObject("categoria", $json);
	
	if ($id) {
		$bluesystem->handler->commit();
		$app->response()->write($id);
	} else {
		response()->status(400);
	};
});

$app->put('/categorias/:id', function ($id) use ($app){

	global $sql;
	$json = json_decode($app->request()->getBody(), true);
	$query = "SELECT * FROM categorias WHERE deleted = 0 AND id = " . $id;
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
});

$app->delete('/categorias/:id', function ($id) use ($app){
	
	global $sql;
	$query = "SELECT * FROM categorias WHERE deleted = 0 AND id = " . $id;
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
			// cambiar el flag
			$response->write(json_encode($obj));
		};
	};
});

?>