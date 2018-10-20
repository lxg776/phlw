<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/20 0020
 * Time: 下午 4:36
 */
namespace app\models;
use app\util\CommonUtil;
use Yii;
use yii\base\Model;

class SmsModle extends Model
{

    public function  getSms($phone_no,$operation,$appid,$sms_code){

        $sql = "insert into f_sms_message(phone_no,operation,appid,sms_code)values(:phone_no,:operation,:appid,:sms_code)";

        $query  = \Yii::$app->getDb()->createCommand($sql,[':phone_no'=>$phone_no,':operation'=>$operation,':appid'=>$appid,':sms_code'=>$sms_code ])->execute();

    }


}