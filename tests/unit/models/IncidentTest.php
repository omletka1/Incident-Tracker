<?php

namespace tests\unit\models;

use app\models\Incident;
use app\models\User;
use Yii;

class IncidentTest extends \Codeception\Test\Unit
{
    public function testStatusText()
    {
        $incident = new Incident();
        $incident->status = 'new';
        $this->assertEquals('Новый', $incident->getStatusText());

        $incident->status = 'in_progress';
        $this->assertEquals('В работе', $incident->getStatusText());

        $incident->status = 'closed';
        $this->assertEquals('Закрыт', $incident->getStatusText());
    }

    public function testPriorityText()
    {
        $incident = new Incident();
        $incident->priority = 'low';
        $this->assertEquals('Низкий', $incident->getPriorityText());

        $incident->priority = 'medium';
        $this->assertEquals('Средний', $incident->getPriorityText());

        $incident->priority = 'high';
        $this->assertEquals('Высокий', $incident->getPriorityText());
    }
}
