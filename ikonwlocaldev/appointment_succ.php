<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 10/14/15
 * Time: 12:09 AM
 */

//READ DATA FROM order.php
require_once "configs.php";
require_once "db_func.php";
session_start();
$_SESSION['starttime']=null;
$_SESSION['duration'] = null;
$_SESSION['endtime'] = null;

/*-------------test only----------------------
$_SESSION["customerid"]=1;
$_SESSION["massaid"]=1;
$_SESSION["serviceid"]=1;
$_SESSION['orderid']=23449;
//------------------------------------*/

if(isset($_POST["starttime"])&&$_POST["starttime"]!=null){
    $time1 = $_POST["starttime"];
    //$time = date($time1);
    $_SESSION["starttime"] = $time1;
    make_appointment();
}


function make_appointment(){
    $con=DBconnect();

    $duration_1 = get_duration($con,$_SESSION['serviceid']);
    $duration = (int)$duration_1;
    $_SESSION['duration'] = $duration;

    $hour = (int)substr($_SESSION["starttime"],11,2);//time interval of hour,begining time
    $add_hour = $hour + $duration;//time interval of hour,end of time
    $end = substr_replace($_SESSION["starttime"],$add_hour,11,2);
    echo "end time is :" .$end;
    $_SESSION["endtime"]=$end;
    var_dump($_SESSION);
    return insert_service_appt($con,$_SESSION['massaid'],$_SESSION['customerid'],$_SESSION["starttime"],$_SESSION["endtime"],$_SESSION['serviceid'],$_SESSION['orderid']);
}


function get_duration($con,$sid){
    $sql_duration = "SELECT duration FROM Service WHERE serviceid = " .$sid .";";
    //$sql_duration1 = "SELECT duration FROM Service WHERE serviceid =1;";
    $result = mysql_query($sql_duration,$con);

    $duration = mysql_fetch_assoc($result);
    return $duration;
}

function insert_service_appt($con,$mid, $cid, $start, $end, $sid, $orid){
    $sql_insert = "INSERT INTO massagist_appt (massaid, customerid, start, end, serviceid, orderid) VALUES (".$mid.",".$cid.",'".$start."','".$end."',".$sid.",".$orid.");";
    if (mysql_query($sql_insert,$con)) {
        return True;
    }
    else {
        return "Insert Error: " . mysql_error();
    }
}
