<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>推荐信息查询</title>
</head>
<body>
<?php
require_once "configs.php";
require_once "ad_select.php";
$con = DBconnect();
?>
<center>
<form id="ad_select_recomm" align = "center">
	<p> <a href="ad_get_recommand_news.php"> 推荐新闻</a> </p>
	<p> <a href="ad_get_recommand_massagist.php"> 推荐技师</a> </p>
	<p> <a href="ad_get_recommand_service.php"> 推荐服务</a> </p>

</form>

</body>
</center>
</html>

<?php

?>
