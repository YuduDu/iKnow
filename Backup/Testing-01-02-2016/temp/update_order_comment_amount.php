<?php

    require_once "../db_func.php";

    $con = DBconnect();
    $t = DBfetchall2($con,"Order",array("massaid", "serviceid", "count(orderid)","sum(amount)"),null,null,"group by massaid, serviceid");
var_dump($t1);
    foreach($t as $t1){
        DBupdate($con,"Has_Service",array("amount"=>$t1["count(orderid)"],"money"=>$t1["sum(amount)"]),array("masaid"=>$t1["massaid"],"serviceid"=>$t1["serviceid"]),"and");
    }
    //DBupdate($con,"Has_Service",array("amount"=>$t1["count(orderid)"],"money"=>$t1["sum(amount)"]),array("massaid"=>$t1["massaid"],"serviceid"=>$t1["serviceid"]),"and");
    //t2 = DBfetchall2($con,'Comment')
