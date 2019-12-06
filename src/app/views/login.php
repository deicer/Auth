<form action="/login" method="post" class="text-center">
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger" role="alert"><?= $error ?></div>
    <?php endif; ?>
    <h2>Вход в систему</h2>
    <div class="form-group">
        <label>Login <input type="text" name="login" class="form-control" value="<?= $_POST['login'] ?? '' ?>""></label>
    </div>
    <div class="form-group">
        <label>Пароль <input type="password" name="password" class="form-control"
                             value="<?= $_POST['password'] ?? '' ?>""></label>
    </div>

    <button type="submit" class="btn btn-primary">Войти</button>
    <a href="/register" class="btn  btn-light"> Я не зарегистрирован</a>
</form>
