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