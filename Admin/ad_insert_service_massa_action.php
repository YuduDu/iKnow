<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>插入服务—技师</title>
</head>
<?php
	require_once "db_func.php";
	$con = DBconnect();

	$catid_name = $_POST['catid_name_1'];//FOR MASSAGIST
	$catid_id = get_cat_id($con,$catid_name);
	$massa_name = $_POST['massa_name'];
	$massa_id = get_massa_id($con,$massa_name);

if(isset($_POST['ad_insert_service_massa_submit'])&&$_POST['ad_insert_service_massa_submit']!=""){
//		echo "SHOPID:" .$shop_id ."<br>";
//		echo "CATID:" .$catid_id ."<br>";
	insert_serveice_massa($con,$massa_id,$catid_id);
}

function get_cat_id($con,$catid_name){
	$sql_catid = "SELECT catid FROM Category WHERE name = '" .$catid_name ."';";
	$result = mysql_query($sql_catid,$con) or die ("ERROR:" .mysql_errno());
	$row = mysql_fetch_assoc($result);
	return $row['catid'];
}

function get_massa_id($con,$massa_name){
	$sql_massaid = "SELECT phone FROM MassagistDetail WHERE name ='" .$massa_name ."';";
	$result = mysql_query($sql_massaid,$con) or die ("ERROR:" .mysql_errno());
	$row = mysql_fetch_assoc($result);
	return $row['phone'];
}

function insert_serveice_massa($con,$massa_id,$catid_id){
	$sql_service_shop = "INSERT INTO Has_Service (masaid,serviceid) VALUES ($massa_id,$catid_id);";
	//$result = mysql_query($sql_service_shop,$con);
	if (mysql_query( $sql_service_shop,$con)) {
		echo "<script type='text/javascript'> alert('插入成功');</script>";
	} else {
		echo "<script type='text/javascript'> alert('无法插入，请检查输入信息');</script>";
	}

}