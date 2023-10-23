<?php

namespace app\core;

class View {
    public string $path;
    public array $route;
    public string $layout = 'default';

    /**
     * @param array $route
     */
    public function __construct(array $route)
    {
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];
    }

    /**
     * @noinspection PhpUnusedParameterInspection
     * @param string $title
     * @param array $vars
     * @return void
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
            View::errorCode(404);
        }
    }

    /**
     * @noinspection PhpUnused
     * @param string $url
     * @return void
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

    /**
     * @noinspection PhpUnused
     * @param string $status
     * @param string $message
     * @return void
     */
    public function message(string $status, string $message): void
    {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }

    /**
     * @noinspection PhpUnused
     * @param string $url
     * @return void
     */
    public function location(string $url): void
    {
        exit(json_encode(['url' => $url]));
    }
}
