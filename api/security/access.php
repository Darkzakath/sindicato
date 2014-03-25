<?php

$app->post('/login', function () use ($app) {
    $auth = new Auth();   

    $json = json_decode($app->request()->getBody(), true);

    $user = R::findOne('business', 'username LIKE ? AND password LIKE ?', [$json["username"], md5($json["password"])]);

    if ($user) {
        $token = $auth->generateToken($user->id);
        $app->response->headers->set('ACCESS_TOKEN', $token);
        $app->setCookie('ACCESS_TOKEN', $token);
        $app->response()->status(200);
        $app->response()->write($token);
    } else {
        $app->response()->status(500);
        $app->response()->write(response::fail("invalid user")->toJson());
    };
});

//login of business
$app->post('/login/business', function () use ($app) {
    $auth = new Auth();

    $json = json_decode($app->request()->getBody(), true);

    $business = R::findOne('business', 'cuit LIKE ? AND password LIKE ? AND active', [$json["cuit"], md5($json["password"])]);

    if ($business) {
        $token = $auth->generateToken($business->id);
        $app->response->headers->set('ACCESS_TOKEN', $token);
        $app->setCookie('ACCESS_TOKEN', $token);
        $app->response()->status(200);
        $app->response()->write($token);
    } else {
        $app->response()->status(500);
        $app->response()->write(response::fail("invalid user")->toJson());
    };
});


$app->post('/logout', function () use ($app) {
    $auth = new Auth();
    $token = $app->request->headers->get('ACCESS_TOKEN');
    if (!$token) $token = $app->getCookie('ACCESS_TOKEN');
    if ($auth->obsoleteToken($token)) {
        $app->response()->write(response::pass("logout succefully")->toJson());
    } else {
        $app->response()->status(500);
        $app->response()->write(response::fail("invalid token")->toJson());
    };

});

$app->get('/my', function () use ($app) {
    $auth = new Auth();
    //$headers = $app->request->headers;
    $headers = getallheaders();
    //$token = $app->request->headers->get('ACCESS_TOKEN');
    //var_dump($token);
    //$token = $app->request->headers('ACCESS_TOKEN');
    //var_dump($token);
    $token = $headers["ACCESS_TOKEN"];
    $userid = $auth->getUserId($token);
    $user = R::load("business", $userid);
    $app->response['Content-Type'] = 'application/json';
    $app->response->write(json_encode($user->export()));
});

?>