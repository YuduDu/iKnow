<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 9/11/15
 * Time: 11:30 AM
 */
require_once "configs.php";
function DBconnect(){
    $con = mysql_connect(DB_HOST,DB_USER,DB_PWD,false,CLIENT_LONG_PASSWORD);
    if(!$con)
    {
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("iKnow", $con) or die('select db failed:'.mysql_error());
    mysql_query("SET NAMES utf8");
    return $con;
}