<?php
/**
 * Created by PhpStorm.
 * User: yudu
 * Date: 9/20/15
 * Time: 10:32 PM
 */
	require_once "db_func.php";
  	if(isset($_POST)){
        $form=$_POST['pass'];
        //echo $form;
        //$pd=$_POST['custompassword'];
        login($form);
    }

	function login($form){
        $con=DBconnect();
        //echo $form;
        $char=json_decode($form,true);
        //echo "success";
        //var_dump($char);
        //echo (string)$char["phone"];
        $query='select password from Customer where Phone = "'.(string)$char["phone"].'";';
        //echo $query;
        $pdw=DBfetchone($query,$con);
        //echo "db connnect";
        //var_dump($pdw);
        //echo (string)$char["password"];
        if ((string)$char["password"]==$pdw[0]){
            echo "success";
        }
        else echo "Fail";
        mysql_close($con);
    }
?>