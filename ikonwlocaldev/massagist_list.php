<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 10/27/15
 * Time: 11:07 PM
 */

require_once "db_func.php";

if(isset($_POST["action"])&&$_POST["action"]!=null&&isset($_POST["massaid"])&&$_POST["massaid"]!=null){
    switch ($_POST["action"]){
        case 'orderlist':
            getmassagistorderlist($_POST['massaid']);
            break;
        case 'servicelist':
            getmassagistservicelist($_POST['massaid']);
            break;
        case 'commentlist':
            getmassagistcommentlist($_POST['massaid']);
            break;
    }
}
else echo "Error: action or massaid is not set!";

function getmassagistorderlist($massaid){
    $con = DBconnect();
    //$query = DBformquery_select("Order",array("orderid"),array("massaid"=>$massaid));
    //$joinquery = DBformquery_select("massagist_appt",array("starttime"))
    $result = DBfetchall2($con,"massagist_appt",array("orderid","start","end","serviceid"),array("massaid"=>$massaid));
    $return = array();
    foreach($result as $row){
        //seperate the datetime to date and time
        $starttime = strtotime($row["start"]);
        $endtime = strtotime($row["end"]);
        $startdate = date('m/d/y',$starttime);
        $enddate = date('m/d/y',$endtime);
        if($startdate==$enddate)
        {
            $row['date']=$startdate;
            $row['start']=date('H:i:s',$starttime);
            $row['end']=date('H:i:s',$endtime);
        }
        else echo "Order ".$row['order']." have different appointment start date and end date, please check the datebase, and appointment function.";

        //get service name
        $service = DBfetchone2($con,"Service",array("name"),array("serviceid"=>$row["serviceid"]));
        $row["servicename"] = $service['name'];
        unset($row['serviceid']);

        //push into "return" list
        array_push($return, $row);
    }
    echo json_encode($return);
}

function getmassagistservicelist($massaid){


}