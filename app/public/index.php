<?php

// Chargement du sytéme d'autoload
require_once "../vendor/autoload.php";

use MiladRahimi\PhpRouter\Router;

$router = Router::create();

$router->get('/', function () {
    return 'This is a closure controller!';
});

$router->dispatch();

