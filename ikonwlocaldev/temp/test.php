<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 10/26/15
 * Time: 2:54 PM
 */

//require_once "../updateOrderAmount.php";
require_once "../db_func.php";

//$rest =  DBformquery_update(null,array("number"=>"111","orderid"=>"1111223","hehe"=>"haha"),array("condition1"=>"wer","condition2"=>"sss","condition3"=>"fasdfa"),"and");
//var_dump($rest =  DBformquery_update("Order",array("number"=>"111","orderid"=>"1111223","hehe"=>"haha"),array("condition1"=>"wer","condition2"=>"sss","condition3"=>"fasdfa"),"and"));
//var_dump(DBupdate($con,"fd",array("amount"=>"amount+1"),array("massaid"=>"1","serviceid"=>"1"),"and"));
//updateServiceAmount("15136352580",4);
$perpagenum_services=10;
$start = (1-1)*$perpagenum_services;
$con = DBconnect();

$location = json_decode($_POST['location']);
$query1 = DBformquery_select("Shop",array("shopid","name","pic","latitude","longtitude"),(array)$location,"and");
$query2 = DBformquery_select("Service",array("serviceid","shopid","name","price"),array("catid"=>1));
$query1=rtrim($query1,';');
$query2 = rtrim($query2,';');
$joinquery = DBformquery_join(array("a.serviceid","a.name as sericename","a.price","b.name as shopname","b.pic","b.latitude","b.longtitude"),"({$query2}) as a","right join","({$query1}) as b","a.shopid = b.shopid","limit ".$start.",".$perpagenum_services);
//echo $joinquery;
echo json_encode(DBfetchall($joinquery,$con));
