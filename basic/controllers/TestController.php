<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/23 0023
 * Time: 上午 10:47
 */

namespace app\controllers;


use yii\web\Controller;
use yii\data\Pagination;
use app\models\UcenterUser;


class TestController  extends Controller
{

    /**
     * Displays about page.
     *
     * @return string
     */
    public function testDb()
    {
        $query = UcenterUser::findBySql();
        return $this->render('about');
    }
}