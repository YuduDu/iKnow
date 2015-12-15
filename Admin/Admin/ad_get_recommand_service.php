<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>推荐服务</title>
</head>
<center>

<?php

require_once "configs.php";
require_once "db_func.php";
$con = DBconnect();
get_recommand_service($con);
function get_recommand_service($con){
	$sql = "SELECT * FROM Recommand_service";
	$result = mysql_query($sql,$con);
	echo "<center>";
	echo "<table border='1'>";
	echo "<TR>推荐服务信息详情</TR>";
	echo "<TR><TD>SERVICE_ID</TD><TD>SHOPNAME</TD><TD>SERVICE</TD><TD>PRICE</TD><TD>OPERATION</TD></TR>";
	while ($row = mysql_fetch_assoc($result)){
		echo "<tr><td>";
		echo $row['serviceid'];
		echo "</td><td>";
		echo $row['shopname'];
		echo "</td><td>";
		echo $row['servicename'];
		echo "</td><td>";
		echo $row['price'];
		echo "</td>" ."<td>";
		?>
		<a href="ad_rcmand_service_delete.php">删除</a>
		<?php
	}
	echo "</table>";
}
?>
	<a href="javascript:history.go(-1);">返回</a>



