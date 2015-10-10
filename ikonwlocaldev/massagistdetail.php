<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 9/12/15
 * Time: 11:01 AM
 */
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 9/12/15
 * Time: 10:46 AM
 */

//----------------------------NOT FINISHED-------------------

require_once "db_func.php";
if(isset($_POST['serviceid'])&&$_POST['serviceid']!=""){
    getservicedetail($_POST['serviceid']);
}


//function getservicedetail
function getservicedetail($id){
    $con = DBconnect();
    //$massagistdetail = DBfetchone("Select from ")
    $servicedetail = DBfetchone("SELECT shopid,name,shortdesc,price,funcdesc,intro FROM Service WHERE serviceid = ".$id.";",$con);
    //echo $getservice;
    $Arr = array();
    while($service=mysql_fetch_row($servicedetail)){
        $getshopdetail = mysql_query("select name,latitude,longtitude,phone,address,pic from Shop where shopid=".$service["shopid"].";", $con);
        $shop=mysql_fetch_array($getshopdetail);
        //echo $row[0],$row[1];
        $a=array("servicename"=>$service["name"],"shortdesc"=>$service["shortdesc"],"price"=>$service["price"],"funcdes"=>$service["funcdesc"],"intro"=>$service["intro"],"shopname"=>$shop["name"],"latitude"=>$shop["latitude"],"longtitude"=>$shop["longtitude"],"phone"=>$shop["phone"],"address"=>$shop["address"],"pic"=>$shop["pic"]);
        //echo $a;
        array_push($Arr,$a);
    }
    echo json_encode($Arr);
}