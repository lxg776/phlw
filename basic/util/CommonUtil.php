<?php
/**
 * Created by PhpStorm.
 * User: sunshine
 * Date: 18/9/1
 * Time: 12:24
 */
namespace app\util;

class CommonUtil
{


    public static  function CallAPI($method, $url, $data = false){
    $curl = curl_init();
    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

// Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array( /*设置请求头*/
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data)));

        $result = curl_exec($curl);
        AddMessage2Log(print_r($result,true));
        curl_close($curl);
        return $result;
    }

/**
     * 获取随机数
     * @param $num
     * @return string
     */
    public  static function  randomCheckCode($num){
            $code ="";
            for($i=0;$i<$num;$i++){
                $item = mt_rand(0, 10);
                $code = $code.$item;
            }
                return $code;
    }

    public static function objectToArray($e)
    {
        $e = (array)$e;
        foreach ($e as $k => $v) {
            if (gettype($v) == 'resource') return;
            if (gettype($v) == 'object' || gettype($v) == 'array')
                $e[$k] = (array)objectToArray($v);
        }
        return $e;
    }


    /**
     * 根据日期计算年龄
     * @param $birthday
     * @return false|string
     */
    public static function getAge($birthday)
    {
        $iage = 0;
        if (!empty($birthday)) {
            $year = date('Y', strtotime($birthday));
            $month = date('m', strtotime($birthday));
            $day = date('d', strtotime($birthday));

            $now_year = date('Y');
            $now_month = date('m');
            $now_day = date('d');

            if ($now_year > $year) {
                $iage = $now_year - $year - 1;
                if ($now_month > $month) {
                    $iage++;
                } else if ($now_month == $month) {
                    if ($now_day >= $day) {
                        $iage++;
                    }
                }
            }
        }
        return $iage;
    }
}