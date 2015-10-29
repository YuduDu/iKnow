<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 10/26/15
 * Time: 2:54 PM
 */

require_once "../db_func.php";

$con = DBconnect();
$result = DBfetchall2($con,"massagist_appt",array("orderid","start","end","serviceid"),array("massaid"=>"15652519917"),null," and  to_days(start) = to_days(now())");
//$result = DBfetchall2($con)
echo json_encode($result);