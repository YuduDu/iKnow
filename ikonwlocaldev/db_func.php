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

function DBfetchall($query,$con){
    if(isset($query)&&isset($con)){
        //$return=array();
        $result = mysql_query($query,$con) or die("Error:".mysql_error());
        while($row = mysql_fetch_array($result)) {
            $rows[]=$row;
        }
        return $rows;
        }
    else
        return false;

}

function DBfetchone($query,$con){
    if(isset($query)&&isset($con)){
        $result = mysql_query($query,$con) or die("Error:".mysql_error());
        return mysql_fetch_array($result);
    }
    else
        return false;

}

function DBinsert($table,$array){
    $keys = join(",",array_keys($array));
    $vals = "'".join("','",array_values($array))."'";
    $sql = "insert into {$table}($keys) values ({$vals})";
    if(!mysql_query($sql)){
        die("Error:".mysql_error());
    }
    else return true;

}