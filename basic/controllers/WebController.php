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



        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if(Yii::$app->request->isPost==1){

           $username =  Yii::$app->request->post("username", "");
           $password =  Yii::$app->request->post("password", "");

            $model = new LoginForm();
            $model->username = $username;
            $model->password = $password;

            if($model->validate()){
                $model->login();
                $ss =1;
                return [
                    'message' => '登录成功',
                    'code' => 1,
                    'data'=>"",
                ];


            }else{

                $error = $model->errors['password'][0];


                return [
                    'message' =>$error,
                    'code' => 0,
                    'data'=>"",
                ];

            }
        }else{
            return [
                'message' =>"系统错误!",
                'code' => 0,
                'data'=>"",
            ];
        }






    }


}
