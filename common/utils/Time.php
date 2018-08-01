<?php
/**
 * Created by PhpStorm.
 * User: R720
 * Date: 2018/8/1
 * Time: 11:04
 */

namespace common\utils;

class Time
{
    static function Sec2Time($time)
    {
        if (!is_numeric($time)) {
            throw new Exception('param $time should be number');
        }
        $t = '';
        if ($time >= 31556926) {
            $years = floor($time / 31556926);
            $time = ($time % 31556926);
            if ($years) {
                $t .= $years . '年';
            }
        }
        if ($time >= 86400) {
            $days = floor($time / 86400);
            $time = ($time % 86400);
            if (!$t && $days) {
                $t .= $days . '天';
            }
        }
        if ($time >= 3600) {
            $hours = floor($time / 3600);
            $time = ($time % 3600);
            if (!$t && $hours) {
                $t .= $hours . '小时';
            }
        }
        if ($time >= 60) {
            $minutes = floor($time / 60);
            $time = ($time % 60);
            if (!$t && $minutes) {
                $t .= $minutes . '分';
            }
        }
        $seconds = floor($time);
        if (!$t && $seconds) {
            $t .= $seconds . '秒';
        }
        return $t;
    }
}