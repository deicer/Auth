<?php


namespace Auth\Controllers;


use Auth\Models\User;
use Auth\View;

class MainController
{
    public function index(): void
    {

        if (User::isUserAuth()) {
            header('Location: /profile');
            die();
        }
        else {
            header('Location: /login');
            die();
        }
    }

    public function profile(): void
    {



        $profile = View::render('profile', ['userData'=>$userData]);

        echo View::render('main', ['titlePage'=>'Профиль пользователя','content' => $profile]);
    }
}
