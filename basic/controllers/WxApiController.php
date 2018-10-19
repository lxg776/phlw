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
use app\models\UserServiceModle;


class WxApiController extends BaseController
{


    public   $modelClass = 'app\models\User';

    public   $pageSize = 15;

    public   $imageBase =  "http://jxwbb.oss-cn-zhangjiakou.aliyuncs.com/";

    public function behaviors()
    {

        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_HTML;
        $behaviors['authenticator'] = [
            //'class' => HttpBasicAuth::className(),
            'class' => QueryParamAuth::className(),
        ];
        return $behaviors;
    }



   public  function  actionRecentMsgList(){

       $modle = new UserServiceModle();

       $user = \Yii::$app->user->identity;

       $msgList = $modle->selectRecentMsgByUser($user->id);
       $viewRecordList  = $modle->selectViewRecordUsers($user->id);

       $map  = ['msgList' => $msgList, 'viewRecordList' => $viewRecordList, 'imageBase' => $this->imageBase ];
       \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

       return [
           'message' => '获取成功',
           'code' => 1,
           'data'=>$map,
       ];


   }

   public function  actionDetailUser($uid){

       $modle = new UserServiceModle();

       $user = \Yii::$app->user->identity;


       //获取用户详情
       $userDetail = $modle->selectFUserDetailVoByUserId($uid);

       //获取用户设置
       $userSetting = $modle->selectUserSettingById($user->id);

       //获取相册
       $userImages = $modle->selectUserImageListById($uid,'photo');

       //访问+1
       $modle->execAddUserView($user->id,$uid);

       //获取问候语
       $greetingTempList = $modle->selectGreetingTemp('1');


       $map  = ['modle' => $userDetail, 'fUserSetting' => $userSetting, 'imageBase' => $this->imageBase , 'userImages'=>$userImages,'greetingTempList'=>$greetingTempList];


       \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

       return [
           'message' => '获取成功',
           'code' => 1,
           'data'=>$map,
       ];



   }


    public function actionActivityList($pageNum=1, $pageSize = 20){

        $modle = new UserServiceModle();

        $fActivityList = $modle->selectActivityList($pageNum,$pageSize);

        $map  = ['fActivityList' => $fActivityList,  'imageBase' => $this->imageBase ];

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [
        'message' => '获取成功',
        'code' => 1,
        'data'=>$map,
         ];


    }



    public function actionActivityDetail($activityId){


        $modle = new UserServiceModle();

        $fActivity = $modle->selectActivityDetail(intval($activityId));

        $map  = ['modle' => $fActivity,  'imageBase' => $this->imageBase ];

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [
            'message' => '获取成功',
            'code' => 1,
            'data'=>$map,
        ];


    }


   public function  actionMineDetail(){

       $modle = new UserServiceModle();

       $user = \Yii::$app->user->identity;

       //获取用户详情
       $userDetail = $modle->selectFUserDetailVoByUserId($user->id);

       //个人相册
       $userImages = $modle->selectUserImageListById($user->id,'photo');

       //查询会员的类型


       $map  = ['bean' => $userDetail, 'imageBase' => $this->imageBase , 'userImages'=>$userImages ];


       \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;


       return [
           'message' => '获取成功',
           'code' => 1,
           'data'=>$map,
       ];

   }


    public function  actionRecommendUsers($pageNum=1){

        $modle = new UserServiceModle();




        $user = \Yii::$app->user->identity;

        $offset = ($pageNum-1)*$this->pageSize;


        $query = $modle->selectRecommendUsers($user,$offset,$this->pageSize);

        $map = ['recommendUserList' => $query, 'pageSize' => $this->pageSize, 'imageBase' => $this->imageBase];

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;


        return [
            'message' => '获取成功',
            'code' => 1,
            'data'=>$map,
        ];



//        $result = $this->getResult();
//
//        $result->data = $map;
//
//        $dataString = json_encode($result);
//
//        $response = \Yii::$app->response;
//        $response->format = \yii\web\Response::FORMAT_JSON;
//        $response->data = $dataString;


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