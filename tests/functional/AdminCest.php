<?php

use app\models\Incident;
use app\models\User;

class AdminCest
{
    public function adminAccess(FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage('/index-test.php?r=admin');

        $I->see('Админ-панель');
        $I->see('Панель управления системой инцидентов');
        $I->see('Добро пожаловать');
    }

    public function usersListVisible(FunctionalTester $I)
    {
        $I->amLoggedInAs(1);

        $user = new User([
            'name' => 'Тестовый Пользователь',
            'email' => 'test_user@example.com',
            'password' => 'hash',
            'role' => 'user',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        $user->save(false);

        $I->amOnPage('/index-test.php?r=admin/users');

        $I->seeElement('table.data-table');

        $I->see('Тестовый Пользователь', 'table.data-table tbody tr td');
        $I->see('test_user@example.com', 'table.data-table tbody tr td');
    }

    public function incidentsVisible(FunctionalTester $I)
    {
        $I->amLoggedInAs(1);

        $incident = new Incident([
            'user_id' => 1,
            'title' => 'Тестовый инцидент',
            'description' => 'Описание инцидента',
            'status' => 'new',
            'priority' => 'high',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $incident->save(false);

        $I->amOnPage('/index-test.php?r=admin/incidents&IncidentSearch[title]=');

        $I->seeElement('table.data-table');

        $I->see("Тестовый инцидент", "table.data-table tbody tr td.cell-title a");
        $I->see("алена", "table.data-table tbody tr td.cell-author");
        $I->see("Новый", "table.data-table tbody tr td.cell-status span.status-new");
        $I->see("Высокий", "table.data-table tbody tr td.cell-priority span.priority-high");


    }


}
