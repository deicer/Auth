<?php

/** @var array $userData */
?>

<a href="/logout" class="btn btn-light">Выйти</a>
<div class="container">
<h1>Личный кабинет</h1>
	<div class="row">
		<div class="col-12">
			<strong>Login</strong> - <?= $userData['login']?>
		</div>
		<div class="col-12">
			<strong>Email</strong> - <?= $userData['email']?>
		</div>

		<div class="col-12">
			<strong>Фамилия</strong> - <?= $userData['lastname']?>
		</div>
		<div class="col-12">
			<strong>Имя</strong> - <?= $userData['name']?>
		</div>
		<div class="col-12">
			<strong>Отчество</strong> - <?= $userData['surname']?>
		</div>
	</div>
	<div class="row">
		<a href="/profile/edit" class="btn btn-light">Редактировать</a>
	</div>
</div>



