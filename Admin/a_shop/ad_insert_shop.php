<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>新增商家</title>
	<link href="../1210/css/style.css" rel="stylesheet" type="text/css" />
</head>


<body>
<?php
require_once "../db_func.php";
$con = DBconnect();
$get=mysql_query("SELECT name FROM Shop");
?>


<div class="place">
	<span>位置：</span>
	<ul class="placeul">
		<li><a href="../1210/index.html">首页</a></li>
		<li><a href="javascript:history.go(-1);">返回</a></li>
	</ul>
</div>

<div class="formbody">
	<form action="ad_insert_shop_action.php" method="post" enctype="multipart/form-data" >

		<div class="formtitle"><span>商家信息</span></div>

		<ul class="forminfo">
			<li><label>商户名称</label><input type = "text" name = "name" class="dfinput" /></li>
			<li><label>商户ID</label><input type = "text" name = "shopid" class="dfinput" /></li>
			<li><label>电 话</label><input type = "text" name = "phone" class="dfinput" /></li>
			<li><label>省 份</label><input type = "text" name = "province" class="dfinput" /></li>
			<li><label>城 市</label><input type = "text" name = "city" class="dfinput" /></li>
			<li><label>地 址</label><input type = "text" name = "address" class="dfinput" /></li>
			<li><label>图 片</label><input type= "file"  name="pic"  accept="image/gif, image/jpeg" ></li>
			<li><label>开始营业时间</label><input type = "text" name = "opentime" class="dfinput" /><i>格式:HH:MM:SS</i></li>
			<li><label>结束营业时间</label><input type = "text" name = "closetime" class="dfinput"/><i>格式:HH:MM:SS</i></li>

			<li><label>&nbsp;</label><input type="submit"  value="确认保存"/></li>
		</ul>

	</div>


<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
<!--<center>-->
<!--	<form action="ad_insert_shop_action.php" method="post" enctype="multipart/form-data" >-->
<!--		商户名称:  <input type = "text" name = "name"  > <br>-->
<!--		商户ID:   <input type="text" name = "shopid" > <br>-->
<!--		电 话:     <input type = "text" name = "phone" > <br>-->
<!--		省 份:     <input type = "text" name = "province" > <br>-->
<!--		城 市:     <input type = "text" name = "city" > <br>-->
<!--		地 址:     <input type = "text" name = "address" > <br>-->
<!--		图 片:     <input type= "file"  name="pic"  accept="image/gif, image/jpeg" > <br>-->
<!--		开始营业时间: <input type = "text" name = "opentime" > <br>-->
<!--		结束营业时间: <input type = "text" name = "closetime" > <br>-->
<!---->
<!--		<input type="submit" value="Load">-->
<!--	</form>-->
<!--</center>-->
</body>
</html>