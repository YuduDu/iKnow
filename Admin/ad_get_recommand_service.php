<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>客户查询</title>
</head>
<center>
<body>
<?php

require_once "configs.php";
require_once "db_func.php";
$con = DBconnect();
get_recommand_service($con);
function get_recommand_service($con){
	$sql = "SELECT * FROM Recommand_service";
	$result = mysql_query($sql,$con);
	echo "<table>";
	echo "<TR><TD>SERVICE_ID</TD><TD>SHOPNAME</TD><TD>SERVICE</TD><TD>PRICE</TD></TR>";
	while ($row = mysql_fetch_assoc($result)){
		echo "<tr><td>";
		echo $row['serviceid'];
		echo "</td><td>";
		echo $row['shopname'];
		echo "</td><td>";
		echo $row['servicename'];
		echo "</td><td>";
		echo $row['price'];
		echo "</tr></td>";
	}
}
?>
</body>
</center>