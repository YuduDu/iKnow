<?php//if (!session_id())//{session_start();//}?><!DOCTYPE html><html lang="en"><head>	<meta charset="UTF-8">	<title>客户删除</title></head><?phprequire_once 'db_func.php';$customid = $_SESSION['customer_phone'];echo $customid;$con = DBconnect();delete_customer_id($con,$customid);function delete_customer_id($con,$customid){	$sql_customer = "DELETE FROM Massagist WHERE phone = $customid";	if (mysql_query($sql_customer,$con)) {		echo "Record deleted successfully";	} else {		echo "Error deleting record: " . mysqli_error($con);	}}