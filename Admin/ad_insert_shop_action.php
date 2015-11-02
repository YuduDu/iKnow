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
$pic = $_FILES['pic']['name'];


define('ROOT',dirname(__FILE__).'/');
//$target = "/Applications/MAMP/htdocs/Admin";
$target =  ROOT.'/Applications/MAMP/htdocs/Admin/'.basename($_FILES['pic']['name']);
//$target = $target . basename( $_FILES['pic']['name']);

//insert_shop($con,$name,$shopid,$phone,$province,$city,$address,$pic,$opentime,$closetime);
function insert_shop($con,$name,$shopid,$phone,$province,$city,$address,$pic,$opentime,$closetime){
	$sql_insert_shop = "INSERT INTO Shop (name,shopid,phone,address,pic,opentime,closetime,city,province) VALUES ('".$name ."',".$shopid .",'". $phone ."','" ."$address" ."','" .$pic."','" .$opentime."','".$closetime."','" .$city ."','" .$province ."');";
	if (mysql_query($sql_insert_shop,$con)) {
		echo "New record created successfully in sql_massagist" ."<br>";
	} else {
		echo "Error: " . $sql_insert_shop . "<br>" . mysql_error($con);
	}
}

if(move_uploaded_file($_FILES['pic']['name'], $target))
{
	echo "The file ". basename( $_FILES['pic']['name']). "uploaded";
}
else {
	echo "Error：".$_FILES['pic']['error']."<br>";
}