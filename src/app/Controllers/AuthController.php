<?php

namespace Auth\Controllers;

use Auth\Models\User;
use Auth\View;
use Exception;
use InvalidArgumentException;

class   AuthController extends Controller
{
	public function login()
	{

		if ($this->isPost()) {
			try {
				$user = new User($_POST);
				$user->loginValidate();
			} catch (InvalidArgumentException $e) {
				$registerForm = View::render('login', ['error' => $e->getMessage()]);
				echo View::render('main', ['titlePage' => 'Вход', 'content' => $registerForm]);

				return;
			}

			$user->login();
			header('Location: /');
			die();
		}

		$loginForm = View::render('login', []);

		echo View::render('main', ['titlePage' => 'Вход в систему', 'content' => $loginForm]);


	}

	/**
	 * @throws Exception
	 */
	public function register(): void
	{
		if ($this->isPost()) {
			try {
				$user = new User($_POST);
				$user->registerValidate();
			} catch (InvalidArgumentException $e) {
				$registerForm = View::render('register', ['error' => $e->getMessage()]);
				echo View::render('main',
					['titlePage' => 'Регистрация', 'content' => $registerForm]);

				return;
			}

			$user->register();
			header('Location: /');
			die();
		}

		$registerForm = View::render('register', []);

		echo View::render('main', ['titlePage' => 'Регистрация', 'content' => $registerForm]);

	}

	public function logout()
	{
		session_destroy();
		header('Location: /login');
		die();
	}

}
