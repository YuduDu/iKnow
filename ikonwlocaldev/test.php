<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 10/26/15
 * Time: 2:54 PM
 */

require_once "db_func.php";

DBfetchall2($con,"Order",array('orderid','servicename','shopid','shopname','status','unitprice'),array("customerid"=>$customid));