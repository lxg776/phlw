<?php
/**
 * Created by PhpStorm.
 * User: sunshine
 * Date: 18/7/27
 * Time: 20:05
 */

namespace app\models;




class FuserSetting extends BaseBean
{


    public static function tableName()
    {
        return 'f_user_setting';  //写你表名就是了{{%XXX}}是用表前辍，没有设置可以直接写表名比如 “info”
    }



}