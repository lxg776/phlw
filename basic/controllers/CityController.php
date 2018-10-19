<?php

namespace app\controllers;


use yii\web\Controller;
use app\models\CityServiceModle;

class CityController extends Controller
{


    /**
     * 获取省份列表
     * @param $cityid
     * @return array
     * @throws \yii\db\Exception
     */
    public function actionProvinceList(){

        $serviceModle = new CityServiceModle();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $dataList = $serviceModle->selectProvinceList();
        return [
                'message' =>"获取成功!",
                'code' => 1,
                'dataList'=>$dataList,
        ];

    }

    /**
     * 获取城市列表
     * @param $cityid
     * @return array
     * @throws \yii\db\Exception
     */
    public function actionCityList($provinceid){

        $serviceModle = new CityServiceModle();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $dataList = $serviceModle->selectCityList($provinceid);

        return [
            'message' =>"获取成功!",
            'code' => 1,
            'dataList'=>$dataList,
        ];

    }

    /**
     * 获取区域列表
     * @param $cityid
     * @return array
     * @throws \yii\db\Exception
     */
    public function actionAreasList($cityid){

        $serviceModle = new CityServiceModle();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $dataList = $serviceModle->selectAreasList($cityid);

        return [
            'message' =>"获取成功!",
            'code' => 1,
            'dataList'=>$dataList,
        ];


    }


}
