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
	<form action="ad_insert_shop_action.php" method="post" enctype="multipart/form-data" >
		商户名称:  <input type = "text" name = "name"  > <br>
		商户ID:   <input type="text" name = "shopid" > <br>
		电 话:     <input type = "text" name = "phone" > <br>
		省 份:     <input type = "text" name = "province" > <br>
		城 市:     <input type = "text" name = "city" > <br>
		地 址:     <input type = "text" name = "address" > <br>
		图 片:     <input type= "file"  name="pic"  accept="image/gif, image/jpeg" > <br>
		开始营业时间: <input type = "text" name = "opentime" > <br>
		结束营业时间: <input type = "text" name = "closetime" > <br>

		<input type="submit" value="Load">
	</form>
</center>
</body>
</html>