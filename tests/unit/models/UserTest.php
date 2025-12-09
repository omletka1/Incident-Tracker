<?php

namespace tests\unit\models;

use app\models\User;
use Yii;

class UserTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    public $tester;

    protected function _before()
    {
        $user = User::findOne(['email' => 'tester@example.com']);
        if (!$user) {
            $user = new User();
            $user->name = 'tester';
            $user->email = 'tester@example.com';
            $user->password = Yii::$app->getSecurity()->generatePasswordHash('123456'); // хэш пароля
            $user->auth_key = 'testkey';
            $user->role = 'user';
            $user->save();
        }
    }

    public function testFindUserById()
    {
        $user = User::findOne(['name' => 'tester']);
        verify($user)->notEmpty();
        verify($user->name)->equals('tester');
    }

    public function testFindUserByEmail()
    {
        $user = User::findOne(['email' => 'tester@example.com']);
        verify($user)->notEmpty();
    }

    public function testValidateUser()
    {
        $user = User::findOne(['name' => 'tester']);
        verify($user->validate())->true();
    }
}
