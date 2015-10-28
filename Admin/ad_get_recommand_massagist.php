<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>客户查询</title>
</head>

<body>
<center>
<table border="1" width=80%>
<?php

require_once "configs.php";
require_once "db_func.php";
$con = DBconnect();
get_recommand_massagist($con);
function get_recommand_massagist($con){
	$sql = "SELECT * FROM Recommand_massagist";
	$result = mysql_query($sql,$con);
	echo "<table>";
	echo "<TR><TD>MASSAGIST_ID</TD><TD>SHOPNAME</TD><TD>MASSAGIST_NAME</TD><TD>STARS</TD></TR>";
	while ($row = mysql_fetch_assoc($result)){
		echo "<tr><td>";
		echo $row['massagistid'] ;
		echo "</td>" ."<td>";
		echo $row['shopname'] ;
		echo "</td>" . "</td>" .;
		echo $row['name'];
		echo "</td>" ."<td>";
		echo $row['stars'];
		echo "</tr>"."</td>";
	}
	echo "</table>";
}
?>
	</table>
</center>
</body>
