<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MyTest</title>
</head>
<body>

<?php
	require_once "db_func.php";
	require_once "configs.php";

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
			echo $row['massagistid'];
			echo "</td>" ."<td>";
			echo $row['shopname'];
			echo "</td>" . "<td>";
			echo $row['name'];
			echo "</td>" ."<td>";
			echo $row['stars'];
			echo "</td>"."<td>";

			?>
			<a href="delete.php">删除</a>
			<a href="edit.php">修改</a>

<?php
		}

		echo "</table>";
	}
?>
</body>
