<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 9/12/15
 * Time: 10:46 AM
 */

require_once "lib/db_func.php";

date_default_timezone_set('America/Chicago');

require_once "vendor/autoload.php";
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


if (isset($_POST['serviceid']) && $_POST['serviceid'] != "") {
    getservicedetail($_POST['serviceid']);
}

function getservicedetail($id)
{

    $log = new Logger("services_info");
    $log->pushHandler(new StreamHandler("Log/customer/Info/services/" . date("Y-m-d", time()) . ".log", Logger::INFO));

    $con = DBconnect();
    $service = DBfetchone("SELECT shopid,name,shortdesc,price,funcdesc,intro FROM Service WHERE serviceid = " . $id . ";", $con);
    if ($service == null) {
        $log->addError("Failed to get service information from Service table. User with ip " . $_SERVER["REMOTE_ADDR"] . "tried to get information of service " . $id);
    }
    //echo $getservice;
    //$Arr = array();
    $shop = DBfetchone("select name,latitude,longtitude,phone,address,pic,opentime,closetime from Shop where shopid=" . $service["shopid"] . ";", $con);
    if ($shop == null) {
        $log->addError("Failed to get shop information from Shop table. User with ip " . $_SERVER["REMOTE_ADDR"] . "tried to get information of shopid " . $service["shopid"] . "of service " . $id);
    }
    $a = array("servicename" => $service["name"], "shortdesc" => $service["shortdesc"], "price" => $service["price"], "funcdes" => $service["funcdesc"], "intro" => $service["intro"], "shopname" => $shop["name"], "latitude" => $shop["latitude"], "longtitude" => $shop["longtitude"], "phone" => $shop["phone"], "address" => $shop["address"], "pic" => $shop["pic"], "opentime" => $shop["opentime"], "closetime" => $shop["closetime"]);
    //echo json_encode($a);
    echo json_encode([
        'RespCode' => 111111,
        'RespContent' => [
            'Status' => 'Success',
            'Content' => $a
        ]
    ]);
}