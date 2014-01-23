<?php

$app->post('/register/business', function() use ($system, $app) {
    $response = $app->response();
	$response['Content-Type'] = 'application/json';

    $json = json_decode($app->request()->getBody(), true);

    //check for all values
    $ok = true;
    $ok = $ok && isset($json['cuit']);
    $ok = $ok && isset($json['password']);
    $ok = $ok && isset($json['password2']);
    $ok = $ok && isset($json['email']);
    $ok = $ok && isset($json['email2']);

    if (!$ok){
        $app->response()->status(500);
        $app->response()->write(\nd\response::fail("invalid JSON")->toJson());
        return;
    };

    //validatiokn
    $err_validation = "";
    if (!(is_numeric($json['cuit']) && $json['cuit'] > 10000000000 && $json['cuit'] < 99999999999)) $err_validation = "CUIT invalido";
    if ($json['password'] !== $json['password2'])  $err_validation = "Passwords no coinciden";
    if ($json['email'] !== $json['email2'])  $err_validation = "Passwords no coinciden";

    if ($err_validation !== "") {
        $app->response()->status(500);
        $app->response()->write(\nd\response::fail("invalid JSON")->toJson());
        return;
    };

    // all ok, let persist
    $business = array();
    $business["correo"] = $json['email'];
	$business["cuit"] = $json['cuit'];
	$business["password"] = md5($json['password']);
	$business["domicilio"] = "";
	$business["localidad"] = "";
	$business["nombre"] = "";
	$business["razonsocial"] = "";
	$business["telefono"] = "";

	$system->handler->autocommit(FALSE);
	$id = $system->createObject("empresa", $business);

	if ($id) {
		$system->handler->commit();
		$app->response()->write($id);
	} else {
		$app->response()->status(500);
        $app->response()->write(\nd\response::fail("persist failed", $system->handler->error, $system->handler->errno)->toJson());
	};

});


?>