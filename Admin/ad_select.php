
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>查询结果</title>
</head>
<?php
	require_once 'configs.php';
	require_once 'db_func.php';
	$con = DBconnect();

session_start();
$_SESSION['massa_name']=$_POST['ad_select_massa'];
$_SESSION['customer_phone'] = $_POST['ad_select_massa'];
$_SESSION['shop_name'] = $_POST['select_massagist_shop'];


if(isset($_POST['ad_select_massa'])&&$_POST['ad_select_massa']!=null){
	get_massagist_by_name($con,$_POST['ad_select_massa']);
}

if(isset($_POST['ad_select_customer'])&&$_POST['ad_select_customer']!=null){
	get_customer_by_phone($con,$_POST['ad_select_customer']);
}

if(isset($_POST['select_massagist_shop'])&&$_POST['select_massagist_shop']!=null){
	echo $_POST['select_massagist_shop'];
	get_shop_by_name($con,$_POST['select_massagist_shop']);
}

function get_massagist_by_name($con, $name){
	$sql_massagist = "SELECT * FROM MassagistDetail WHERE name = '$name'";
	$result = mysql_query($sql_massagist,$con) or die("Fetch massaid Error:".mysql_error());
	echo "<center>";
	echo "<table border='1'>";
	echo "<TR><TD>NAME</TD><TD>STARS</TD><TD>SHOP</TD><TD>ACTION</TD></TR>";
	while($row = mysql_fetch_assoc($result)) {
		echo "<tr><td>";
		echo $row['name'];
		$_SESSION['massa_name'] = $row['name'];
		echo "</td><td>";
		echo $row['stars'];
		echo "</td><td>";
		echo $row['shopid'];
		echo "</td><td>";
		?>
		<a href="delete.php"> 删除 </a>
<?php

	}
}

function get_massagist_by_mid($con, $mid){
	$sql_massagist = "SELECT * FROM MassagistDetail WHERE phone = '$mid'";
	$result = mysql_query($sql_massagist,$con) or die("Fetch massaid Error:".mysql_error());
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

function get_customer_by_phone($con,$phone){
	$sql = "SELECT * FROM Customer WHERE phone = '$phone'";
	$result = mysql_query($sql,$con);
	while($row = mysql_fetch_assoc($result)){
		echo "PHONE:" .$row['phone'];
		echo "<br/>";
		echo "NAME:" .$row['signupdate'];
		echo "<br/>";
		echo "COUNTRY:" .$row['Country'];
	}
}

function get_shop_by_name($con,$name){
	$sql_shop_name = "SELECT * FROM Shop WHERE name = '$name'";
	$result = mysql_query($sql_shop_name,$con) or die("Fetch massaid Error:".mysql_error());
	while($row = mysql_fetch_assoc($result)) {
		echo "NAME: " . $row['name'];
		echo "<br/>";
		echo "SHOPID: " . $row['shopid'];
		echo "<br/>";
		echo "PHONE: " . $row['phone'];
		echo "<br/>";
		echo "OPENTIME: " . $row['opentime'];
		echo "<br/>";
		echo "CLOSETIME: " . $row['closetime'];
		echo "<br/>";
		echo "CITY: " . $row['city'];
		echo "<br/>";
		echo "PROVINCE: " . $row['province'];
		echo "<br/>";
	}
}