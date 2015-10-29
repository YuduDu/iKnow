<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>插入商家</title>
</head>
<?php
require_once "db_func.php";
$con = DBconnect();
$name = $_POST['name'];
$shopid = $_POST['shopid'];
$phone = $_POST['phone'];
$province = $_POST['province'];
$city = $_POST['city'];
$address = $_POST['address'];
$opentime = $_POST['opentime'];
$closetime = $_POST['closetime'];
insert_shop($con,$name,$shopid,$phone,$province,$city,$address,$opentime,$closetime);
function insert_shop($con,$name,$shopid,$phone,$province,$city,$address,$opentime,$closetime){
	$sql_insert_shop = "INSERT INTO Shop (name,shopid,phone,address,opentime,closetime,city,province) VALUES ('".$name ."',".$shopid .",'". $phone ."','" ."$address" ."','" .$opentime."','".$closetime."','" .$city ."','" .$province ."');";
	if (mysql_query($sql_insert_shop,$con)) {
		echo "New record created successfully in sql_massagist";
	} else {
		echo "Error: " . $sql_insert_shop . "<br>" . mysql_error($con);
	}
}