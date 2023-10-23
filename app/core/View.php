<?php

namespace app\core;

class View {
    public string $path;
    public array $route;
    public string $layout = 'default';

    public function __construct(array $route)
    {
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];
    }

    /**
     * @noinspection PhpUnusedParameterInspection
     */
    public function render(string $title, array $vars = []): void
    {
        extract($vars);
        $path = 'app/views/' . $this->path . '.php';
        if (file_exists($path)) {
            ob_start();
            require $path;
            $content = ob_get_clean();
            require 'app/views/layout/' . $this->layout . '.php';
        } else {
            echo 'View: ' . strtoupper($path) . ' not found!';
        }
    }

    /**
     * @noinspection PhpUnused
     */
    public function redirect(string $url): void
    {
        header('location: ' . $url);
        exit();
    }

    public static function errorCode(int $code): void
    {
        http_response_code($code);
        $path = 'app/views/errors/' . $code . '.php';
        if (file_exists($path)) {
            require $path;
        }
        exit();
    }
}
