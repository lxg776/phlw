<?php
/**
 * Created by PhpStorm.
 * User: sunshine
 * Date: 18/9/6
 * Time: 20:17
 */

namespace app\models;
use app\util\CommonUtil;
use Yii;
use yii\base\Model;

class CityServiceModle extends Model
{


    /**
     * 获取省份列表
     * @return array
     * @throws \yii\db\Exception
     */
    public  function  selectProvinceList(){
        $sql = "select id,provinceid,province from f_provinces";
        $query  = \Yii::$app->getDb()->createCommand($sql)->queryAll();
        return $query;
    }

    /**
     * 获取城市列表
     * @return array
     * @throws \yii\db\Exception
     */
    public  function  selectCityList($provinceid){
        $sql = "select id,cityid,city,provinceid from f_cities where provinceid = :provinceid";
        $query  = \Yii::$app->getDb()->createCommand($sql,[':provinceid'=>$provinceid])->queryAll();
        return $query;
    }

    /**
     * 获取城市列表
     * @return array
     * @throws \yii\db\Exception
     */
    public  function  selectAreasList($cityid){
        $sql = "select id,areaid,area,cityid from f_areas where cityid= :cityid";
        $query  = \Yii::$app->getDb()->createCommand($sql,[':cityid'=>$cityid])->queryAll();
        return $query;
    }



}