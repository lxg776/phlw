<?php

namespace app\controllers;

use app\models\ResultBean;
use Yii;

use yii\rest\ActiveController;

use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class BaseController extends ActiveController
{


    /**
     * 简化findall数据
     * */
    public function simplifyData($data){
        foreach($data as $key=>$val){
            $newData[$key] = $val->attributes;
        }
        return $newData;
    }


    public function  getResult(){
        $result = new ResultBean();
        $result->code = 1;
        $result->message = "获取数据成功";

        return $result;
    }

}
