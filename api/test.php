<?php

require_once 'libs/RedBean/rb.phar';

R::setup('mysql:host=localhost;dbname=test', 'root', '');

/*$user = R::load('user', 3);
$auth_token = R::dispense('authtokens');
$auth_token->user = $user;
$auth_token->token = MD5('asdcfgvbhnjmk');
$auth_token->expire = date(DateTime::ISO8601);

R::store($auth_token);*/
$token = R::findOne('authtokens', 'token LIKE ?', ['d404d12c718931e367cefef07cb0e8b1']);

?>