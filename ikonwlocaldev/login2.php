<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 9/20/15
 * Time: 10:32 PM
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
        $pdw = DBfetchone2($con,"Customer",array("password"),array("phone"=>$char["phone"]));
       // echo $pdw["password"];
        if ((string)$char["password"]==$pdw["password"]){
            echo "success";
        }
        else echo "Fail";
        mysql_close($con);
    }
?>