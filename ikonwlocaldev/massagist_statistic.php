<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 11/4/15
 * Time: 1:47 PM
 */

require_once "lib/db_func.php";
if(isset($_POST["massaid"])&&$_POST["massaid"]!=null){
    basic_statistic($_POST["massaid"]);

}

function basic_statistic($massaid){

    $con =DBconnect();
    $result = DBfetchall2($con,"Has_Service",array("sum(amount) as ordernum","sum(money) as money"),array("masaid"=>$massaid));
    echo json_encode($result);
}