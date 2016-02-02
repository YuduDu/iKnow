<?php

/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 12/16/15
 * Time: 2:13 PM
 */

require_once "lib/db_func.php";
date_default_timezone_set('America/Chicago');


function get_unavailable_time($con, $massaid)
{
    $times = DBfetchall2($con, 'massagist_appt', ['block_start', 'block_end'], ['massaid' => $massaid], null, " and DATE(block_end) BETWEEN CURRENT_DATE AND DATE(CURRENT_DATE + INTERVAL 28 DAY)");
    $result = [];
    foreach ($times as $time) {
        array_push($result, [$time['block_start'], $time['block_end']]);
    }
    return $result;

}

function get_time_block($con, $shopid)
{
    $result = DBfetchone2($con, "Shop", ['visiting_block'], ['shopid' => $shopid]);
    return $result['visiting_block'];

}


function get_blocked_time($time, $time_block, $service_duration_addinfrontofstart = null)
{
    //var_dump($time);
    $start = new DateTime($time[0]);
    $end = new DateTime($time[1]);
    $start_block = (int)$time_block + (int)$service_duration_addinfrontofstart;
    $new_start = $start->sub(new DateInterval('PT' . $start_block . 'M'));
    //var_dump($new_start);
    $new_end = $end->add(new DateInterval('PT' . $time_block . 'M'));
    return [$new_start->format('Y-m-d H:i:s'), $new_end->format('Y-m-d H:i:s')];

}

function form_service_time($con, $service_start, $serviceid)
{
    $tmp = DBfetchone2($con, "Service", ['duration'], ['serviceid' => $serviceid]);
    $service_begin = new DateTime($service_start);
    return [$service_start, $service_begin->add(new DateInterval('PT' . $tmp['duration'] . 'M'))->format('Y-m-d H:i:s')];
}

function time_format($time)
{
    $start = New DateTime($time[0]);
    $end = New DateTime($time[1]);
    $start_minute = $start->format("i");
    if (0 < (int)$start_minute && (int)$start_minute < 30) {
        $begin = $start->sub(new DateInterval('PT' . (int)$start_minute . 'M'))->format('Y-m-d H:i:s');
    } elseif ((int)$start_minute > 30) {
        $minute = (int)$start_minute - 30;
        $begin = $start->sub(new DateInterval('PT' . $minute . 'M'))->format('Y-m-d H:i:s');
    } else $begin = $time[0];
    $end_minute = $end->format('i');
    if (0 < (int)$end_minute && $end_minute < 30) {
        $minute = 30 - (int)$end_minute;
        $finish = $end->add(new DateInterval('PT' . $minute . 'M'))->format('Y-m-d H:i:s');
    } elseif ((int)$end_minute > 30) {
        $minute = 60 - (int)$end_minute;;
        $finish = $end->add(new DateInterval('PT' . $minute . 'M'))->format('Y-m-d H:i:s');
    } else $finish = $time[1];

    return [$begin, $finish];

}
