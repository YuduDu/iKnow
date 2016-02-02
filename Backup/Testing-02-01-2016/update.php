<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 10/20/15
 * Time: 5:23 PM
 */

require_once "lib/db_func.php";

date_default_timezone_set('America/Chicago');

require_once "vendor/autoload.php";
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


//$massaid = $_POST['massaid'];
//$serviceid = $_POST['serviceid'];
//$new_amount = 0;
//updateServiceAmount($massaid,$serviceid);

function updateServiceAmount($massaid, $serviceid)
{
    $con = DBconnect();

    $log = new Logger("Database_info");
    $log->pushHandler(new StreamHandler("Log/Database/" . date("Y-m-d", time()) . "/Alert.log", Logger::INFO));

    if ($result = DBupdate($con, "Has_Service", array("amount" => "amount+1"), array("masaid" => $massaid, "serviceid" => $serviceid), "and")) {
        return true;
    } else {
        $log->addAlert("User with ip " . $_SERVER["REMOTE_ADDR"] . "ordered service :" . $serviceid . ", update massagist :" . $massaid . " 's service amount failed");
        return false;
    }
}

function updateCommentAmount($massaid, $serviceid)
{
    $con = DBconnect();
    $log = new Logger("Database_info");
    $log->pushHandler(new StreamHandler("Log/Database/" . date("Y-m-d", time()) . "/Alert.log", Logger::INFO));

    if ($result = DBupdate($con, "Has_Service", array("comment_sum" => "comment_sum+1"), array("masaid" => $massaid, "serviceid" => $serviceid), "and")) {
        return true;
    } else {
        $log->addAlert("User with ip " . $_SERVER["REMOTE_ADDR"] . " failed to make comment for  service :" . $serviceid . ", with massagist :" . $massaid . " !");
        return false;
    }
}

function updateMoneyAmount($massaid, $serviceid, $money)
{
    $con = DBconnect();

    $log = new Logger("Database_info");
    $log->pushHandler(new StreamHandler("Log/Database/" . date("Y-m-d", time()) . "/Alert.log", Logger::INFO));

    if ($result = DBupdate($con, "Has_Service", array("amount" => "amount+".$money), array("masaid" => $massaid, "serviceid" => $serviceid), "and")) {
        return true;
    } else {
        $log->addAlert("User with ip " . $_SERVER["REMOTE_ADDR"] . "ordered service :" . $serviceid . ", update massagist :" . $massaid . " 's Money amount failed");
        return false;
    }
}

function updateStars($massaid, $star){
    $con = DBconnect();
    $stars = DBfetchone2($con,"MassagistDetail",['stars'],['phone'=>$massaid]);
    $new_stars = ceil(($stars*9+$star)/10);
    if(DBupdate($con,'MassagistDetail',['stars'=>$new_stars],['phone'=>$massaid])){
        return true;
    }
    else return false;

}