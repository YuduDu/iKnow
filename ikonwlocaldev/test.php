<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 9/15/15
 * Time: 4:58 PM
 */
require_once "lib/db_func.php";


date_default_timezone_set('America/Chicago');

$con = DBconnect();
$shops = DBfetchall2($con,"Shop",['shopid']);

foreach ($shops as $shop){
    $massagists = DBfetchall2($con,"MassagistDetail",['phone'],["shopid"=>$shop['shopid']]);
    $services = DBfetchall2($con,"Service",['serviceid'],['shopid'=>$shop['shopid']]);
    foreach($massagists as $massagist){
        foreach($services as $service){
            DBinsert('Has_Service',['masaid'=>$massagist['phone'],'serviceid'=>$service['serviceid']],$con);
        }
    }
}