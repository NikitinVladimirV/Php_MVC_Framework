<?php

namespace app\core;

class Router
{
    protected array $routes;
    protected array $params;
    protected array $matches;

    public function __construct()
    {
        $routes = require 'app/config/routes.php';

        foreach ($routes as $key => $value) {
            $this->add($key, $value);
        }
    }

    /**
     * @param string $route
     * @param array $params
     * @return void
     */
    public function add(string $route, array $params): void
    {
        $route = '#^' . $route . '$#';
        $this->routes[$route] = $params;
    }

    /**
     * @return bool
     */
    public function match():bool
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');

        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                $this->matches = $matches;
                $this->params = $params;

                return true;
            }
        }

        return false;
    }

    /**
     * @return void
     */
    public function run(): void
    {
        if (!$this->match()) {
            View::errorCode(404);
        }

        $path = 'app\controllers\\' . ucfirst($this->params['controller']) . 'Controller';

        if (!class_exists($path)) {
            View::errorCode(404);
        }

        $action = $this->params['action'] . 'Action';

        if (!method_exists($path, $action)) {
            View::errorCode(404);
        }

        $controller = new $path($this->params);
        $controller->$action();
    }
}