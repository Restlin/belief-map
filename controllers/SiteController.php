<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\User;
use app\models\Page;

class SiteController extends Controller
{
    private function isManager(): bool {
        if(Yii::$app->user->isGuest) {
            return false;
        }
        $user = Yii::$app->user->identity->user;
        /* @var $user User*/
        return $user->type == User::TYPE_COMPANY_MANAGER;
    }
    private function isAdmin(): bool {
        if(Yii::$app->user->isGuest) {
            return false;
        }
        $user = Yii::$app->user->identity->user;
        /* @var $user User*/
        return $user->type == User::TYPE_ADMIN;
    }
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'index'],
                'rules' => [
                    [
                        'actions' => ['logout', 'index', 'use', 'arguments', 'resources', 'about'],
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

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $view = $this->isAdmin() ? 'index_admin' : 'index';
        $company = Yii::$app->user->identity->user->company;

        return $this->render($view, [
            'isAdmin' => $this->isAdmin(),
            'isManager' => $this->isManager(),
            'company' => $company
        ]);
    }

    public function actionUse() {
        return $this->render('use', ['mapId' => 1]);
    }

    public function actionAbout() {
        return $this->render('about');
    }
    
    public function actionArguments() {
        return $this->render('arguments');
    }

    public function actionResources($page = 1) {
        $view = $page == 1  ? 'resources' : 'other';
        return $this->render($view);
    }    

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionHelp()
    {
        $company = Yii::$app->user->identity->user->company;
        $page = Page::findOne(['name' => 'help']);

        return $this->render('help', [
            'company' => $company,
            'content' => $page->content,
        ]);
    }
    
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
