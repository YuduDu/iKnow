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
	<form action="ad_insert_shop.php" method="post" enctype="multipart/form-data" >

		<div class="formtitle"><span>商家信息</span></div>

		<ul class="forminfo">
			<li><label>商户名称</label><input type = "text" name = "name" class="dfinput" /></li>
			<li><label>电 话</label><input type = "text" name = "phone" class="dfinput" /></li>
			<li><label>省 份</label><input type = "text" name = "province" class="dfinput" /></li>
			<li><label>城 市</label><input type = "text" name = "city" class="dfinput" /></li>
			<li><label>地 址</label><input type = "text" name = "address" class="dfinput" /></li>
			<li><label>图 片</label><input type= "file"  name="pic"  accept="image/gif, image/jpeg" ></li>
			<li><label>开始营业时间</label><input type = "text" name = "opentime" class="dfinput" /><i>格式:HH:MM:SS</i></li>
			<li><label>结束营业时间</label><input type = "text" name = "closetime" class="dfinput"/><i>格式:HH:MM:SS</i></li>

			<li><label>&nbsp;</label><input type="submit"  class="btn" value="确认保存"/></li>
		</ul>

	</div>
</body>
</html>
<?php
$result = mysql_query("select * from Shop");
$num_rows = mysql_num_rows($result);



	$name=$_POST['name'];
	$sid=$num_rows+1;
	$phone=$_POST['phone'];
	$city=$_POST['city'];
	$province=$_POST['province'];
	$addr=$_POST['address'];
	$pic=$_FILES['pic']['name'];
	$ot=$_POST['opentime'];
	$ct=$_POST['closetime'];

$sql = "INSERT INTO Shop(shopid, name, phone, address, opentime, closetime, city, province) VALUES ($sid,$name,$phone,$addr,$ot,$ct,$city,$province);";

if (mysql_query($sql,$con)) {
	echo "<script type='text/javascript'> alert('添加成功');</script>";
	?>

	<?php
} else {
	echo "<script type='text/javascript'> alert('无法添加，请检查输入信息');</script>";
	?>

	<?php
}
?>