<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use app\models\Incident;
use app\models\Comment;

class IncidentController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'rules' => [
                    ['allow' => true, 'roles' => ['@']],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $user = Yii::$app->user->identity;

        // Показываем только свои инциденты
        $incidents = Incident::find()
            ->where(['user_id' => $user->id])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();

        $searchModel = new \app\models\IncidentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get(), Yii::$app->user->identity, 'user');


        return $this->render('index', ['incidents' => $incidents, 'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,]);
    }


    public function actionCreate()
    {
        $model = new Incident();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionView($id)
    {
        $incident = Incident::findOne($id);
        if (!$incident) throw new NotFoundHttpException();

        if (!Yii::$app->user->identity->isAdmin() &&
            $incident->user_id != Yii::$app->user->id)
            throw new ForbiddenHttpException();

        return $this->render('view', ['model' => $incident]);
    }

    public function actionUpdate($id)
    {
        $incident = Incident::findOne($id);
        if (!$incident) throw new NotFoundHttpException();

        if (!Yii::$app->user->identity->isAdmin() &&
            $incident->user_id != Yii::$app->user->id)
            throw new ForbiddenHttpException();

        if ($incident->load(Yii::$app->request->post())) {

            // если не админ — не даём менять статус принудительно
            if (!Yii::$app->user->identity->isAdmin()) {
                $incident->status = $incident->getOldAttribute('status');
            }

            if ($incident->save()) {
                return $this->redirect(['view', 'id' => $id]);
            }
        }


        return $this->render('update', ['model' => $incident]);
    }

    public function actionDelete($id)
    {
        $incident = Incident::findOne($id);
        if (!$incident) throw new NotFoundHttpException();

        if (!Yii::$app->user->identity->isAdmin() &&
            $incident->user_id != Yii::$app->user->id)
            throw new ForbiddenHttpException();

        $incident->delete();
        return $this->redirect(['index']);
    }
}
