<?php
	require_once "db_func.php";
  	if($_POST){
		$id=$_POST['customid'];
		$pd=$_POST['custompassword'];
		login($id,$pd);
		}

	function login($id,$pd){
		$con=DBconnect();
  		$getpd='select password from Customer where Phone = '.$id.';';
  		$pdresult = mysql_query($getpd,$con);
  		$row=mysql_fetch_array($pdresult);
    //echo $getpd;
    //echo $pdresult;
    	echo $row[0];
  		if ($pd==$row[0]){
  			echo "success";
  		}
  		else echo "Fail";
    	mysql_close($con);
  	}
?>