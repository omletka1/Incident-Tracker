<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Comment extends ActiveRecord {

    public static function tableName() {
        return "comments";
    }

    public function rules()
    {
        return [
            [['comment'],'required'],
            [['comment'],'string'],
            [['incident_id','user_id'],'integer'],
        ];
    }


    public function getUser() {
        return $this->hasOne(User::class, ['id'=>'user_id']);
    }
}
