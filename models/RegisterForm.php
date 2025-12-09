<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RegisterForm extends Model
{
    public $name;
    public $email;
    public $password;
    public $role;

    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required'],
            ['email', 'email'],
            ['password', 'string', 'min' => 6],
            ['role', 'in', 'range' => [0, 1]]
        ];
    }

    public function register()
    {
        if (!$this->validate()) return false;

        $exists = User::findOne(['email' => $this->email]);
        if ($exists) {
            $this->addError('email', 'Email уже зарегистрирован.');
            return false;
        }

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = password_hash($this->password, PASSWORD_DEFAULT);
        $user->role = $this->role;
        $user->auth_key = Yii::$app->security->generateRandomString();


        return $user->save() ? $user : false;
    }
}
