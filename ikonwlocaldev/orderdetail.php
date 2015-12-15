<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 9/30/15
 * Time: 5:33 PM
 */

require_once "lib/db_func.php";

date_default_timezone_set('America/Chicago');

require_once "vendor/autoload.php";
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


if(isset($_POST["information"])&&$_POST["information"]!=null){


    $log=new Logger("order_info");
    $log->pushHandler(new StreamHandler("Log/customer/Info/orders/".date("Y-m-d",time()).".log",Logger::INFO));


    $info = (array)json_decode($_POST["information"]);
    $con = DBconnect();
    //var_dump($info);
    $order = DBfetchone2($con,"Order",array("*"),array("orderid"=>$info["orderid"]));
    if($order==null){
        $log->addError("Failed! User with ip ".$_SERVER["REMOTE_ADDR"]." tried to get information of order ".$info["orderid"].".");
    }
    //var_dump($order);
    if($order["customerid"]==$info["customerid"]){
        $pic = DBfetchone2($con, "Shop", array("pic"), array("shopid" => $order['shopid']));
        $order=array_merge($order,$pic);
        echo json_encode($order);
        $log->addInfo("User with ip ".$_SERVER["REMOTE_ADDR"]." of id ".$info["customerid"]." get information of order ".$info["orderid"].".");
    }
    else {
        echo "orderdetail Error: wrong customerid";
        $log->addAlert("!!! User with ip ".$_SERVER["REMOTE_ADDR"]." of id ".$info["customerid"]." tried to get order ".$info["orderid"]." of other customer.");
    }
    //else echo json_encode(array("RespCode"=>"000003","Resp"=>"orderdetail Error: wrong customerid"));
}