<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Comment;
use app\models\Incident;

class CommentController extends Controller
{
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>\yii\filters\AccessControl::class,
                'rules'=>[['allow'=>true,'roles'=>['@']]],
            ],
            'verbs'=>[
                'class'=>\yii\filters\VerbFilter::class,
                'actions'=>[
                    'add'=>['post'],
                    'delete'=>['post'],
                ],
            ],
        ];
    }

    public function actionAdd($incident_id)
    {
        $incident = Incident::findOne($incident_id);
        if (!$incident) throw new NotFoundHttpException('Инцидент не найден.');

        $model = new Comment();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->incident_id = $incident_id;
            $model->user_id = Yii::$app->user->id;
            $model->created_at = date('Y-m-d H:i:s');
            if ($model->save()) {
                return $this->redirect(['incident/view','id'=>$incident_id]);
            }
        }
        return $this->redirect(['incident/view','id'=>$incident_id]);
    }

    public function actionDelete($id)
    {
        $model = Comment::findOne($id);
        if (!$model) throw new NotFoundHttpException('Комментарий не найден.');

        // только автор комментария или админ может удалить
        if ($model->user_id != Yii::$app->user->id && !Yii::$app->user->identity->isAdmin()) {
            throw new \yii\web\ForbiddenHttpException('Доступ запрещён.');
        }

        $incidentId = $model->incident_id;
        $model->delete();
        return $this->redirect(['incident/view','id'=>$incidentId]);
    }
}
