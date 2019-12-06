<form action="/profile/edit" method="post" class="text-center">
    <h2>Редактирование профиля</h2>
    <div class="form-group">
        <label>Фамилия <input type="text" name="lastname" class="form-control" value="<?=
	        $userData['lastname'] ?? '' ?>""></label>
    </div>
	<div class="form-group">
		<label>Имя <input type="text" name="name" class="form-control" value="<?=
			$userData['name'] ?? '' ?>""></label>
	</div>
	<div class="form-group">
		<label>Отчество <input type="text" name="surname" class="form-control" value="<?=
			$userData['surname'] ?? '' ?>""></label>
	</div>

    <button type="submit" class="btn btn-primary">Сохранить</button>
    <a href="/profile" class="btn  btn-light"> Отмена</a>
</form>
