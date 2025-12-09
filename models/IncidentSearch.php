<?php
namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class IncidentSearch extends Incident
{
    public $q; // текстовый поиск
    public $date_from;
    public $date_to;

    public function rules()
    {
        return [
            [['q', 'status', 'priority'], 'safe'],
            [['date_from', 'date_to'], 'safe'],
        ];
    }

    public function search($params, $user, $context = 'user')
    {
        $query = Incident::find();

        if ($context === 'user') {
            $query->andWhere(['user_id' => $user->id]);
        }

        $this->load($params);

        if (!$this->validate()) {
            return new ActiveDataProvider(['query' => $query]);
        }

        if ($this->q) {
            $query->andWhere(['or',
                ['like', 'title', $this->q],
                ['like', 'description', $this->q],
                ['id' => $this->q]
            ]);
        }

        if ($this->status) {
            $query->andWhere(['status' => $this->status]);
        }

        if ($this->priority) {
            $query->andWhere(['priority' => $this->priority]);
        }

        if ($this->date_from) {
            $query->andWhere(['>=', 'created_at', $this->date_from]);
        }

        if ($this->date_to) {
            $query->andWhere(['<=', 'created_at', $this->date_to]);
        }

        return new ActiveDataProvider([
            'query' => $query->orderBy(['created_at' => SORT_DESC]),
            'pagination' => ['pageSize' => 20],
        ]);
    }



}
