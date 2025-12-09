<?php


use app\models\User;

class LoginFormCest
{

    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
    }

    public function loginWithValidCredentials(FunctionalTester $I)
    {
        $I->submitForm('form', [
            'LoginForm[email]' => '1111@mail.ru',
            'LoginForm[password]' => '123456'
        ]);

        $I->seeInCurrentUrl('r=site%2Findex');

    }

    public function loginWithInvalidEmail(FunctionalTester $I)
    {
        $I->fillField('LoginForm[email]', 'notexists@example.com');
        $I->fillField('LoginForm[password]', 'any_password');
        $I->click('Войти');
        $I->see('Пользователь не найден.');
    }

    public function loginWithWrongPassword(FunctionalTester $I)
    {
        $I->fillField('LoginForm[email]', '1111@mail.ru');
        $I->fillField('LoginForm[password]', 'wrongpassword');
        $I->click('Войти');
        $I->see('Неверный пароль.');
    }
}
