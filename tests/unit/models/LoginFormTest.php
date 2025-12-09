<?php

namespace tests\unit\models;

use app\models\User;
use app\models\LoginForm;
use Yii;

class LoginFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    public $tester;

    protected function _before()
    {
        $user = new User();
        $user->name = 'tester';
        $user->email = 'tester@example.com';
        $user->password = Yii::$app->getSecurity()->generatePasswordHash('123456');
        $user->auth_key = 'testkey';
        $user->role = 'user';
        $user->save();
    }


    public function testLoginNoUser()
    {
        $model = new LoginForm();
        $model->email = 'nonexist@example.com';
        $model->password = '123';
        verify($model->login())->false();
        verify($model->hasErrors('email'))->true();
    }

    public function testLoginWrongPassword()
    {
        $model = new LoginForm();
        $model->email = 'tester@example.com';
        $model->password = 'wrongpass';
        verify($model->login())->false();
        verify($model->hasErrors('password'))->true();
    }

    public function testLoginCorrect()
    {
        $model = new LoginForm();
        $model->email = 'tester@example.com';
        $model->password = '123456';
        verify($model->login())->true();
    }
}
