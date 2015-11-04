<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 10/26/15
 * Time: 2:54 PM
 */

//require_once "../updateOrderAmount.php";
require_once "../db_func.php";
$test = '{"resp":{"respCode":"000000","templateSMS":{"createDate":"20151103134941","smsId":"96331056621dc1ffb65099ee14c2f38e"}}}';
$result = json_decode($test);
$t1 = $result->resp->respCode;
var_dump($t1);
