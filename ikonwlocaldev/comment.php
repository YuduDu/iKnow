<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 10/2/15
 * Time: 10:54 PM
 */

require_once "db_func.php";

if(isset($_POST["comment"])&&$_POST["comment"]!=null){
    $test = $_POST["comment"];
    //echo $test;
    $con =DBconnect();
    $comment=(array)json_decode($test);
    $orderinfo = DBfetchone2($con,"Order",array("customerid","massaid"),array("orderid"=>$comment["orderid"]));
    //get order time
    //$keys = array_keys($comment);
    //$values = array_keys($comment);

    $time= date("Y-m-d H:i:s", time());

    $comment["date"] = $time;
    $comment  = array_merge($comment,$orderinfo);
    //echo $time;
    //var_dump($keys);
    //var_dump($values);
    //$keys." ".$values;

    $id = DBinsert("Comment",$comment,$con);
    //var_dump($comment);
    if( is_int($id)){
        $query = "update `Order` set status = 'DONE' where orderid = ".$id.";";
        DBfetchone($query,$con);
        echo "success";
    }
    else echo "insert comment wrong";
}