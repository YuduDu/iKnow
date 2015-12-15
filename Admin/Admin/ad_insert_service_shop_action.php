<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>插入服务-商家</title>
</head>
<!--新增服务类型，及其描述-->
<?php
require_once "db_func.php";
$con = DBconnect();

	$catid_name = $_POST['catid_name'];//FOR SHOP
	$catid_id = get_cat_id($con,$catid_name);
	$shop_name = $_POST['shop'];
	$shop_id = get_shop_id($con,$shop_name);

	if(isset($_POST['ad_insert_service_shop_submit'])&&$_POST['ad_insert_service_shop_submit']!=""){
//		echo "SHOPID:" .$shop_id ."<br>";
//		echo "CATID:" .$catid_id ."<br>";
		insert_serveice_shop($con,$shop_id,$catid_id);
	}

	function get_cat_id($con,$catid_name){
		$sql_catid = "SELECT catid FROM Category WHERE name = '" .$catid_name ."';";
		$result = mysql_query($sql_catid,$con) or die ("ERROR:" .mysql_errno());
		$row = mysql_fetch_assoc($result);
		return $row['catid'];
	}

	function get_shop_id($con, $shop_name){
		$sql_shopid = "SELECT shopid FROM Shop WHERE name ='" .$shop_name ."';";
		$result = mysql_query($sql_shopid,$con) or die ("ERROR:" .mysql_errno());
		$row = mysql_fetch_assoc($result);
		return $row['shopid'];
	}

	function insert_serveice_shop($con,$shopid,$catid){
		$sql_service_shop = "INSERT INTO Service (shopid,catid) VALUES ($shopid,$catid);";
		//$result = mysql_query($sql_service_shop,$con);
		if (mysql_query( $sql_service_shop,$con)) {
			echo "New record created successfully";
		} else {
			echo "Error: " .mysql_error($con);
		}
	}
