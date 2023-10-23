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
     */
    public function indexAction(): void
    {
        $this->view->render('PHP MVC Framework');
    }
}