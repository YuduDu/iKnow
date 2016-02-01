<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>插入技师</title>
</head>
<?php
	require_once "../db_func.php";
	$con = DBconnect();
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$password = $_POST['password'];
	$shop = $_POST['shop'];
	$shop_id = get_shop_id($con,$shop);
//	insert_massagist($con,$phone,$password);
//	insert_massagist_detail($con,$phone,$name,$shop_id);

$sql_massagist = "INSERT INTO Massagist (phone, password) VALUES ('".$phone ."','".$password ."')";
$sql_massagist_detail = "INSERT INTO MassagistDetail (phone,name,shopid) VALUES ('".$phone ."','".$name ."',". $shop_id .")";
mysql_query($sql_massagist,$con);
mysql_query($sql_massagist_detail,$con);

//	function insert_massagist($con,$phone, $password){
//		$sql_massagist = "INSERT INTO Massagist (phone, password) VALUES ('".$phone ."','".$password ."')";
//
//		if (mysql_query($sql_massagist,$con)) {
//			echo "<script type='text/javascript'> alert('添加成功');</script>";
//		} else {
//			echo "<script type='text/javascript'> alert('无法添加，请检查输入信息');</script>";
//		}
//	}
//
//	function insert_massagist_detail($con,$phone,$name,$shop_id){
//		$sql_massagist_detail = "INSERT INTO MassagistDetail (phone,name,shopid) VALUES ('".$phone ."','".$name ."',". $shop_id .")";
//		if (mysql_query($sql_massagist_detail,$con)) {
//			echo "<script type='text/javascript'> alert('添加成功');</script>";
//		} else {
//			echo "<script type='text/javascript'> alert('无法添加，请检查输入信息');</script>";
//		}
//	}

	function get_shop_id ($con, $shop){
		$sql_shop_name = "SELECT shopid FROM Shop WHERE name = '" .$shop ."';";
		$result = mysql_query($sql_shop_name,$con) or die("Fetch Error:" .mysql_error());
		$row = mysql_fetch_assoc($result);
		return $row['shopid'];
	}