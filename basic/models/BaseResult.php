<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/30 0030
 * Time: 上午 11:35
 */


namespace app\models;

class BaseResult
{


    // 状态码：1成功，其他为失败
    public  $code;

    // 成功为success，其他为失败原因
    public $message;

    // 数据结果集
    public $data;



}