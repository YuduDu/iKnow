<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 10/20/15
 * Time: 5:23 PM
 */

require_once "db_func.php";

//$massaid = $_POST['massaid'];
//$serviceid = $_POST['serviceid'];
//$new_amount = 0;
//updateServiceAmount($massaid,$serviceid);

function updateServiceAmount($massaid, $serviceid){
    $con = DBconnect();
    if($result = DBupdate($con,"Has_Service",array("amount"=>"amount+1"),array("masaid"=>$massaid,"serviceid"=>$serviceid),"and"))
        return true;
    else return false;;
}