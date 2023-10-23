<?php

namespace app\controllers;

use app\core\AbstractController;

/**
 * @noinspection PhpUnused
 */
class MainController extends AbstractController
{
    /**
     * @noinspection PhpUnused
     * @return void
     */
    public function indexAction(): void
    {
        $result = $this->model->getNews();
        $vars = [
            'news' => $result,
        ];
        $this->view->render('PHP MVC Framework', $vars);
    }
}