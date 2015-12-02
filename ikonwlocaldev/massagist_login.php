<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 10/28/15
 * Time: 9:55 PM
 */

require_once "lib/db_func.php";

date_default_timezone_set('America/Chicago');

require_once "vendor/autoload.php";
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


if(isset($_POST['pass'])&&$_POST['pass']!=null){
    $form=$_POST['pass'];
    //echo $form;
    //$pd=$_POST['custompassword'];
    $log=new Logger("login");
    $log->pushHandler(new StreamHandler("Log/massagist/login/".date("Y-m-d",time()).".log",Logger::INFO));
    login($log,$form);
}

function login($log,$form){
    $con=DBconnect();
    $char=json_decode($form,true);
    //var_dump($char);
    //$query='select password from Customer where Phone = "'.(string)$char["phone"].'";';
    //$pdw=DBfetchone($query,$con);
    $pdw = DBfetchone2($con,"Massagist",array("password"),array("phone"=>$char["phone"]));
    //echo $pdw["password"];
    if ((string)$char["password"]==$pdw["password"]){
        $log->addInfo("User with ip ".$_SERVER["REMOTE_ADDR"]."login to massagist account: ".$char["phone"].".");
        echo "success";
        //echo "111111";
    }
    else {
        echo "fail";
    }
    //else echo "000000";
    mysql_close($con);
}