<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 9/30/15
 * Time: 5:33 PM
 */

require_once "lib/db_func.php";

if(isset($_POST["information"])&&$_POST["information"]!=null){
    $info = (array)json_decode($_POST["information"]);
    $con = DBconnect();
    //var_dump($info);
    $order = DBfetchone2($con,"Order",array("*"),array("orderid"=>$info["orderid"]));
    //var_dump($order);
    if($order["customerid"]==$info["customerid"]){
        $pic = DBfetchone2($con, "Shop", array("pic"), array("shopid" => $order['shopid']));
        $order=array_merge($order,$pic);
        echo json_encode($order);
    }
    else echo "orderdetail Error: wrong customerid";
}