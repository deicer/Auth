<?php

namespace Auth\Models;


use InvalidArgumentException;

class User extends Model
{

    public function login()
    {

        $this->params = $this->findOne('login', $this->params['login']);
        $this->refreshAuthToken();

        $_SESSION['auth_token'] = $this->params['auth_token'];

        var_dump($_SESSION);
        return $this->params;
    }


    /**
     * @return array|mixed
     */
    public function register()
    {
        $this->insert();
        $this->params = $this->findOne('login', $this->params['login']);

        session_start();
        $_SESSION['auth_token'] = $this->params['auth_token'];

        return $this->params;
    }

    private function findOne(string $column, $value)
    {
        return $this->db->queryOne(
            'SELECT * FROM users WHERE ' . $column . '=:value LIMIT 1;',
            [':value' => $value]
        );
    }

    private function insert(): void
    {
        $this->prepareParams();
        $this->db->insert('users', array_keys($this->params), $this->params);
    }

    /**
     */
    public function registerValidate(): void
    {

        if (empty($this->params['login'])) {
            throw new InvalidArgumentException('Введите login');
        }

        if (empty($this->params['email'])) {
            throw new InvalidArgumentException('Введите email');
        }

        if (!filter_var($this->params['email'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email введен неверно');
        }

        if (empty($this->params['password'])) {
            throw new InvalidArgumentException('Введите password');
        }

        if (empty($this->params['name'])) {
            throw new InvalidArgumentException('Введите имя');
        }

        if (empty($this->params['lastname'])) {
            throw new InvalidArgumentException('Введите фамилию');
        }

        if (empty($this->params['surname'])) {
            throw new InvalidArgumentException('Введите отчество');
        }

        if ($this->findOne('login', $this->params['login']) !== null) {
            throw new InvalidArgumentException('Пользователь с таким login уже существует');
        }

        if ($this->findOne('email', $this->params['email']) !== null) {
            throw new InvalidArgumentException('Пользователь с таким email уже существует');
        }
    }

    public function loginValidate(): void
    {

        if (empty($this->params['login'])) {
            throw new InvalidArgumentException('Не указан логин');
        }

        if (empty($this->params['password'])) {
            throw new InvalidArgumentException('Не указан пароль');
        }

        if ($this->findOne('login', $this->params['login']) === null) {
            throw new InvalidArgumentException('Нет пользователя с таким login');
        }

        if (!password_verify($this->params['password'], $this->getPasswordHash())) {
            throw new InvalidArgumentException('Неправильный пароль');
        }

    }

    private function prepareParams(): void
    {
        $this->params['password_hash'] = $this->getPasswordHash();
        $this->params['auth_token'] = bin2hex(random_bytes(64));

        unset($this->params['password']);
    }

    /**
     * @return false|string|null
     */
    private function getPasswordHash()
    {
        return password_hash($this->params['password'], PASSWORD_DEFAULT);
    }

    private function refreshAuthToken(): void
    {
        $this->db->updateOne('users', 'auth_token', $this->params['auth_token'],$this->params['id']);
    }

    public static function isUserAuth(): bool
    {
        return isset($_SESSION['auth_token']) ? true : false;
    }


}
