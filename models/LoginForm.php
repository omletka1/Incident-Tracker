<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $name;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
        ];
    }

    public function login()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = User::findByEmail($this->email);

        if (!$user) {
            $this->addError('email', 'Пользователь не найден.');
            return false;
        }

        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Неверный пароль.');
            return false;
        }

        return Yii::$app->user->login($user, 3600*24*30);
    }
}