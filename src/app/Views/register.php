<form action="/register" method="post" class="text-center">
    <?php if (!empty($error)) { ?>
        <div class="alert alert-danger" role="alert"><?= $error ?></div>
    <?php } ?>
    <h2>Регистрация</h2>
    <div class="form-group">
    <label>Login <input type="text" name="login" class="form-control" value="<?= $_POST['login'] ?? '' ?>""></label>
    </div>

    <div class="form-group">
    <label>Email <input type="text" name="email" class="form-control" value="<?= $_POST['email'] ?? '' ?>""></label>
    </div>
    <div class="form-group">
    <label>Пароль <input type="password" name="password" class="form-control" value="<?= $_POST['password'] ?? '' ?>""></label>
    </div>
    <div class="form-group">
        <label>Имя <input type="text" name="name" class="form-control" value="<?= $_POST['name'] ?? '' ?>""></label>
    </div>
    <div class="form-group">
        <label>Фамилия <input type="text" name="lastname" class="form-control" value="<?= $_POST['lastname'] ?? '' ?>""></label>
    </div>
    <div class="form-group">
        <label>Отчество <input type="text" name="surname" class="form-control" value="<?= $_POST['surname'] ?? '' ?>""></label>
    </div>
    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
</form>
