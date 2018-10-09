<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class WebController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }






    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionLogin()
    {

        return $this->render('h5_login');
    }


    public function actionDoLogin($username = "",$password= ""){
        $model = new LoginForm();

        $model->username = $username;
        $model->password = $password;
        echo "1";

        $view = Yii::$app->getView();//此处的view实例与视图中的view（默认的$this变量）为同一个。所以此处保存的参数在视图中也可以用
        $view->params['testView'] = 'testView'; //因为是同一个布局变量，所以在视图中也可以使用

        if($model->validate()){

            $model->login();

            echo "登录成功!";
        }else{
            $error = $model->errors;
            $test = 1;

            return $this->render('h5_login');
        }

    }
}
