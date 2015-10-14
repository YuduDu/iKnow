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
    $shop = DBfetchone("select name,latitude,longtitude,phone,address,pic,opentime,closetime from Shop where shopid=".$service["shopid"].";", $con);
    $a=array("servicename"=>$service["name"],"shortdesc"=>$service["shortdesc"],"price"=>$service["price"],"funcdes"=>$service["funcdesc"],"intro"=>$service["intro"],"shopname"=>$shop["name"],"latitude"=>$shop["latitude"],"longtitude"=>$shop["longtitude"],"phone"=>$shop["phone"],"address"=>$shop["address"],"pic"=>$shop["pic"],"opentime"=>$shop["opentime"],"closetime"=>$shop["closetime"]);
    echo json_encode($a);
}