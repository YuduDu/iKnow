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

//require_once "db_func.php";
require_once "db_func.php";


if(isset($_POST['massagistid'])&&$_POST['massagistid']!=""){
    getMassagistDetail($_POST['massagistid']);
}


function getMassagistDetail($id){
    $con = DBconnect();
    //$key = array();
    $service_num =3;
    $comment_num =5;
    $Massagist_Info = getMassagist_info($con,array("name","pic","level","intro","visiting_start","visiting_end","shopid"),array("phone"=>$id));
     //var_dump($Massagist_Info);

    $Shop_Info = getShop_Info($con,array("name","opentime","closetime","latitude","longtitude"), array("shopid"=>$Massagist_Info['shopid']));
    //var_dump($Shop_Info);

    $Service_list_short = getserviceslist_Limit($con,array("serviceid","name","duration","price"), array("masaid"=>$id),$service_num);
    $Comment_list_short = getCommentlist_Limit($con,array("date","customerid","stars","content"),array("massaid"=>$id),$comment_num);

    unset($Massagist_Info["shopid"]);
    $result =array("massagist_info"=>$Massagist_Info,"shop_info"=>$Shop_Info,"service_list"=>$Service_list_short,"comment_list"=>$Comment_list_short);

    echo json_encode($result);
}

function getMassagist_info($con,$Info_array,$keypair_array){
    return DBfetchone2($con,"MassagistDetail",$Info_array,$keypair_array);
}

function getShop_Info($con,$Info_array, $keypair_array){
    return DBfetchone2($con,"Shop",$Info_array,$keypair_array);
}

function getserviceslist_Limit($con,$Info_array, $keypair_array,$num){
    $services = DBfetchall2($con,"Has_Service",array("serviceid","amount"),$keypair_array,null,"order by amount desc limit ".$num);
    //var_dump($services);
    $servicelist = array();
    foreach ($services as $service){
        $service_info = DBfetchone2($con,"Service",$Info_array,$service);
        $service_info["amount"]=$service["amount"];
        array_push($servicelist,$service_info);
    }
    return $servicelist;
    //var_dump($servicelist);
    //DBselectsUseonekey($Info_array,)*/
}

function getCommentlist_Limit($con,$Info_array, $keypair_array,$num){
    $comments = DBfetchall2($con,"Comment",$Info_array,$keypair_array,null,"order by date desc limit ".$num);
    return $comments;
}