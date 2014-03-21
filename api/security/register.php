<?php

$app->post('/register/business', function() use ($app) {
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
        $app->response()->write(response::fail("invalid JSON")->toJson());
        return;
    };

    //validatiokn
    $err_validation = "";
    if (!(is_numeric($json['cuit']) && $json['cuit'] > 10000000000 && $json['cuit'] < 99999999999)) $err_validation = "CUIT invalido";
    if ($json['password'] !== $json['password2'])  $err_validation = "Passwords no coinciden";
    if ($json['email'] !== $json['email2'])  $err_validation = "Passwords no coinciden";

    if ($err_validation !== "") {
        $app->response()->status(500);
        $app->response()->write(\nd\response::fail("invalid data")->toJson());
        return;
    };

    // all ok, let persist
    $business = R::dispense('business');
    $business->cuit = $json["cuit"];
    $business->email = $json['email'];
    $business->password = md5($json["password"]);
    $business->token = md5($business->cuit + $business->email);
    $business->active = false;
    $business->expiration = date(DateTime::ISO8601, time() + (7 * 24 * 60 * 60)); //one week

	R::begin();
	
    $id = R::store($business);

	if ($id) {
		R::commit();
		$app->response()->write($business->token);
	} else {
        R::rollback();
		$app->response()->status(500);
        $app->response()->write(response::fail("persist failed")->toJson());
	};

});

$app->post('/register/business/:token', function($token) use ($app) {
    $response = $app->response();
    $response['Content-Type'] = 'application/json';

    $token = R::findOne('business', 'token LIKE ? and NOT active', [$token]);
    if ($token) {        
        $token->active = true;
        R::store($token);
        $response->status(200);
        $response->write("{}");
    } else {
        $app->response()->status(500);
        $app->response()->write(response::fail("token invalido")->toJson());
    };
});

?>