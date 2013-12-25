<?php

$app->get('/users/', function() use ($app, $system){   
    $ret = $system->readObjectList("user");	
	$response = $app->response();
	$response['Content-Type'] = 'application/json';
	if (!is_null($ret)) {
		$response->write(json_encode($ret));	
	} else {
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
	    $err->error_no = $system->handler->errno;
	    $err->message = $system->handler->error;
	    
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


?>