<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 10/28/15
 * Time: 10:04 PM
 */

require_once "lib/db_func.php";

if (isset($_POST["information"]) && $_POST["information"] != null) {
    $info = (array)json_decode($_POST["information"]);
    $con = DBconnect();
    //var_dump($info);
    $order = DBfetchone2($con, "Order", array("servicename", "unitprice", "orderid", "status", "time", "promotion", "amount", "customerid", "massaid"), array("orderid" => $info["orderid"]));
    //var_dump($order);
    if ($order["massaid"] == $info["massaid"]) {
        //$pic = DBfetchone2($con, "Shop", array("pic"), array("shopid" => $order['shopid']));
        $time = DBfetchone2($con, "massagist_appt", array("service_start", "service_end"), array("orderid" => $info["orderid"]));
        if ($time) {
            $starttime = strtotime($time["service_start"]);
            $endtime = strtotime($time["service_end"]);
            $startdate = date('m/d/y', $starttime);
            $enddate = date('m/d/y', $endtime);
            if ($startdate == $enddate) {
                $date = $startdate;
                $start = date('H:i:s', $starttime);
                $end = date('H:i:s', $endtime);
            } else {
                //echo "Order ".$info["orderid"]." have different appointment start date and end date, please check the datebase, and appointment function.";
                //else echo json_encode(array("RespCode"=>"000003","Resp"=>"Order ".$info["orderid"]." have different appointment start date and end date"));

                return;
            }
            $order["servicetime"] = $date . " " . $start . " - " . $end;
            //unset($order["time"]);
            //echo json_encode($order);
            echo json_encode(['RespCode' => '111111', 'RespContent' => ['Status' => 'Success', 'Content' => $order]]);
        } //else echo "";
        else echo json_encode([
            'RespCode' => '000004',
            'RespContent' => [
                'Status' => 'Failed',
                'Content' => 'Error: No appointment is found. Please Check the Database and appointment function.'
            ]
        ]);
        //else echo json_encode(array("RespCode"=>"000001","Resp"=>"No appointment is found"));
    }
    //else echo "orderdetail Error: wrong massaid";
    //else echo json_encode(array("RespCode"=>"000003","Resp"=>"orderdetail Error: wrong massaid"));
    else echo json_encode([
        'RespCode' => '000003',
        'RespContent' => [
            'Status' => 'Failed',
            'Content' => 'orderdetail Error: wrong massaid'
        ]
    ]);
}

