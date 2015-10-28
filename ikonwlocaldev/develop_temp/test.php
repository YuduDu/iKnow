<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 10/26/15
 * Time: 2:54 PM
 */

require_once "db_func.php";

echo DBformquery_select("Order",array("orderid"),array("massaid"=>$massaid));
