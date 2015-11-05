<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 10/26/15
 * Time: 2:54 PM
 */

require_once "../db_func.php";
$massaid=13233997914;

$con = DBconnect();
$result = DBfetchall2($con,"massagist_appt",array("orderid","start","end","serviceid"),array("massaid"=>$massaid),null," and  to_days(start) < to_days(now())");
//var_dump($result);

$return = array();
foreach($result as $row){
    //seperate the datetime to date and time
    $starttime = strtotime($row["start"]);
    $endtime = strtotime($row["end"]);
    $startdate = date('20y年m月d日',$starttime);
    $enddate = date('20y年m月d日',$endtime);
    if($startdate==$enddate)
    {
        $date=$startdate;
        $row['start']=date('H:i:s',$starttime);
        $row['end']=date('H:i:s',$endtime);
    }
    else echo "Order ".$row['orderid']." have different appointment start date and end date, please check the datebase, and appointment function.";

    //get service name
    $service = DBfetchone2($con,"Service",array("name"),array("serviceid"=>$row["serviceid"]));
    $row["servicename"] = $service['name'];
    unset($row['serviceid']);
    if(!isset($return[$date])){
        $return[$date]=array();
    }
    //var_dump($return[$date]);
    array_push($return[$date],$row);
    //var_dump($return[$date]);
    //push into "return" list
    //array_push($return, $row);
}
echo json_encode($return);
