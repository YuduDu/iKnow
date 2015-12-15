<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>推荐新闻</title>
</head>
<!--<center>-->


<!--<body>-->
<?php

require_once "configs.php";
require_once "db_func.php";

$con = DBconnect();
get_recommand_news($con);
function get_recommand_news($con){
	$sql = "SELECT * FROM Recommand_news";
	$result = mysql_query($sql,$con);
	echo "<center>";
	echo "<table border='1'>";
	echo "<TR>推荐新闻信息详情</TR>";
	echo "<TR><TD>TITLE</TD><TD>CONTENT</TD><TD>PIC</TD><TD>OPERATION</TD></TR>";
	while ($row = mysql_fetch_assoc($result)){
		echo "<tr>". "<td>";
		echo $row['title'];
		echo "</td>" . "<td>";
		echo $row['content'];
		echo "</td>" . "<td>";
		echo $row['pic'];
		echo "</td>" ."<td>";
		?>
		<a href="ad_rcmand_news_delete.php">删除</a>
		<?php
	}
	echo "</table>";
}
?>
<a href="javascript:history.go(-1);">返回</a>