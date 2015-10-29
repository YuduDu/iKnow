<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 10/28/15
 * Time: 9:55 PM
 */

require_once "db_func.php";
if(isset($_POST['pass'])&&$_POST['pass']!=null){
    $form=$_POST['pass'];
    //echo $form;
    //$pd=$_POST['custompassword'];
    login($form);
}

function login($form){
    $con=DBconnect();
    $char=json_decode($form,true);
    //var_dump($char);
    //$query='select password from Customer where Phone = "'.(string)$char["phone"].'";';
    //$pdw=DBfetchone($query,$con);
    $pdw = DBfetchone2($con,"Massagist",array("password"),array("phone"=>$char["phone"]));
    //echo $pdw["password"];
    if ((string)$char["password"]==$pdw["password"]){
        echo "success";
    }
    else echo "fail";
    mysql_close($con);
}