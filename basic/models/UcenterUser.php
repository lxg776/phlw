<?php
/**
 * Created by PhpStorm.
 * User: sunshine
 * Date: 18/7/27
 * Time: 20:05
 */

namespace app\models;





class UcenterUser extends BaseBean
{



    public static function simplifyData($data){
        foreach($data as $key=>$val){
            $newData[$key] = $val->attributes;
        }
        return $newData;
    }


}