<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 12/22/15
 * Time: 2:17 PM
 */
require_once "lib/db_func.php";
require_once "lib/general.php";
if(check_attribute(['keyword','location','pagenum'],"post")){
    $location =(array) json_decode($_POST['location']);
    $service_result=search_services($_POST["keyword"],$location,$_POST['pagenum']);
    if($service_result){
        echo json_encode(['RespCode' => '111111', 'RespContent' => ['Status' => 'Success', 'Content' => $service_result]]);
    }
    else echo json_encode(['RespCode' => '000004', 'RespContent' => ['Status' => 'Failed', 'Content' => "No Data Found!"]]);
}


function search_services($keyword, $location,$pagenum){
    $con = DBconnect();
    $perpagenum_orders = 10;
    $start = ($pagenum - 1) * $perpagenum_orders;

    //var_dump($location);
    $join_right = DBformquery_select(
        'Shop',
        ['*'],
        $location
    );
    $join_right = rtrim($join_right,';');
    $join = DBformquery_join(
        ['a.serviceid','a.name as service_name','b.name as shop_name','a.price','b.pic', "b.latitude", "b.longtitude"],
        'Service as a',
        'inner join',
        '('.$join_right.') as b',
        'a.shopid = b.shopid',
        'and ( a.name LIKE "%'.$keyword.'%"
        or a.shortdesc LIKE "%'.$keyword.'%"
        or a.funcdesc LIKE "%'.$keyword.'%"
        or b.name LIKE "%'.$keyword.'%"
        or b.address LIKE "%'.$keyword.'%") limit '. $start . ',' .$perpagenum_orders
    );
    //echo $join;
    $result = DBfetchall($join,$con);
    if($result!=null)
    {
        return $result;
    }
    else return FALSE;
}