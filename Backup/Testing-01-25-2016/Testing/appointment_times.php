<?php
/*
 * Created by PhpStorm.
 * User: yudu
 * Date: 12/16/15
 * Time: 1:22 PM
 */

require_once "lib/db_func.php";
require_once "appointments.php";
require_once "lib/general.php";
date_default_timezone_set('America/Chicago');

session_start();

if (check_attribute(['type', 'serviceid'], "post")) {
    $con = DBconnect();
    $times = get_unavailable_time($con, $_SESSION['massaid']);
    $service_info = get_service_info($con, $_POST['serviceid']);
    $shopid = $service_info['shopid'];
    //$shopid = get_shopid($con,$_POST["massagistid"]);
    $service_duration = $service_info['duration'];
    if ($_POST['type'] == "shop") {
        $result = array();
        foreach ($times as $time) {
            $time = get_blocked_time($time, 0, $service_duration);
            //array_push($result,$time);
            $time = time_format($time);
            array_push($result, $time);
        }
        echo json_encode(['RespCode' => '111111', 'RespContent' => ['Status' => 'Success', 'Content' => $result]]);
    } elseif ($_POST['type'] == "visiting") {
        $time_block = get_time_block($con, $shopid);
        //echo $time_block;
        $result = array();
        foreach ($times as $time) {
            $time = get_blocked_time($time, $time_block, $service_duration);
            $time = time_format($time);
            array_push($result, $time);
        }
        //echo json_encode($result);
        echo json_encode(['RespCode' => '111111', 'RespContent' => ['Status' => 'Success', 'Content' => json_encode($result)]]);
    }
    else echo json_encode(['RespCode' => '000003', 'RespContent' => ['Status' => 'Failed', 'Content' => "Type is wrong, make sure it's either visiting or shop"]]);

} else //echo "Missing attributes";
    echo json_encode(['RespCode' => '000002', 'RespContent' => ['Status' => 'Failed', 'Content' => "Missing Parameter, make sure you post massagistid, type and serviceid"]]);

function get_service_info($con, $serviceid)
{
    $result = DBfetchone2($con, "Service", ['duration', 'shopid'], ['serviceid' => $serviceid]);
    return $result;
}


