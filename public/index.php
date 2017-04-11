<?php
require __DIR__.'/../vendor/autoload.php';

$router = new App\Router\Router($_SERVER['REQUEST_URI']);

$router->get('/', 'PasswordController@index');

$router->run();