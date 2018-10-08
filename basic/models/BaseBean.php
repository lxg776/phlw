<?php
/**
 * Created by PhpStorm.
 * User: sunshine
 * Date: 18/7/27
 * Time: 20:05
 */

namespace app\models;
use yii\db\ActiveRecord;




class BaseBean extends ActiveRecord
{
    public  function  testList(){


    }


    public  static  function  result2Array($result){
        $arr = array();
        $index = 0;
        foreach($result as $t)
        {
            $arr[$index] = $t->attributes;
            $index++;
        }

        return $arr;

    }



}