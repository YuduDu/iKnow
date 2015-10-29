<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>插入商家</title>
</head>
<body>
<?php
require_once "db_func.php";
$con = DBconnect();
$get=mysql_query("SELECT name FROM Shop");
?>
<center>
	<form action="ad_insert_shop_action.php" method="post">
		商户名称:  <input type = "text" name ="password"> <br>
		地址:     <input type ="text" name ="address"> <br>
		电话:     <input type ="text" name ="phone"> <br>
		图片: <br>
		<input type="submit">
	</form>
</center>
</body>
</html>