<?php

declare(strict_types=1);

use app\models\Incident;

class IncidentCest
{
    public function _before(FunctionalTester $I)
    {
        // Логинимся как админ
        $I->amLoggedInAs(1);

        // Создаём тестовый инцидент
        $incident = new Incident();
        $incident->title = 'Тестовый инцидент';
        $incident->status = 'new';
        $incident->priority = 'high';
        $incident->user_id = 1;
        $incident->save();
    }

    public function incidentsVisible(FunctionalTester $I)
    {
        $I->amOnPage('/index-test.php?r=admin/incidents');
        $I->seeElement('table.data-table');
        $I->see('Тестовый инцидент', 'table.data-table tbody tr td.cell-title a');
        $I->see('Новый', 'table.data-table tbody tr td.cell-status span.status-new');
        $I->see('Высокий', 'table.data-table tbody tr td.cell-priority span.priority-high');
    }

    public function denyAccessForUser(FunctionalTester $I)
    {
        $I->amOnPage('/index-test.php?r=site/logout');
        $I->amLoggedInAs(2);
        $I->amOnPage("/admin/index");

    }
}
