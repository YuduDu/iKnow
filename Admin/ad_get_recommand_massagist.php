<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>推荐技师</title>
</head>

<?php

require_once "configs.php";
require_once "db_func.php";
$con = DBconnect();
get_recommand_massagist($con);
function get_recommand_massagist($con){
	$sql = "SELECT * FROM Recommand_massagist";
	$result = mysql_query($sql,$con);
	echo "<center>";
	echo "<table border='1'>";
	echo "<TR>推荐技师信息详情</TR>";
	echo "<TR><TD>MASSAGIST_ID</TD><TD>SHOPNAME</TD><TD>MASSAGIST_NAME</TD><TD>STARS</TD><TD>OPERATION</TD></TR>";
	while ($row = mysql_fetch_assoc($result)){
		echo "<tr>". "<td>";
		echo $row['massagistid'] ;
		echo "</td>" ."<td>";
		echo $row['shopname'] ;
		echo "</td>" . "<td>" ;
		echo $row['name'];
		echo "</td>" ."<td>";
		echo $row['stars'];
		echo "</td>" ."<td>";
		?>
		<a href="ad_rcmand_ma_delete.php">删除</a>
		<?php
	}
	echo "</table>";
}
?>
	<a href="javascript:history.go(-1);">返回</a>

