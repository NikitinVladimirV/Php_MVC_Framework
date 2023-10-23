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
     * @return void
     */
    public function loginAction(): void
    {
//        if (!empty($_POST)) {
//            $this->view->message('Success!', 'Description!');
//            $this->view->location('/account/register');
//        }
        $this->view->render('Page of login');
    }

    /**
     * @noinspection PhpUnused
     * @return void
     */
    public function RegisterAction(): void
    {
        $this->view->render('Page of register');
    }
}