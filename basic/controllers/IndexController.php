<?php
/**
 * Created by PhpStorm.
 * User: sunshine
 * Date: 18/7/27
 * Time: 20:03
 */

namespace app\controllers;
use app\models\LoginForm;
use yii\filters\auth\QueryParamAuth;
use yii\web\Response;


class IndexController extends BaseController
{


    public $modelClass = 'app\models\User';


    public function behaviors()
    {



//        return ArrayHelper::merge(parent::behaviors(), [
//            'authenticator' => [
//                'class' => QueryParamAuth::className(),
//            ],
//
//        ]);


        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_HTML;
        $behaviors['authenticator'] = [
            //'class' => HttpBasicAuth::className(),
            'class' => QueryParamAuth::className(),
        ];

        return $behaviors;
    }

    public function  actionLogin($username = "",$password= ""){
        $model = new LoginForm();

        $model->username = $username;
        $model->password = $password;





        if($model->validate()){

            $model->login();

            echo "登录成功!";
        }else{
            $error = $model->errors;
            $test = 1;
            echo "wtf!";
        }





//        if ($model->load(\Yii::$app->request->get())&&$model.validate()) {
//            $response = \Yii::$app->response;
//            $result = $this->getResult();
//
//            $result->message = $model->errors;
//            $result->code=0;
//            $dataString = json_encode($result);
//            $response->data = $dataString;
//
////            if ($user = $model->signup()) {
////                // $login = new SiteLoginForm();
////                if (Yii::$app->getUser()->login($user)) {
////                    return $this->goHome();
////                } else {
////                    var_dump($user);
////                }
////            }
//
//        }


    }




    public function actionUserList(){






        $response = \Yii::$app->response;

        $query = UcenterUser::find()->where(['user_id' => '6'])->all();
        $newData =  UcenterUser::simplifyData($query);


        $result = $this->getResult();

        $result->data = $newData;

        $result->message="请求成功";

        $dataString = json_encode($result);
        $response->data = $dataString;

       // return $this->render('ul');
    }


    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()


    {
        return $this->render('ul');


    }



    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionTest()
    {

        $response = \Yii::$app->response;

        $person = new Person();
        $person->age ="00";
        $person->name="lxg776";

        $wife = new Person();
        $wife->name="998";

        $person->wife = $wife;

        $personString = json_encode($person);

        $response->data = $personString;


    }
}