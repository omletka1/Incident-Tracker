<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Incident extends ActiveRecord
{

    public static function tableName()
    {
        return "incidents";
    }

    public function rules()
    {
        return [
            [['title', 'priority'], 'required'],
            ['description', 'string'],
            ['priority', 'in', 'range' => ['low', 'medium', 'high']],
            ['status', 'in', 'range' => ['new', 'in_progress', 'closed']]
        ];
    }

    public static function getStatusList()
    {
        return [
            'new' => 'Новый',
            'in_progress' => 'В работе',
            'closed' => 'Закрыт',
        ];
    }

    public static function getPriorityList()
    {
        return [
            'low' => 'Низкий',
            'medium' => 'Средний',
            'high' => 'Высокий',
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'status' => 'Статус',
            'priority' => 'Приоритет',
            'user_id' => 'Автор',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    public function getStatusText()
    {
        $list = self::getStatusList();
        return $list[$this->status] ?? $this->status;
    }

    public function getPriorityText()
    {
        $list = self::getPriorityList();
        return $list[$this->priority] ?? $this->priority;
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getComments()
    {
        return $this->hasMany(Comment::class, ['incident_id' => 'id']);
    }
}
