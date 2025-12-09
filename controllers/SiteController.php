<?php
namespace app\controllers;

use app\models\Incident;
use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\RegisterForm;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        // Все активные инциденты (new + in_progress)
        $activeIncidents = Incident::find()->where(['status' => ['new', 'in_progress']])->count();

        // Высокий приоритет среди активных
        $highPriority = Incident::find()->where(['priority' => 'high'])
            ->andWhere(['status' => ['new', 'in_progress']])
            ->count();

        // В работе
        $inWork = Incident::find()->where(['status' => 'in_progress'])->count();

        // Дополнительно можно посчитать проценты прямо здесь
        $highPriorityPercent = $activeIncidents > 0 ? round($highPriority / $activeIncidents * 100) : 0;
        $inWorkPercent = $activeIncidents > 0 ? round($inWork / $activeIncidents * 100) : 0;

        return $this->render('index', [
            'activeIncidents' => $activeIncidents,
            'highPriority' => $highPriority,
            'inWork' => $inWork,
            'highPriorityPercent' => $highPriorityPercent,
            'inWorkPercent' => $inWorkPercent,
        ]);
    }


    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['incident/index']);
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post())) {
            // Добавим отладочный вывод
            Yii::debug('Attempting login for email: ' . $model->email);

            if ($model->login()) {
                Yii::debug('Login successful');
                return $this->redirect(['site/index']);
            } else {
                Yii::debug('Login failed. Errors: ' . print_r($model->errors, true));
            }
        }

        return $this->render('login', ['model' => $model]);
    }

    public function actionRegister()
    {
        $model = new RegisterForm();

        if ($model->load(Yii::$app->request->post())) {
            $user = $model->register();
            if ($user) {
                Yii::$app->user->login($user);
                return $this->redirect(['incident/index']);
            }
        }

        return $this->render('register', ['model' => $model]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['site/login']);
    }
}
