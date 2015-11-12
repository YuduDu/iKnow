
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
	<meta charset="UTF-8">
	<title>查询结果</title>
</head>
<?php
	require_once 'configs.php';
	require_once 'db_func.php';
	$con = DBconnect();

function get_massagist_by_mid($con, $mid){
	$sql_massagist = "SELECT * FROM MassagistDetail WHERE phone = '$mid'";
	$result = mysql_query($sql_massagist,$con) or die("Fetch massaid Error:".mysql_error());
	echo "<center>";
	echo "<table border='1'>";
	echo "<TR><TD>NAME</TD><TD>STARS</TD><TD>SHOP</TD><TD>ACTION</TD></TR>";
	while($row = mysql_fetch_assoc($result)){
		echo "NAME: " .$row['name'] ;
		echo "<br/>";
		echo "STARS: " .$row['stars'] ;
		echo "<br/>";
		echo "SHOP: ".$row['shopid'];
		echo "<br/>";
	}
}

function get_appointment_by_massagist($con, $mid){
	$sql_apoint = "SELECT * FROM massagist_appt WHERE massaid = '$mid'";
	$result = mysql_query($sql_apoint,$con) or die ("Fetch appointment(mid) Error :" .mysql_errno());
	while($row = mysql_fetch_assoc($result)){
		echo "ORDERID: " .$row['orderid'];
		echo "<br/>";
		echo "START TIME: " .$row['start'];
		echo "<br/>";
		echo "END TIME: ".$row['end'];
		echo "SERVICE ID: ".$row['orderid'];
		echo "<br/>";
		echo "CUSTOMER: " .$row['customerid'];
		echo "<br/>";
	}
}

//未完成： 按照日期查找appointment
function get_appointment_by_date($con,$date){
	$year = substr($date,1,4);
	$month = substr($date,6,2);
	$day = substr($date,9, 2);
	$hour = substr($date, 12, 2);
	$sql_apoint = "SELECT * FROM massagist_appt WHERE start = '$date'";
	$result = mysql_query($sql_apoint,$con) or die("Fetch appointment(date) Error:" .mysql_errno());
	while($row = mysql_fetch_assoc($result)){
		echo "ORDERID: " .$row['orderid'] ;
		echo "<br/>";
		echo "START TIME: " .$row['start'] ;
		echo "<br/>";
		echo "END TIME: " .$row['end'];
		echo "<br/>";
		echo "SERVICE ID: " .$row['orderid'] ;
		echo "<br/>";
		echo "CUSTOMER: " .$row['customerid'];
		echo "<br/>";
	}
}
//get_appointment_by_date($con, "2015-10-14 08:00:00");

function get_order_by_massagist($con,$mid){
	$sql_order = "SELECT * FROM Order WHERE massaid = '$mid'";
	$result = mysql_query($sql_order,$con) or die ("Fetch Order(mid) Error:" .mysql_errno());
	while($row = mysql_fetch_assoc($result)){
		echo "ORDER ID:" .$row['orderid'] ;
		echo "<br/>";
		echo "CUSTOMERID:" .$row['customerid'] ;
		echo "<br/>";
		echo "SERVICEID:" .$row['massaid'];
		echo "<br/>";
		echo "QUANTITI: " .$row['qty'] ;
		echo "<br/>";
		echo "ORDER_TIME:" .$row['time'];
		echo "<br/>";
	}

}



