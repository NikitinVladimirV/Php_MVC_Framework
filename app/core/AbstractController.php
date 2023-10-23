<?php

namespace app\core;

abstract class AbstractController
{
    public array $route;
    public View $view;
    private array $success;
    protected AbstractModel $model;

    /**
     * @param $route
     */
    public function __construct($route)
    {
        $this->route = $route;
        if (!$this->checkSuccess()) {
            View::errorCode(403);
        }
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }

    /**
     * @param $modelName
     * @return AbstractModel|null
     */
    public function loadModel($modelName): ?AbstractModel
    {
        $path = 'app\models\\' . ucfirst($modelName) . 'Model';

        if (class_exists($path)) {
            return new $path;
        } else {
            View::errorCode(404);

            return null;
        }
    }

    /**
     * ?
     * @return bool
     */
    public function checkSuccess(): bool
    {
        $this->success = require 'app/success/' . $this->route['controller'] . '.php';

        if ($this->isSuccess('all')) {
            return true;
        } elseif (isset($_SESSION['authorize']['id']) && $this->isSuccess('authorize')) {
            return true;
        } elseif (!isset($_SESSION['authorize']['id']) && $this->isSuccess('guest')) {
            return true;
        } elseif (isset($_SESSION['admin']['id']) && $this->isSuccess('admin')) {
            return true;
        }
        return false;
    }

    /**
     * @param $key
     * @return bool
     */
    public function isSuccess($key): bool
    {
        return in_array($this->route['action'], $this->success[$key]);
    }
}
