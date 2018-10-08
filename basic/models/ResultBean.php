<?php
/**
 * Created by PhpStorm.
 * User: sunshine
 * Date: 18/8/28
 * Time: 19:24
 */

namespace app\models;


class ResultBean
{
    // 状态码：1成功，其他为失败
        public  $code;

    // 成功为success，其他为失败原因
        public  $message;

    // 数据结果集
        public  $data;

}