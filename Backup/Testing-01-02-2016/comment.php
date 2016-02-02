<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 10/2/15
 * Time: 10:54 PM
 */

require_once "lib/db_func.php";
require_once "update.php";

date_default_timezone_set('America/Chicago');

require_once "vendor/autoload.php";
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


if (isset($_POST["comment"]) && $_POST["comment"] != null) {

    //set-up loggers
    $logger = new Logger('comment');
    $logger->pushHandler(new StreamHandler("Log/customer/Orders/comment"));


    $test = $_POST["comment"];
    //echo $test;
    $con = DBconnect();
    $comment = (array)json_decode($test);
    $orderinfo = DBfetchone2($con, "Order", array("customerid", "massaid", "serviceid"), array("orderid" => $comment["orderid"]));

    if ($orderinfo == null) {
        $logger->addError("Failed taking order information for comment. Orderid: " . $comment["orderid"]);
    }

    //get order time
    //$keys = array_keys($comment);
    //$values = array_keys($comment);

    $time = date("Y-m-d H:i:s", time());
    $serviceid = $orderinfo["serviceid"];
    unset($orderinfo["serviceid"]);
    $comment["date"] = $time;
    $comment = array_merge($comment, $orderinfo);
    //echo $time;
    //var_dump($keys);
    //var_dump($values);
    //$keys." ".$values;

    $id = DBinsert("Comment", $comment, $con);
    //var_dump($comment);
    if (is_int($id)) {
        //$query = "update `Order` set status = 'DONE' where orderid = ".$id.";";
        //DBfetchone($query,$con);
        DBupdate($con, "Order", array("status" => "'DONE'"), array("orderid" => $id));
        updateCommentAmount($comment["massaid"], $serviceid);
        // echo "success";
        //echo "111111";
        $response['RespCode'] = 111111;
        $response['RespContent'] = ['Status' => 'Success', 'Content' => ['OrderId' => $id]];
        echo json_encode($response);
        $logger->addInfo("Successfully make comment. Orderid: " . $comment["orderid"]);
    } else {
        //echo "insert comment wrong";
        $response['RespCode'] = 000000;
        $response['RespContent'] = ['Status' => 'Failed', 'Content' => 'Insert comment wrong!'];
        echo json_encode($response);
        $logger->addNotice("Insert database Failed. Orderid: " . $comment["orderid"]);
    }
    //else echo "000000";
}