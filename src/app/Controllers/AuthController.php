<?php

namespace Auth\Controllers;

use Auth\Models\User;
use Auth\View;
use InvalidArgumentException;

class   AuthController
{
    public function login()
    {

        if ($this->isPost()) {
            try {
                $user = new User($_POST);
                $user->loginValidate();
            } catch (InvalidArgumentException $e) {
                $registerForm = View::render('login', ['error' => $e->getMessage()]);
                echo View::render('main', ['titlePage'=>'Вход','content' => $registerForm]);

                return;
            }

            $userData = $user->login();

        }

        $loginForm = View::render('login', []);

        echo View::render('main', ['titlePage'=>'Вход в систему','content' => $loginForm]);


    }

    public function register(): void
    {


        if ($this->isPost()) {
            try {

                $user = new User($_POST);
                $user->registerValidate();
            } catch (InvalidArgumentException $e) {
                $registerForm = View::render('register', ['error' => $e->getMessage()]);
                echo View::render('main', ['titlePage'=>'Регистрация','content' => $registerForm]);

                return;
            }

            $userData = $user->register();
            $profile = View::render('profile', ['userData'=>$userData]);
            echo View::render('main', ['titlePage'=>'Профиль пользователя','content' => $profile]);

            return;
        }

        $registerForm = View::render('register', []);

        echo View::render('main', ['titlePage'=>'Регистрация','content' => $registerForm]);

    }

    private function isPost(): bool
    {
        return !empty($_POST);
    }





}
