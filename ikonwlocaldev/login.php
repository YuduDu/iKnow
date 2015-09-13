<?php
	require_once "db_func.php";
  	if($_POST){
		$id=$_POST['customid'];
		$pd=$_POST['custompassword'];
		login($id,$pd);
		}

	function login($id,$pd){
		$con=DBconnect();
  		$pdw=DBfetchone('select password from Customer where Phone = '.$id.';',$con);
		//echo $pdw;
  		if ($pd==$pdw[0]){
  			echo "success";
  		}
  		else echo "Fail";
    	mysql_close($con);
  	}
?>