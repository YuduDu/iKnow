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
        $result = mysql_query($query,$con) or die("Fetchall Error:".mysql_error());
        //return mysql_fetch_array($result);
        while($row = mysql_fetch_assoc($result)) {
            $rows[]=$row;
        }
        if(!empty($rows)){return $rows;}
        else return null;
    }
    else
        return false;

}

function DBfetchone($query,$con){
    if(isset($query)&&isset($con)){
        $result = mysql_query($query,$con) or die("Fetchone Error:".mysql_error());
        //var_dump(mysql_fetch_assoc($result));
        return mysql_fetch_assoc($result);
    }
    else
        return false;

}

//function DBselectonekey($parameter)
function DBselectsUseonekey($parameterarray=null, $keyarray=null, $keyname=null, $table=null, $con){
    //echo "DBselect:";
    //var_dump($parameterarray);
    $para = join(",",$parameterarray);
    //echo $para;
    //echo "para done";
    $results=array();
    foreach($keyarray as $key){
       $query = "select {$para} from {$table} where {$keyname} = {$key}";
        //echo $query;
        $result = DBfetchone($query,$con);
        //var_dump($result);
        array_push($results,$result);
    }
    return $results;
}

function DBinsert($table,$array,$con){
    $keys = join(",",array_keys($array));
    $vals = "'".join("','",array_values($array))."'";
    $sql = "insert into {$table}($keys) values ({$vals})";
    if(!mysql_query($sql,$con)){
        die("Error:".mysql_error());
    }
    else return true;

}