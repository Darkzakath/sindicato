<?php

$app->get('/users/', function() use ($app, $system){   
    // leer todos los objetos tipo user de la db
    $ret = $system->readObjectList("user");	
    
    // traer objeto para escribir respuesta
	$response = $app->response();
	// seteas la respuesta al navegador que lo que va a volver es un json
	$response['Content-Type'] = 'application/json';
	
	// si la lista de objetos no es nula
	if (!is_null($ret)) {
	    // toma toda la lista de objetos y la codifica en json
		$response->write(json_encode($ret));	
	} else {
	    
	    // como es nula, seteo una respuesta dando el error
	    $response = $app->response();
	    $response->status(400);
    	$response['Content-Type'] = 'application/json';
    	
	    $err = new \nd\response;
	    $err->$error_no = $system->handler->errno;
	    $err->$message = $system->handler->error;
	    
	    $response->write($err->toJson());
	};
});

$app->get('/users/:id', function($id) use ($app, $system){
	$ret = $system->readObject("user", $id);
	
	$response = $app->response();
	$response['Content-Type'] = 'application/json';
	if ($ret) {
		$response->write(json_encode($ret));	
	} else {
	    $response->status(400);
    	$response['Content-Type'] = 'application/json';
	    $err = new \nd\response;
	    
	    if ($system->handler->errno) {
    	    $err->error_no = $system->handler->errno;
    	    $err->message = $system->handler->error;
	    } else {
	        $err->error_no = -1;
    	    $err->message = "No object found under that ID";
	    };
	    $response->write($err->toJson());
	};	
});

$app->post('/users', function() use ($app, $system){
	
	$json = json_decode($app->request()->getBody(), true);
	
	if (is_null($json)) {
		$response = $app->response();
	    $response->status(400);
    	$response['Content-Type'] = 'application/json';
    	
	    $err = new \nd\response;
	    $err->error_no = 1000;
	    $err->message = "Bad JSON";
	    
	    $response->write($err->toJson());
		return;
	}
	$system->handler->autocommit(FALSE);
	$id = $system->createObject("user", $json);
	if ($id) {
		$system->handler->commit();
		$app->response()->write($id);
	} else {
		$response = $app->response();
	    $response->status(400);
    	$response['Content-Type'] = 'application/json';
    	
	    $err = new \nd\response;
	    $err->error_no = $system->handler->errno;
	    $err->message = $system->handler->error;
	    
	    $response->write($err->toJson());
	};
});

$app->put('/users/:id', function($id) use ($app){
	global $system;
    $json = json_decode($app->request()->getBody(), true);
	if (is_null($json)) {
		$response = $app->response();
	    $response->status(400);
    	$response['Content-Type'] = 'application/json';
    	
	    $err = new \nd\response;
	    $err->error_no = $system->handler->errno;
	    $err->message = $system->handler->error;
	    
	    $response->write($err->toJson());
		return;
	}
	$system->handler->autocommit(false);
	$ok = $system->updateObject("user", $id, $json);
	if ($ok) {
		$system->handler->commit();
		//$app->response()->write($id);
	} else {
		$response = $app->response();
	    $response->status(400);
    	$response['Content-Type'] = 'application/json';
    	
	    $err = new \nd\response;
	    $err->error_no = $system->handler->errno;
	    $err->message = $system->handler->error;
	    
	    $response->write($err->toJson());
	};
});

$app->delete('/users/:id', function($id) use ($app, $system){
	$ok = $system->deleteObject("user", $id);
	if ($ok) {
		$app->response()->write($id);
	} else {
		$response = $app->response();
	    $response->status(400);
    	$response['Content-Type'] = 'application/json';
    	
	    $err = new \nd\response;
	    $err->error_no = $system->handler->errno;
	    $err->message = $system->handler->error;
	    $response->write($err->toJson());
	};
});


?>