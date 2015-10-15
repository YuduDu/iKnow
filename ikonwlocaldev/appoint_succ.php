<?php
/**
 * Created by PhpStorm.
 * User: huangsiman
 * Date: 10/14/15
 * Time: 13:53
 */

require_once "configs.php";
require_once "db_func.php";
session_start();

$_SESSION['starttime'] = null;
$_SESSION['endtime'] = null;
$_SESSION['serviceid'] = 1;
$_SESSION['massaid'] = 1;
$_SESSION['orderid'] =23450;
$_SESSION['customerid'] = 1;


if(isset($_POST["starttime"])&&$_POST["starttime"]!=null){
    $time1 = $_POST["starttime"];
    //$time = date($time1);
    $_SESSION["starttime"] = $time1;
    //echo "post data: ".$_SESSION["starttime"];
    make_appointment();
}

function make_appointment(){
    $con=DBconnect();
    //echo "make_appointment function : ".$_SESSION["starttime"];
    $duration_1 = get_duration($con,$_SESSION['serviceid']);
    $duration = (int)$duration_1;
    $_SESSION['duration'] = $duration;

    $hour = (int)substr($_SESSION["starttime"],11,2);//time interval of hour,begining time
    $add_hour = $hour + $duration;//time interval of hour,end of time
    $end = substr_replace($_SESSION["starttime"],$add_hour,11,2);
    //echo "end time is :" .$end;
    $_SESSION["endtime"]=$end;
    //var_dump($_SESSION);


   // check_ava($con,$_SESSION['starttime'],$_SESSION['duration']);

    if(check_start($con,$_SESSION['starttime']))
    {
        echo "Insert success with correct start time ";
        insert_service_appt($con,$_SESSION['massaid'],$_SESSION['customerid'],$_SESSION["starttime"],$_SESSION["endtime"],$_SESSION['serviceid'],$_SESSION['orderid']);
    }
    else {
        echo "start already exist";
        return "start already exist";
    }

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
        echo "Insert Success";
        return True;
    }
    else {
        return "Insert Error: " . mysql_error();
    }
}


function check_start($con, $starttime){
    $sql = "SELECT start FROM massagist_appt ";
    $result = mysql_query($sql,$con);

    while($row = mysql_fetch_array($result)){

        $rows[ ]=$row["start"];

    }
    foreach ($rows as $key => $value){
        if(strcmp($starttime,$value) == 0){

            return false;
        }
        else return true;
    }
}


function check_ava($con, $starttime, $duration)
{
    $sql_sta = "SELECT start FROM massagist_appt ";
    //$duration = $_SESSION['duration'];
    $hour = (int)substr($starttime,11,2);
    $add_hour = $hour + $duration;
    $end = substr_replace($starttime,$add_hour,11,2);

    $sql_end = "SELECT end FROM massagist_appt";
    $result_sta = mysql_query($sql_sta, $con);
    $result_end = mysql_query($sql_end,$con);

    while($row_sta = mysql_fetch_array($result_sta)){
        $rows_sta[] = $row_sta["start"];
    }
    while($row_end = mysql_fetch_array($result_end)) {
        $rows_end[] = $row_end["end"];
    }

    if(is_array($rows_end) && is_array($rows_sta)){

        foreach($rows_sta as $key => $values){
            if(strcmp($starttime,$values)<0){
                echo "start time" .$starttime ."</br>";
                echo "start value is " .$values ."</br>";
                echo "start time OK </br>";
                foreach($rows_end as $key => $valuee){
                    if(strcmp($end,$valuee)<0)
                    {
                        echo "end time is " .$end ."</br>";
                        echo "end value is " .$valuee ."</br>";
                        echo "Selected start and service avaliable </br>" ;
                    }
                }
            }

        }
    }


}
