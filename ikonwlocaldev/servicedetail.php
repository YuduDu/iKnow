<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 9/12/15
 * Time: 10:46 AM
 */

require_once "db_func.php";
if(isset($_POST['serviceid'])&&$_POST['serviceid']!=""){
    getservicedetail($_POST['serviceid']);
}

function getservicedetail($id){
    $con = DBconnect();
    $service = DBfetchone("SELECT shopid,name,shortdesc,price,funcdesc,intro FROM Service WHERE serviceid = ".$id.";",$con);
    //echo $getservice;
    //$Arr = array();
    $shop = DBfetchone("select name,latitude,longtitude,phone,address,pic from Shop where shopid=".$service[0].";", $con);
    $a=array("servicename"=>$service[1],"shortdesc"=>$service[2],"price"=>$service[3],"funcdes"=>$service[4],"intro"=>$service[5],"shopname"=>$shop[0],"latitude"=>$shop[1],"longtitude"=>$shop[2],"phone"=>$shop[3],"address"=>$shop[4],"pic"=>$shop[5]);
    echo json_encode($a);
}