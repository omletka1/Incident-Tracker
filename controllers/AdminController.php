<?php

namespace app\controllers;

use app\models\IncidentSearch;
use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use app\models\Incident;
use app\models\User;

class AdminController extends Controller
{
    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin()) {
            throw new ForbiddenHttpException('Требуется админ.');
        }
        return parent::beforeAction($action);
    }


    public function actionIndex()
    {
        $totalIncidents = \app\models\Incident::find()->count();
        $activeIncidents = \app\models\Incident::find()->where(['status' => 'in_progress'])->count();
        $usersCount = \app\models\User::find()->count();

        return $this->render('index', [
            'totalIncidents' => $totalIncidents,
            'activeIncidents' => $activeIncidents,
            'usersCount' => $usersCount,
        ]);
    }


    public function actionIncidents()
    {
        $user = Yii::$app->user->identity;
        if (!$user->isAdmin()) {
            throw new \yii\web\ForbiddenHttpException('Доступ запрещён.');
        }

        $searchModel = new IncidentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get(), Yii::$app->user->identity, 'admin');


        return $this->render('incidents', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionEditIncident($id)
    {
        $user = Yii::$app->user->identity;
        if (!$user->isAdmin()) {
            throw new \yii\web\ForbiddenHttpException('Доступ запрещён.');
        }

        $incident = Incident::findOne($id);
        if (!$incident) throw new \yii\web\NotFoundHttpException('Инцидент не найден.');

        if ($incident->load(Yii::$app->request->post()) && $incident->save()) {
            return $this->redirect(['incidents']);
        }

        return $this->render('edit-incident', ['incident' => $incident]);
    }


    public function actionUsers()
    {
        $users = User::find()->all();
        return $this->render('users', ['users' => $users]);
    }

    public function actionEditUser($id)
    {
        $user = User::findOne($id);
        if (!$user) throw new \yii\web\NotFoundHttpException('Пользователь не найден.');
        if (Yii::$app->request->isPost) {
            $user->load(Yii::$app->request->post());
            if ($user->save()) return $this->redirect(['users']);
        }
        return $this->render('edit-user', ['user' => $user]);
    }
}
