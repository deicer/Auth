<?php


namespace Auth\Controllers;


use Auth\Models\User;
use Auth\View;

class MainController extends Controller
{
	public function index(): void
	{

		if (User::isUserAuth()) {
			header('Location: /profile');
			die();
		} else {
			header('Location: /login');
			die();
		}
	}

	public function profile(): void
	{
		$userData = User::getUser($_SESSION['auth_token']);

		$profile = View::render('profile', ['userData' => $userData]);

		echo View::render('main', ['titlePage' => 'Профиль пользователя', 'content' => $profile]);
	}

	public function profileEdit()
	{
		if ($this->isPost()) {

			$user = new User($_POST);
			$user->profileEdit();

			header('Location: /profile');
			die();
		}

		$userData = User::getUser($_SESSION['auth_token']);

		$profileForm = View::render('profile-edit', ['userData' => $userData]);

		echo View::render('main', [
			'titlePage' => 'Редактирование профиля',
			'content'   =>
				$profileForm,
		]);
	}
}
