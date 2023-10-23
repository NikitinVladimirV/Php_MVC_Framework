<?php

namespace app\controllers;

use app\core\AbstractController;

/**
 * @noinspection PhpUnused
 */
class AccountController extends AbstractController
{
    /**
     * @noinspection PhpUnused
     */
    public function loginAction(): void
    {
        $this->view->render('Page of login');
    }

    /**
     * @noinspection PhpUnused
     */
    public function RegisterAction(): void
    {
        $this->view->render('Page of register');
    }
}