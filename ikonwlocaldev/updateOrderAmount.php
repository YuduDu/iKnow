<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 10/20/15
 * Time: 5:23 PM
 */

require_once "db_func.php";

$massaid = $_POST['massaid'];
$serviceid = $_POST['serviceid'];
$new_amount = 0;
updateServiceAmount($massaid,$serviceid);

function updateServiceAmount($massaid, $serviceid){
    $con = DBconnect();
    //var_dump($massaid);
    //var_dump($serviceid);
    //$tmp = DBfetchone2($con,"Has_Service",array("amount"),array("masaid"=>$massaid,"serviceid"=>$serviceid));
    $tmp = mysql_query("select amount from Has_Service where masaid=$massaid and serviceid=$serviceid",$con) or die("get amount Error:".mysql_error());;
    //var_dump(mysql_fetch_assoc($tmp));
    $new_amount= mysql_fetch_assoc($tmp)['amount']+1;
    //echo $new_amount;
    $query = "update `Has_Service` set amount = $new_amount where masaid=$massaid and serviceid=$serviceid";
    //echo $query;
    if(mysql_query($query,$con)){
        return true;
      //  echo "done";
    }
    else return false;
}