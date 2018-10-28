<?php

namespace app\controllers;


use app\models\FuserBaseMsg;
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
                'only' => ['logout','index','login','do-login'],
                'rules' => [
                    [
                        'actions' => ['logout','index'],
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


        return $this->render('h5_login');
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

            } else {

                $userId = Yii::$app->user->id;
                $serviceModle->saveUcenterUser($userName, $mPassword, $sex, $remoteAddr, 'update', $userId);
                $serviceModle->saveIdcard($userName,$realName,$idCard,$idCardImgs,'update',Yii::$app->user->id);


                $serviceModle->saveBaseUserMsg($fProvinceId,$fromCityId,$fAreasId,$birthDay,$userId,'update');

            }


            $this->render("edit_grzl");

        }


    }










//        UcenterUser ucenterUser =null;
//
//		if(null!=SecurityUtils.getSubject().getPrincipal()){
//            String  username = (String)SecurityUtils.getSubject().getPrincipal();
//			ucenterUser= getUctenuser(username,session);
//		}
//
//
//
//
//
//		String remoteAddr="";
//
//		if (request != null) {
//            remoteAddr = request.getHeader("X-FORWARDED-FOR");
//            if (remoteAddr == null || "".equals(remoteAddr)) {
//                remoteAddr = request.getRemoteAddr();
//            }
//        }
//
//		UcenterUser modle =new UcenterUser();
//		modle.setSalt("friend");
//
//		String md5Password =  MD5Util.MD5(modle.getSalt()+password);
//		modle.setPassword(md5Password);
//		modle.setUserName(userName);
//		modle.setCreateIp(remoteAddr);
//		modle.setSex(sex);
//
//		if(null!=ucenterUser){
//            ucenterUser=ucenterUserService.selectByPrimaryKey(ucenterUser.getUserId());
//            if(null!=ucenterUser){
//                modle.setUserId(ucenterUser.getUserId());
//                ucenterUserService.updateByPrimaryKey(modle);
//            }else{
//                SecurityUtils.getSubject().logout();
//                ucenterUserService.insert(modle);
//            }
//
//        }else{
//            ucenterUserService.insert(modle);
//        }
//		UcenterUserExample example = new UcenterUserExample();
//		example.createCriteria().andUserNameEqualTo(userName);
//		modle=ucenterUserService.selectFirstByExample(example);
//
//
//
//		String upms_code="";
//		//登录
//		if(ucenterUser==null){
//            upms_code = login(userName);
//        }
//
//
//		UcenterIdentificaion ucenterIdentificaion = new UcenterIdentificaion();
//		ucenterIdentificaion.setUserId(modle.getUserId());
//		ucenterIdentificaion.setCellphone(userName);
//		ucenterIdentificaion.setIdcardImgs(idCardImgs);
//		ucenterIdentificaion.setIdcardNo(idCard);
//		ucenterIdentificaion.setRealName(realName);
//
//		if(null!=ucenterUser){
//            ucenterIdentificaionService.updateByPrimaryKey(ucenterIdentificaion);
//            return "redirect:/u/txGrzl";
//        }else{
//            ucenterIdentificaionService.insert(ucenterIdentificaion);
//            //随机一个昵称
//            FUserBaseMsg fUserBaseMsg = new FUserBaseMsg();
//			fUserBaseMsg.setNikename(SmsUtil.randomCheckCode(7));
//			fUserBaseMsg.setUserId(modle.getUserId());
//			fUserBaseMsg.setBirthDate(birthDay);
//
//			FCitiesExample fCitiesExample =new FCitiesExample();
//			fCitiesExample.createCriteria().andCityidEqualTo(fromCityId+"");
//			FCities cities = fCitiesService.selectFirstByExample(fCitiesExample);
//
//			if(cities!=null){
//                fUserBaseMsg.setFromCity(cities.getCity());
//                fUserBaseMsg.setFromCityId(Integer.parseInt(cities.getCityid()));
//            }
//
//
//			FAreasExample fAreasExample =new FAreasExample();
//			fAreasExample.createCriteria().andAreaidEqualTo(fAreasId+"");
//			FAreas fAreas = fAreasService.selectFirstByExample(fAreasExample);
//			if(fAreas!=null){
//                fUserBaseMsg.setFromArea(fAreas.getArea());
//                fUserBaseMsg.setFromAreaId(Integer.parseInt(fAreas.getAreaid()));
//            }
//
//			//设置显示选项
//			FUserSetting fUserSetting =new FUserSetting();
//			fUserSetting.setUserId(modle.getUserId());
//			fUserSetting.setShowIndexPage((byte)0);
//			fUserSetting.setShowBaseMsg((byte)0);
//			fUserSetting.setShowFavorite((byte)0);
//			fUserSetting.setShowFriendRequest((byte)0);
//			fUserSetting.setShowLivingStatus((byte)0);
//			fUserSetting.setMsgReadStatus((byte)0);
//			fUserSetting.setMsgSendStatus((byte)0);
//			fUserSetting.setHistoryviewStatus((byte)1);
//			fUserSetting.setIdcardStatus((byte)1);
//			fUserBaseMsgService.insert(fUserBaseMsg);
//			fUserSettingService.insert(fUserSetting);







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
        $serviceModle->addViewRecord($uid,$user->id);
        //问候语

        //获取用户设置
        $userSetting = $serviceModle->selectUserSettingById($user->id);

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
           // $result = json_decode(CommonUtil::CallAPI("GET",$url,false));

            $resultCode =200;
            //$resultCode = $result->code;

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

       if ($second > 120) {

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


    public function actionLogout()
    {
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

                $indexUrl = \Yii::$app->request->hostInfo."/hlw/basic/web/index.php?r=web/index";

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




}
