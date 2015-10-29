<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 10/26/15
 * Time: 2:54 PM
 */

require_once "../updateOrderAmount.php";

//$rest =  DBformquery_update(null,array("number"=>"111","orderid"=>"1111223","hehe"=>"haha"),array("condition1"=>"wer","condition2"=>"sss","condition3"=>"fasdfa"),"and");
//var_dump($rest =  DBformquery_update("Order",array("number"=>"111","orderid"=>"1111223","hehe"=>"haha"),array("condition1"=>"wer","condition2"=>"sss","condition3"=>"fasdfa"),"and"));
//var_dump(DBupdate($con,"fd",array("amount"=>"amount+1"),array("massaid"=>"1","serviceid"=>"1"),"and"));
updateServiceAmount("15136352580",4);