<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>客户订单详情</title>
</head>
<?php
require_once 'db_func.php';
session_start();
var_dump($_SESSION);
$customid = $_SESSION['customer_phone'];
$con = DBconnect();

get_custom_order_detail($con,$customid);

function get_custom_order_detail($con,$customid){
	echo $customid;
	echo "<br>";
	$sql= "SELECT * FROM Order WHERE customerid = $customid";
	$result = mysql_query( $sql, $con );
	echo "<center>";
	echo "Customer: " .$customid ."<TR>历史订单</TR>";
	echo "<table border='1'>";
	echo "<tr><td>ODRERID</td><td>SHOP</td><td>MASSAGIST</td><td>SERVICE</td><td>LEVEL</td><td>QTY</td><td>STATUS</td><td>PROMOTION</td><td>AMOUNT</td></tr>";
	var_dump($result);
	while ($row = mysql_fetch_assoc($result)){
		echo "<tr><td>";
		echo  $row['orderid'];
		echo "</td><td>";
		echo $row['shopname'];
		echo "</td><td>";
		echo get_massatist_name($con,$row['massagistid']);
		echo "</td><td>";
		echo get_service_name($con,$row['serviceid']);
		echo "</td><td>";
		echo $row['level'];
		echo "</td><td>";
		echo $row['qty'];
		echo "</td><td>";
		echo $row['status'];
		echo "</td><td>";
		echo $row['promotion'];
		echo "</td><td>";
		echo $row['amount'];
		echo "</td></tr>";
	}
}

function get_massatist_name($con, $massagistid){
	$sql= "SELECT name FROM MassagistDetail WHERE phone = '$massagistid'";
	$result = mysql_query( $sql, $con );
	$row = mysql_fetch_assoc($result);
	return $row['name'];
}

function get_service_name($con,$serviceid){
	$sql= "SELECT name FROM Service WHERE serviceid = '$serviceid'";
	$result = mysql_query( $sql, $con );
	$row = mysql_fetch_assoc($result);
	return $row['name'];
}