<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 11/12/15
 * Time: 3:29 PM
 */

require_once 'lib/db_func.php';
session_start();

if(isset($_POST['password'])&&$_POST['password']!=null){
    if(isset($_SESSION["client"]))
    {
        $pd=$_POST['password'];
        if($_SESSION["auth"]=="success") {
            $id = $_SESSION["phone"];
            reset($id,$pd);
        }
        else echo "reset denied";

    }
    else echo "Error";
    //$id=$_POST['customid'];

    //signup($_POST[form]);
}

function reset($id,$pd)//working fine
{

    $con = DBconnect();
    //$checkid = 'select phone from Customer where Phone = "' . $id . '";';
    //$result = DBfetchone($checkid, $con);

    if(DBupdate($con,$_SESSION["client"],array("password"=>$pd),array("phone"=>$id)))
        echo 111111;
    else echo 000000;

    mysql_close($con);
    session_destroy();
}