<?php

namespace app\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\UserServiceModle;



class MsgController extends Controller
{



    public   $pageSize = 15;

    public   $imageBase =  "http://jxwbb.oss-cn-zhangjiakou.aliyuncs.com/";



    public function  action()
    {

        return $this->render('index');

    }



    public function actionSendGreeting($greetingId,$friendId=0){


        $serviceModle = new UserServiceModle();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if(Yii::$app->request->isPost==1){

            //系统推荐人
            $user = \Yii::$app->user->identity;
            //内容
            $msgContent = $serviceModle->selectGreetingContent($greetingId);
            //存储内容
            $serviceModle->sendMessage($user->id,$friendId,$msgContent);

            return [
                'message' =>"发送成功!",
                'code' => 1,
                'data'=>"",
            ];
        }else{
            return [
                'message' =>"请post提交!",
                'code' => 0,
                'data'=>"",
            ];
        }

    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index','login','do-login'],
                'rules' => [
                    [
                        'actions' => ['sendGreeting'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
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


}
