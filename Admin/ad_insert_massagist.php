<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>新增技师</title>
	<link href="./1210/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
	require_once "db_func.php";
	$con = DBconnect();
	$get=mysql_query("SELECT name FROM Shop");
?>
<div class="place">
	<span>位置：</span>
	<ul class="placeul">
		<li><a href="./1210/index.html">首页</a></li>
		<li><a href="javascript:history.go(-1);">返回</a></li>
	</ul>
</div>

<div class="formbody">
	<form action="ad_insert_massagist_action.php" method="post">
	<div class="formtitle"><span>技师信息</span></div>

	<ul class="forminfo">
		<li><label>姓名</label><input type = "text" name = "name" class="dfinput" /></li>
		<li><label>电话</label><input type = "text" name = "phone" class="dfinput" /></li>
		<li><label>密码</label><input type = "text" name = "password" class="dfinput" /></li>
		<li><label>商铺</label><select name = "shop"></li>
								<option value="0">Please Select</option>
								<?php
								while($row = mysql_fetch_assoc($get))
								{
									?>
									<option value = "<?php echo($row['name'])?>" >
										<?php echo($row['name']) ?>
									</option>
									<?php
								}
								?>
								</select>
		<li><label>&nbsp;</label><input type="submit"  value="确认保存"/></li>
	</ul>
	</form>
	</div>