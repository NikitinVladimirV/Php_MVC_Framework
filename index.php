<?php

require 'app/lib/Dev.php';

use app\core\Router;

spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class . '.php');
    if (file_exists($path)) {
        require $path;
    }
    return null;
});

session_start();

$router = new Router();

$b = 33;

$router->run();
