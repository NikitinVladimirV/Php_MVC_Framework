<?php

namespace app\core;

class Router
{
    protected array $routes = [];
    protected array $params = [];

    public function __construct()
    {
        $arr = require 'app/config/routes.php';
        foreach ($arr as $key => $value) {
            $this->add($key, $value);
        }
    }
    public function add($route, $params): void
    {
        $route = '#^' . $route . '$#';
        $this->routes[$route] = $params;
    }

    public function match():bool
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {

            if (preg_match($route, $url, $matches)) {

                $this->params = $params;
                return true;
            }
        }
        return false;
    }
    public function run(): void
    {
       if ($this->match()) {
           $path = 'app\controllers\\' . ucfirst($this->params['controller']) . 'Controller';

           if (class_exists($path)) {
               $action = $this->params['action'] . 'Action';

               if (method_exists($path, $action)) {
                   $controller = new $path($this->params);
                   $controller->$action();
               } else {
                   echo 'Action ' . strtoupper($action) . ' not found!' . PHP_EOL;
                   View::errorCode(404);
               }
           } else {
               echo 'Controller ' . strtoupper($path) . ' not found!' . PHP_EOL;
               View::errorCode(404);
           }
       } else {
           echo 'Route not found' . PHP_EOL;
           View::errorCode(404);
       }
    }
}