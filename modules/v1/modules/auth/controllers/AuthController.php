<?php

namespace app\modules\v1\modules\auth\controllers;

use app\modules\v1\modules\auth\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\modules\v1\modules\auth\models\LoginForm;
use app\modules\v1\modules\auth\models\SignupForm;

class AuthController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->actionLogin();
        }
        $id = Yii::$app->user->id;
        $user = User::findIdentity($id);
        return $this->render('index', [
            'user' => $user
        ]);
    }


    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $id = Yii::$app->user->id;
            $user = User::findIdentity($id);
            return $this->render('index', [
                'user' => $user
            ]);
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }


    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->signup();
            $model2 = new LoginForm();
            $model2->load(Yii::$app->request->post());
            Yii::$app->user->login(User::findByUsername($model->username), $model2->rememberMe ? 3600*24*30 : 0);

            return $this->actionIndex();
        } else {
            return $this->render('signup', ['model' => $model]);
        }
    }
}