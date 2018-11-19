<?php

namespace app\controllers;


use app\models\FuserBaseMsg;
use app\models\FuserLivingSatus;
use app\models\FuserRequest;
use app\models\FuserSetting;
use app\util\CommonUtil;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\UserServiceModle;
use app\models\SmsModle;



class WebController extends Controller
{



    public   $pageSize = 15;

    public   $imageBase =  "http://jxwbb.oss-cn-zhangjiakou.aliyuncs.com/";






    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index','login','do-login','do-edit-photo','do-edit-zobz','do-edit-grzl','do-edit-xqhh','do-edit-shzk'],
                'rules' => [
                    [
                        'actions' => ['logout','index','do-edit-photo','do-edit-zobz','do-edit-grzl','do-edit-xqhh','do-edit-shzk'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login','do-login','get-sms','check-username'],
                        'allow' => true,
                        'roles' => ['?',"@"],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
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

        if(Yii::$app->user->isGuest){
            return $this->render('h5_login');
        }else{
            $this->redirect(array('/web/index', 'pageNum' => 1));
        }

    }


    public function ip() {
        //strcasecmp 比较两个字符，不区分大小写。返回0，>0，<0。
        if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $ip = getenv('REMOTE_ADDR');
        } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $res =  preg_match ( '/[\d\.]{7,15}/', $ip, $matches ) ? $matches [0] : '';
        return $res;

    }



    public function actionDoReg()
    {




        $serviceModle = new UserServiceModle();

        if (Yii::$app->request->isPost == 1) {

            $password = Yii::$app->request->post("password", "");

            //插入UcenterUser
            $mPassword = md5("friend" . $password);

            $userName = Yii::$app->request->post("userName", "");

            $sex = Yii::$app->request->post("sex", "");


            $idCardImgs  = Yii::$app->request->post("idCardImgs", "");

            $idCard = Yii::$app->request->post("idCard", "");

            $realName = Yii::$app->request->post("realName", "");

            $birthDay = Yii::$app->request->post("birthDay", "");


            $fProvinceId = Yii::$app->request->post("fProvinceId", "");
            $fAreasId = Yii::$app->request->post("fAreasId", "");
            $fromCityId = Yii::$app->request->post("fromCityId", "");





            $remoteAddr = $this->ip();




            if (Yii::$app->user->isGuest) {
                //添加
                $serviceModle->saveUcenterUser($userName, $mPassword, $sex, $remoteAddr, 'insert', -1);

                //进行登录操作

                $loginForm = new LoginForm();
                $loginForm->username = $userName;
                $loginForm->password = $password;
                $loginForm->login();

                $nickName = CommonUtil::str_rand(6);
                $serviceModle->saveIdcard($userName,$realName,$idCard,$idCardImgs,'insert',Yii::$app->user->id);
                $serviceModle->saveBaseUserMsg($fProvinceId,$fromCityId,$fAreasId,$birthDay,Yii::$app->user->id,'insert');
                $userSetting = new FuserSetting();
                $userSetting->user_id = Yii::$app->user->id;
                $userSetting->show_index_page = 0;
                $userSetting->show_base_msg = 0;
                $userSetting->show_favorite = 0;
                $userSetting->show_friend_request = 0;
                $userSetting->show_living_status = 0;
                $userSetting->msg_read_status = 0;
                $userSetting->msg_send_status = 0;
                $userSetting->historyview_status = 1;
                $userSetting->idcard_status = 1;
                $userSetting->save();


                //生活状态
                $fuserLivingSatus = new  FuserLivingSatus();
                $fuserLivingSatus->user_id = Yii::$app->user->id;;
                $fuserLivingSatus->save();


                //择偶标准
                $fuserRequest = new  FuserRequest();
                $fuserRequest->user_id = Yii::$app->user->id;
                $fuserRequest->save();

            } else {

                $userId = Yii::$app->user->id;
                $serviceModle->saveUcenterUser($userName, $mPassword, $sex, $remoteAddr, 'update', $userId);
                $serviceModle->saveIdcard($userName,$realName,$idCard,$idCardImgs,'update',Yii::$app->user->id);
                $serviceModle->saveBaseUserMsg($fProvinceId,$fromCityId,$fAreasId,$birthDay,$userId,'update');

            }


            $this->redirect(array('/web/edit-grzl','from'=>'2'));




        }


    }

    /**
     * 活动详情
     * @param int $activityId
     * @return string
     */
    public function actionActivityDetail($activityId=0){



        $serviceModle = new UserServiceModle();
        $modle = $serviceModle->selectActivityDetail($activityId);
        $data =  ['modle'=>$modle, 'imageBase'=>$this->imageBase];


        return  $this->render("activity_detail",$data);

    }


    /**
     * 编辑个人信息
     */
    public function actionEditGrzl($from="1"){


        $serviceModle = new UserServiceModle();

        $user = \Yii::$app->user->identity;

        $modle = $serviceModle->getGrzlByUserId($user->id);


        //个人相册
        $userImages = $serviceModle->selectUserImageListById($user->id,'photo');

        $data =  ['modle'=>$modle,'user'=>$user,'userImages'=>$userImages,'imageBase'=>$this->imageBase,'from'=>$from];


        return  $this->render("edit_grzl",$data);


    }



    public function  actionEditPhoto(){


            $serviceModle = new UserServiceModle();
            $user = \Yii::$app->user->identity;
            $modle = $serviceModle->getGrzlByUserId($user->id);
            //个人相册
            $userImages = $serviceModle->selectUserImageListById($user->id,'photo');
            $data =  ['modle'=>$modle,'user'=>$user,'userImages'=>$userImages,'imageBase'=>$this->imageBase];

            return  $this->render("edit_photo",$data);
	}



	public function actionDoEditPhoto(){



        $user = \Yii::$app->user->identity;

        $serviceModle = new UserServiceModle();

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

         if (Yii::$app->request->isPost == 1) {


             $imgPath = Yii::$app->request->post("imgPath", "");

             $keyWord = Yii::$app->request->post("keyWord", "");

             if($keyWord == 'add'){
                 $serviceModle->addPhoto($user->id,$imgPath,'photo');
             }else{
                 $serviceModle->deletePhoto($user->id,$imgPath,'photo');
             }


             return [
                 'message' =>"操作成功!",
                 'code' => 1,
                 'data'=>"",
             ];
         }


    }






    /**
     * 编辑择偶要求
     */
    public function actionEditZobz($from="1"){


        $serviceModle = new UserServiceModle();


        $user = \Yii::$app->user->identity;

        $modle = $serviceModle->getZobzByUserId($user->id);

        if(!$modle){
            $modle = new FuserRequest();
            $modle->user_id = $user->id;
            $modle->save();
            $modle = $serviceModle->getZobzByUserId($user->id);
        }



        if($modle){
            $height = $modle['height'];
            $height_min = "";
            $height_max = "";

            if($height){
                $heightArray = explode('~',$height);
                if(sizeof($heightArray)==2){
                        $height_min = $heightArray[0];
                        $height_max = $heightArray[1];

                }else if(sizeof($heightArray)==1){
                    if(strpos($heightArray[0],"以上")!=false){
                        $height_min = substr($heightArray[0],0,strrpos($heightArray[0],"以上"));
                    }else if(strpos($heightArray[0],"以下")!=false){
                        $height_max = substr($heightArray[0],0,strrpos($heightArray[0],"以下"));
                    }
                }
            }

            $age = $modle['age'];
            $age_min = '';
            $age_max = '';

            if($age){
                $ageArray = explode('~',$age);


                if(sizeof($ageArray)==2){
                    $age_min = $ageArray[0];
                    $age_max = $ageArray[1];
                }else if(sizeof($ageArray)==1){
                    if(strpos($ageArray[0],"以上")!=false){
                        $age_min = substr($ageArray[0],0,strrpos($ageArray[0],"以上"));
                        $age_max = "不限";
                    }else if(strpos($heightArray[0],"以下")!=false){
                        $age_max = substr($ageArray[0],0,strrpos($ageArray[0],"以下"));
                        $age_min = "不限";
                    }
                }


            }
            $data =  ['modle'=>$modle,'from'=>$from,'height_min'=>$height_min,'height_max'=>$height_max,'age_min'=>$age_min,'age_max'=>$age_max];
            return $this->render("edit_zobz",$data);
        }


    }



    /**
     *  提交择偶要求
     */
    public function actionDoEditZobz(){

        $user = \Yii::$app->user->identity;
        $userId = $user->id;

        if (Yii::$app->request->isPost == 1) {

           $modle = FuserRequest::findOne($userId);

           if(!$modle){
               $operation = 'insert';
               $modle->user_id = $userId;
           }else{
               $operation = 'update';
           }

           $sex = Yii::$app->request->post("sex", "");

           $fromProvinceId = Yii::$app->request->post("fromProvinceId", "");

           $fromCityId = Yii::$app->request->post("fromCityId", "");

           $fromAreaId = Yii::$app->request->post("fromAreaId", "");

           $age_min = Yii::$app->request->post("age_min", "");

           $age_max = Yii::$app->request->post("age_max", "");

           $height_min = Yii::$app->request->post("height_min", "");

           $height_max = Yii::$app->request->post("height_max", "");

           $maritalStatus  = Yii::$app->request->post("maritalStatus", "");

           $shape  = Yii::$app->request->post("shape", "");

           $education  = Yii::$app->request->post("education", "");

           $incomeMonthly  = Yii::$app->request->post("incomeMonthly", "");


           $job  = Yii::$app->request->post("job", "");

           $childStatus  = Yii::$app->request->post("childStatus", "");

           $livingStatus  = Yii::$app->request->post("livingStatus", "");

           $houseStatus  = Yii::$app->request->post("houseStatus", "");

           $carStatus  = Yii::$app->request->post("carStatus", "");

           $drinkStatus  = Yii::$app->request->post("drinkStatus", "");

           $smokeStatus  = Yii::$app->request->post("smokeStatus", "");

           $from = Yii::$app->request->post("from", "");




            //位置
            $sql1 = "select province from f_provinces where provinceid = :provinceid";

            $q1  = \Yii::$app->getDb()->createCommand($sql1,[':provinceid'=>$fromProvinceId])->queryOne();

            $province = $q1['province'];


            $sql2 = "select city from f_cities  where cityid = :cityid";

            $q2  = \Yii::$app->getDb()->createCommand($sql2,[':cityid'=>$fromCityId])->queryOne();

            $city = $q2['city'];


            $sql3 = "select area from f_areas where areaid = :areaid";

            $q3  = \Yii::$app->getDb()->createCommand($sql3,[':areaid'=>$fromAreaId])->queryOne();

            $area = $q3['area'];

            //省份
            $modle->from_province = $province;
            $modle->from_province_id = $fromProvinceId;
            //城市
            $modle->from_city = $city;
            $modle->from_city_id = $fromCityId;

            //区县
            $modle->from_area = $fromAreaId;
            $modle->from_area_id = $area;

            //性别
            $modle->sex= $sex;

            $modle->age = CommonUtil::getAgeRang($age_min,$age_max);
            $modle->height = CommonUtil::getHeiRang($height_min,$height_max);

            $modle->marital_status =$maritalStatus;

            $modle->shape = $shape;

            $modle->education = $education;

            $modle->income_monthly = $incomeMonthly;

            $modle->job = $job;

            $modle->child_status = $childStatus;

            $modle->living_status = $livingStatus;

            $modle->house_status = $houseStatus;

            $modle->car_status = $carStatus;

            $modle->drink_status = $drinkStatus;

            $modle->smoke_status = $smokeStatus;

            if($operation == 'insert'){
                $modle->save();
            }else{
                $modle->update();
            }


            if($from == 1){
                //跳转首页
                $this->redirect(array('/web/index','#'=>'page4'));
            }else{
                //跳转编辑整合需求
                $this->redirect(array('/web/edit-shzk','from'=>$from));

            }

        }




    }

    /**
     * 编辑个人信息
     */
    public function actionEditShzk($from="1"){






        $user = \Yii::$app->user->identity;
        $userId = $user->id;

        $serviceModle  =  new UserServiceModle();

        $modle = $serviceModle->getShztByUserId($userId);


        if(!$modle){
            $modle = new FuserLivingSatus();
            $modle->user_id = $user->id;
            $modle->save();
            $modle = $serviceModle->getShztByUserId($userId);
        }

       // getShztByUserId

        $data = ['modle'=>$modle,'from'=>$from];

        return $this->render('edit_shzk',$data);
    }


    /**
     * 编辑兴趣爱好
     */
    public function actionEditXqhh($from="1"){


        $user = \Yii::$app->user->identity;
        $userId = $user->id;
        $serviceModle  =  new UserServiceModle();
        $modle = $serviceModle->getShztByUserId($userId);
        // getShztByUserId
        $data = ['modle'=>$modle,'from'=>$from];
        return $this->render('edit_xqhh',$data);
    }


    /**
     * 编辑兴趣爱好
     */
    public function actionDoEditXqhh($from="1"){



        $user = \Yii::$app->user->identity;
        $userId = $user->getId();




        if (Yii::$app->request->isPost == 1) {

            $modle = FuserLivingSatus::findOne($userId);
            if ($modle) {
                $operation = "update";
            } else {
                $operation = "insert";
                $modle = new FuserLivingSatus();
                $modle->user_id = $userId;
            }


            $from = Yii::$app->request->post("from", "");

            $favoriteMusic = Yii::$app->request->post("favoriteMusic", "");


            $favoriteFilm = Yii::$app->request->post("favoriteFilm", "");

            $favoriteSports = Yii::$app->request->post("favoriteSports", "");

            $favoritePet = Yii::$app->request->post("favoritePet", "");


            $modle->favorite_music = $favoriteMusic;

            $modle->favorite_film = $favoriteFilm;

            $modle->favorite_sports = $favoriteSports;

            $modle->favorite_pet = $favoritePet;


            if ($operation == 'update') {
                $modle->update();
            } elsE {
                $modle->save();
            }


            //跳转首页

            $this->redirect(array('/web/index','#'=>'page4'));

        }


    }




    /**
     * 修改生活状态
     * @return
     */
    public function actionDoEditShzk(){


        $user = \Yii::$app->user->identity;
        $userId = $user->getId();




        if (Yii::$app->request->isPost == 1) {

            $modle = FuserLivingSatus::findOne($userId);
            if($modle){
                $operation = "update";
            }else{
                $operation = "insert";
                $modle = new FuserLivingSatus();
                $modle->user_id = $userId;


            }





            $from = Yii::$app->request->post("from", "");

            $smokingStatus = Yii::$app->request->post("smokingStatus", "");


            $drinkingStatus = Yii::$app->request->post("drinkingStatus", "");

            $cooking = Yii::$app->request->post("cooking", "");

            $liveWithParents = Yii::$app->request->post("liveWithParents", "");

            $favoriteDates = Yii::$app->request->post("favoriteDate", "");

            $from  = Yii::$app->request->post("from", "");

            $modle->smoking_status = $smokingStatus;

            $modle->drinking_status = $drinkingStatus;

            $modle->cooking = $cooking;

            $modle->live_with_parents = $liveWithParents;

            $modle->favorite_date = $favoriteDates;

            if($operation == 'update'){
                $modle->update();
            }elsE{
                $modle->save();
            }


            if($from == 1){
                //跳转首页
                $this->redirect(array('/web/index','#'=>'page4'));


            }else{
                //跳转编辑整合需求
                $this->redirect(array('/web/edit-xqhh','from'=>$from));

            }



        }





    }







    /**
     * 编辑个人信息
     */
    public function actionDoEditGrzl(){




        $user = \Yii::$app->user->identity;
        $userId = $user->id;

        $serviceModle  =  new UserServiceModle();




        if (Yii::$app->request->isPost == 1) {

            $deletePhoto = Yii::$app->request->post("deletePhoto", "");
            $pathes = explode(',',$deletePhoto);

            //删除相册
            if($pathes&&$deletePhoto != ""){
                $length = sizeof($pathes);
                for ($i=0; $i<$length; $i++) {
                        $itemString = $pathes[$i];
                        $serviceModle->deletePhoto($userId,$itemString,"photo");
                }
            }

            $addPhoto = Yii::$app->request->post("addPhoto", "");
            //添加相册
            $addPathes = explode(',',$addPhoto);
            if($addPathes&&$addPhoto != ""){
                $addLength = sizeof($addPathes);
                for ($ai=0; $ai<$addLength; $ai++) {
                    $addItemString = $addPathes[$ai];
                    $serviceModle->addPhoto($userId,$addItemString,"photo");
                }
            }
            $nikename = Yii::$app->request->post("nikename", "");
            //头像
            $avatar = Yii::$app->request->post("avatar", "");
            //身高
            $height = Yii::$app->request->post("height", "");
            //体型
            $shape =  Yii::$app->request->post("shape", "");
            //婚姻状态
            $maritalStatus =  Yii::$app->request->post("maritalStatus", "");
            //职业
            $profession =  Yii::$app->request->post("profession", "");
            //单位性质
            $unitProperty =  Yii::$app->request->post("unitProperty", "");
            //教育
            $education = Yii::$app->request->post("education", "");
            //月收入
            $monthIncome =  Yii::$app->request->post("monthIncome", "");

            $childrenStatus =  Yii::$app->request->post("childrenStatus", "");

            $from =  Yii::$app->request->post("from", "");


            //基本资料
            $fuserBaseMsg =FuserBaseMsg::findOne($userId);
            $fuserBaseMsg->nikename = $nikename;
            $fuserBaseMsg->height = $height;
            if($avatar!=""){
                $fuserBaseMsg->avatar = $avatar;
            }
            $fuserBaseMsg->shape = $shape;
            $fuserBaseMsg->marital_status = $maritalStatus;
            $fuserBaseMsg->profession = $profession;
            $fuserBaseMsg->unit_property = $unitProperty;
            $fuserBaseMsg->education = $education;
            $fuserBaseMsg->month_income = $monthIncome;
            $fuserBaseMsg->children_status = $childrenStatus;

            $fuserBaseMsg->update();


            if($from == 1){
                //跳转首页
                $this->redirect(array('/web/index','#'=>'page4'));
            }else{
                //跳转编辑整合需求
                $this->redirect(array('/web/edit-zobz','from'=>$from));

            }



        }

    }

















    /**
     * 用户详情
     * @param $uid
     */
    public function  actionUserDetail($uid){

        $serviceModle = new UserServiceModle();

        //系统推荐人
        $user = \Yii::$app->user->identity;

        //个人资料
        $bean = $serviceModle->selectFUserDetailVoByUserId($uid);
        //个人相册
        $userImages = $serviceModle->selectUserImageListById($uid,'photo');
        //访问记录加1
        $serviceModle->addViewRecord($user->id,$uid);
        //问候语

        //获取用户设置
        $userSetting = $serviceModle->selectUserSettingById($uid);

        //问候语
        $greetingTempList = $serviceModle->selectGreetingTemp(1);



        $data =  ['modle'=>$bean,'imageBase'=>$this->imageBase,'userImages'=>$userImages,'greetingTempList'=>$greetingTempList,'userSetting'=>$userSetting];

        return $this->render('userDetail',$data);
    }








    /**
     * 加密的
     * @param $mAppid
     * @param $mAppkey
     * @param $mobile
     * @param $code
    */
    public function getMd5Key($mAppid,$mAppkey,$mobile,$code){
           return md5($mAppid.$mAppkey.$mobile.$code);
    }


    /**
     * 获取验证码
     * @return
     */
	public function actionGetSms(){

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;


        if(Yii::$app->request->isPost==1){

            $phone_no=Yii::$app->request->post("phoneNo", "");
            $serviceModle =new SmsModle();
            $code = CommonUtil::randomCheckCode(4);
            $serviceModle->getSms($phone_no,"register","friends",$code);

            $appkey="lxg776";
            $appid="5";
            $sig="jxnet";

            $key = $this->getMd5Key($appid,$appkey,$phone_no,$code);

            $data = "item=app&a=setsmscode&sig=".$sig."&appid=".$appid."&key=".$key."&type=mobile&mobile=".$phone_no."&code=".$code;
            $url = "http://user.xiweb.cn/run.php?".$data;




            //调用发送
            $result = json_decode(CommonUtil::CallAPI("GET",$url,false));
            //$resultCode =200;
            $resultCode = $result->code;

             if($resultCode == 200){

                 return [
                     'message' =>"发送成功!",
                     'code' => 1,
                     'data'=>"",
                 ];

             }else{

                 return [
                     'message' =>"发送失败!",
                     'code' => 0,
                     'data'=>"",
                 ];

             }




        }else{
            return [
                'message' =>"请post提交!",
                'code' => 0,
                'data'=>"",
            ];
        }

    }


    public function actionCheckUsername(){

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $serviceModle = new UserServiceModle();





        if(Yii::$app->request->isPost==1) {


            $idCard = Yii::$app->request->post("idCard", "");
            $userName = Yii::$app->request->post("userName", "");
            $code = Yii::$app->request->post("code", "");


            $userId = $serviceModle->getUserIdByPhone($userName);

            if (Yii::$app->user->isGuest) {
                if($userId){
                    return [
                        'message' => "手机号码已经被注册过了!",
                        'code' => 0,
                        'data' => "",
                    ];
                }



            }else{
                if($userId&&$userId!=Yii::$app->user->id){
                    return [
                        'message' => "手机号码已经被注册过了!",
                        'code' => 0,
                        'data' => "",
                    ];
                }
            }

            $userId =  $serviceModle->getUserIdByIdcardNo($idCard);

            if (Yii::$app->user->isGuest) {
                if($userId){
                    return [
                        'message' => "身份证已经被注册过了!",
                        'code' => 0,
                        'data' => "",
                    ];
                }
            }else{
                if($userId&&$userId!=Yii::$app->user->id){
                    return [
                        'message' => "身份证已经被注册过了!",
                        'code' => 0,
                        'data' => "",
                    ];
                }
            }


            $query = $serviceModle->getSmsCode($userName, "register");

            if (!$code || $code != $query['sms_code']) {

                return [
                    'message' => "短信验证码不正确!",
                    'code' => 0,
                    'data' => "",
                ];

            }


            date_default_timezone_set('PRC');
       $enddate = date('Y-m-d H:i:s');

       $startdate = $query['create_time'];

       $second = strtotime($enddate) - strtotime($startdate);

       if ($second > 600) {

           return [
               'message' => "短信验证码超过有效期，请重新获取！",
               'code' => 0,
               'data' => "",
           ];

       }

        return [
            'message' =>"验证通过!",
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






    public function actionSendGreeting(){


        $serviceModle = new UserServiceModle();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;


        $greetingId=Yii::$app->request->post("greetingId", "");
        $friendId=Yii::$app->request->post("friendId", "");


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


    public function actionHelpContact(){

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $serviceModle = new UserServiceModle();
        if(Yii::$app->request->isPost==1){
            //系统推荐人
            $user = \Yii::$app->user->identity;
            $t_user_id = (int) Yii::$app->request->post("tUserId", 0);
            //内容
            $serviceModle->helpContact($user->id,$t_user_id);
            return [
                'message' =>"已经委托红娘帮您联系！",
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


    public function  actionAgreement(){


	    return $this->render("agreement");
    }









    public function  actionIndex($pageNum="1")
    {

        $modle = new UserServiceModle();

        //系统推荐人
        $user = \Yii::$app->user->identity;
        $offset = ($pageNum-1)*$this->pageSize;
        $recommendUser = $modle->selectRecommendUsers($user,$offset,$this->pageSize);

        //获取用户设置
        $userSetting = $modle->selectUserSettingById($user->id);
        $unReadCount = $modle->selectunReadCountByUserId($user->id,0);

        //活动列表

        $fActivityList = $modle->selectActivityList($pageNum,$this->pageSize);

        //个人资料
        $bean = $modle->selectFUserDetailVoByUserId($user->id);

        //个人相册
        $userImages = $modle->selectUserImageListById($user->id,'photo');


        //最近信息列表
        $msgList = $modle->selectRecentMsgByUser($user->id);
        $viewRecordList = $modle->selectViewRecordUsers($user->id);

        //问候语
        $greetingTempList = $modle->selectGreetingTemp(1);



        $data =  ['recommendUser'=>$recommendUser,'userSetting'=>$userSetting,'imageBase'=>$this->imageBase,'unReadCount'=>$unReadCount,'fActivityList'=>$fActivityList,"modle"=>$bean,
            'userImages'=>$userImages,'msgList'=>$msgList,'viewRecordList'=>$viewRecordList,'greetingTempList'=>$greetingTempList];

        return $this->render('index',$data);
    }


    /**
     * 获取推荐列表
     * @param $pageNum
     * @return array
     * @throws \yii\db\Exception
     */
    public function actionLoadRecommentUserList($pageNum){

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $serviceModle = new UserServiceModle();

        $user = \Yii::$app->user->identity;

        //推荐列表

        $offset = ($pageNum-1)*$this->pageSize;
        $recommendUser = $serviceModle->selectRecommendUsers($user,$offset,$this->pageSize);

        $data =  ['dataList'=>$recommendUser,'pageNum'=>$pageNum,'imageBase'=>$this->imageBase];

        return [
             'message' => '获取成功!',
             'code' => 1,
             'data'=>$data,
         ];

    }


    public function actionLoadActivityList($pageNum){



        //活动列表
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $serviceModle = new UserServiceModle();

        $fActivityList = $serviceModle->selectActivityList($pageNum,$this->pageSize);

        $data =  ['dataList'=>$fActivityList,'pageNum'=>$pageNum];

        return [
            'message' => '获取成功!',
            'code' => 1,
            'data'=>$data,
        ];

    }




    public function actionLogout(){
        Yii::$app->user->logout();

        return $this->render('h5_login');
    }







    public function actionDoLogin(){


        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if(Yii::$app->request->isPost==1){

           $username =  Yii::$app->request->post("username", "");
           $password =  Yii::$app->request->post("password", "");

            $model = new LoginForm();
            $model->username = $username;
            $model->password = $password;

            if($model->validate()){
                $model->login();

                $indexUrl = \Yii::$app->request->baseUrl."/index.php?r=web/index";

                return [
                    'message' => '登录成功',
                    'code' => 1,
                    'data'=>$indexUrl,
                ];


            }else{
                $error ="";
                if(sizeof($model->errors)>1){
                    $error = $model->errors['username'][0];
                }else if(sizeof($model->errors)==1){
                    $error = $model->errors['password'][0];
                }

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

    //注册

    public function actionReg(){

        return $this->render('reg');

    }


    public function actionMsgList($fromUserId){



         //系统推荐人
        $user = \Yii::$app->user->identity;
        $userId = $user->id;
        $baseMsg = FuserBaseMsg::findOne($userId);

        $serviceModle = new UserServiceModle();

        $serviceModle->updateMsgState($fromUserId,$userId,1);

        $currentDate = date('Y年m月d日');

        $msgList = $serviceModle->selectMsgRecord($userId,$fromUserId);

        $returnArray = array();

        if($msgList){
            $tempMsgList =array();
            $size = sizeof($msgList);

            for($i=0;$i<$size;$i++){
                array_push($tempMsgList,$msgList[$size-$i-1]);
            }
            $tempDate ='';



            foreach ($tempMsgList as $item){

                $itemDate = date('Y年m月d日',strtotime($item['create_time']));

                if($item['to_user_id']!=$userId){
                    $item['show_fla'] = 1;
                }else{
                    $item['show_fla'] = 0;
                }

                $item['show_date'] = '';

                if($itemDate!=$tempDate){
                    $item['show_date'] = $itemDate;
                    $tempDate = $itemDate;
                }

                array_push($returnArray,$item);

            }

        }

        $toUser = $serviceModle->selectFUserDetailVoByUserId($fromUserId);

        $data =  ['msgList'=>$returnArray,'toUser'=>$toUser,'imageBase'=>$this->imageBase,'fromUser'=>$baseMsg,'currentDate'=>$currentDate];

        return $this->render('msg_list',$data);

    }

    /**
     * 给其他人发送信息
     * @return
     */
    public function actionSendMsg(){



        //系统推荐人
        $user = \Yii::$app->user->identity;
        $userId = $user->id;
        $state = 0 ;

        $serviceModle = new UserServiceModle();

        if(Yii::$app->request->isPost==1) {

            $toUserId = Yii::$app->request->post("toUserId", "");
            $msgContent = Yii::$app->request->post("msgContent", "");
            $serviceModle->sendMessage($userId,$toUserId,$msgContent,$state);

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'message' => '发送成功!',
                'code' => 1,
                'data'=>'',
            ];

        }




    }


}
