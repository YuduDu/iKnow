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

function DBformquery_join($resultlist, $join_left, $join_operate, $join_right, $on_command, $additioncommand = ""){
    $para = join(",",array_values($resultlist));
    $query="";
    if($join_left!=null&&$join_operate!=null&&$join_right!=null){
        $query = "select $para from $join_left $join_operate $join_right on $on_command $additioncommand;";
    }
    return $query;
}

function DBformquery_select($table, $resultlist,$condition_array = null,$conditionoperate = "",$additioncommand=""){
    $key = array_keys($condition_array);
    $value = array_values($condition_array);
    $para = join(",",array_values($resultlist));
    //echo $key."\n".$value."\n".$para;
    if($table!=null&&$para!=null){
        if($condition_array!=null) {
            $query = "select $para from `$table` where ";
            for($i=0;$i<sizeof($condition_array);$i++)
            {
                //echo sizeof($condition_array);
                $query .= "$key[$i] = '$value[$i]' ";
                if($i==sizeof($condition_array)-1){
                    break;
                }
                $query .="$conditionoperate ";
                //return true;
            }
            $query .="$additioncommand;";
            //$query = "select $para from `$table` where $key[0] = $value[0] $additioncommand;";
        }
        else $query = "select $para from `$table` $additioncommand;";
    }
    else if ($additioncommand!=null){
        $query = $additioncommand;
    }
    else echo "Error: all parameter is null, please double check.";
    //echo $query;
    return $query;
}

function DBformquery_update($table=null, $updatearray = null,$condition_array = null, $conditionoperate ="", $additioncommand="" ){
    if($table!=null&&$updatearray!=null&&$condition_array!=null){
        //$update_key = array_keys($updatearray);
        //$update_value = array_values($updatearray);
        $condition_key = array_keys($condition_array);
        $condition_value = array_values($condition_array);
        $query = "update `$table` set ";
        foreach($updatearray as $key=>$value){
            $query .= " $key = $value,";
        }
        $query = rtrim($query,',');
        $query .= " where ";
        foreach($condition_array as $key=>$value){
            $query .= " $key = $value $conditionoperate";
        }
        $query = rtrim($query, $conditionoperate);
        $query .= $additioncommand.";";
        return $query;
    }
    else
    {
        //echo "Error: Table name or parameters are null, please double check.";
        return false;
    }
}

function DBupdate($con,$table=null, $updatearray = null,$condition_array = null, $conditionoperate ="", $additioncommand=""){
    $query = DBformquery_update($table, $updatearray,$condition_array, $conditionoperate, $additioncommand);
    mysql_query($query, $con) or die("Fetchall Error:" . mysql_error());
    return true;
}


function DBfetchall($query,$con)
{
    if (isset($query) && isset($con)) {
        //$return=array();
        $result = mysql_query($query, $con) or die("Fetchall Error:" . mysql_error());
        //return mysql_fetch_array($result);
        while ($row = mysql_fetch_assoc($result)) {
            $rows[] = $row;
        }
        if (!empty($rows)) {
            return $rows;
        } else return null;
    }
}

    /*function DBfetchall1($con,$table, $resultlist,$condition_array = null,$morecondition = ""){//将condition——array改成condition_string直接写条件语句
        $key = array_keys($condition_array);
        $value = array_values($condition_array);
        $para = join(",",array_values($resultlist));
        if($condition_array!=null) {
            $query = "select $para from `$table` where $key[0] = $value[0] $morecondition;";
        }
        else $query = "select $para from `$table` $morecondition;";
        //echo $query;
        //echo $query;
        $result = mysql_query($query,$con) or die("Fetchall Error:".mysql_error());
        while($row = mysql_fetch_assoc($result)) {
            $rows[]=$row;
        }
        if(!empty($rows)){return $rows;}
        else return null;
    }*/

    function DBfetchall2($con, $table = null, $resultlist = null, $condition_array = null, $conditionoperate = "", $additioncommand = "")
    {//将condition——array改成condition_string直接写条件语句

        $query = DBformquery_select($table, $resultlist, $condition_array, $conditionoperate, $additioncommand);
        //echo $query;

        $result = mysql_query($query, $con) or die("Fetchall Error:" . mysql_error());
        while ($row = mysql_fetch_assoc($result)) {
            $rows[] = $row;
        }
        if (!empty($rows)) {
            return $rows;
        } else return null;
    }


    function DBfetchone2($con, $table, $resultlist, $condition_array = null,$conditionoperate = "", $additioncommand = "")
    {//
        $query = DBformquery_select($table, $resultlist, $condition_array, $conditionoperate, $additioncommand);
        //echo $query;
        $result = mysql_query($query, $con) or die("Fetchone Error:" . mysql_error());
        return mysql_fetch_assoc($result);
    }

    function DBfetchone($query, $con)
    {
        if (isset($query) && isset($con)) {
            $result = mysql_query($query, $con) or die("Fetchone Error:" . mysql_error());
            //var_dump(mysql_fetch_assoc($result));
            return mysql_fetch_assoc($result);
        } else
            return false;

    }


    function DBselectsUseonekey($parameterarray = "*", $keyarray = null, $keyname = null, $table = null, $con)
    {
        //echo "DBselect:";
        //var_dump($parameterarray);
        $para = join(",", $parameterarray);
        //echo $para;
        //echo "para done";
        $results = array();
        foreach ($keyarray as $key) {
            $query = "select {$para} from {$table} where {$keyname} = {$key}";
            //echo $query;
            $result = DBfetchone($query, $con);
            //var_dump($result);
            array_push($results, $result);
        }
        return $results;
    }

    function DBinsert($table, $array, $con)
    {
        $keys = join(",", array_keys($array));
        $vals = "'" . join("','", array_values($array)) . "'";
        $sql = "INSERT `{$table}` ($keys) VALUES ({$vals});";
        //echo $sql;
        if (!mysql_query($sql, $con)) {
            die("Error:" . mysql_error());
            return "false";
        } //else return true;
        else
        {

            return mysql_insert_id();
        }
        //$result = mysql_query($sql,$con) or die("Insert Error: ".mysqli_error());
        //echo 'hehe'.$result;
    }