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
get_recommand_news($con);
function get_recommand_news($con){
	$sql = "SELECT * FROM Recommand_news";
	$result = mysql_query($sql,$con);
	echo "<table>";
	echo "<TR><TD>TITLE</TD><TD>CONTENT</TD><TD>PIC</TD></TR>";
	while ($row = mysql_fetch_assoc($result)){
		echo "<tr>". "<td>";
		echo $row['title'];
		echo "</td>" . "<td>";
		echo "CONTENT:".$row['content'];
		echo "</td>" . "<td>";
		echo "PIC:" .$row['pic'];
		echo "</td>" ."</tr>";
	}
}
?>
</body>
</center>