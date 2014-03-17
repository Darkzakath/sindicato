<?php

$app->get('/business', function($id) use ($app) {});

$app->get('/business/:id', function($id) use ($app) {});

$app->post('/business/:id', function($id) use ($app) {});

$app->put('/business/:id', function($id) use ($app) {});

$app->delete('/business/:id', function($id) use ($app) {});

?>