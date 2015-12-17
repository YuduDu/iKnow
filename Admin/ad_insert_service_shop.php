<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>商家新增服务</title>
	<link href="./1210/css/style.css" rel="stylesheet" type="text/css" />
</head>

<?php
	require_once "db_func.php";
	$con = DBconnect();
	$get=mysql_query("SELECT name FROM Shop");
	$get_catid = mysql_query("SELECT name FROM Category");
?>
<body>
<div class="place">
	<span>位置：</span>
	<ul class="placeul">
		<li><a href="./1210/index.html">首页</a></li>
		<li><a href="javascript:history.go(-1);">返回</a></li>
	</ul>
</div>
<div class="formbody">
	<form action="ad_insert_service_shop_action.php" method="post" name="ad_insert_service_shop">
		<div class="formtitle"><span>选择商家及服务</span></div>
		<ul class="forminfo">
			<li><label>商家</label>
				<select name = "shop">
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
			</li>

			<li><label>选择服务类型</label>
				<select name = "catid_name_1">
					<option value="0">Please Select</option>
					<?php
					while($row = mysql_fetch_assoc($get_catid)) {
						?>
						<option value="<?php echo( $row['name'] ) ?>">
							<?php echo( $row['name'] ) ?>
						</option>
						<?php
					}
					?>
				</select>
			</li>
			<li><label>&nbsp;</label><input type="submit"  name="ad_insert_service_shop_submit" value="确认保存"/>
			    <label>&nbsp;</label><input type="reset" name ="ad_insert_service_shop_reset"/></li>

			</ul>

	</div>

<!--<p>INSERT SERVICE TO SHOP</p>-->
<!--	<form action="ad_insert_service_shop_action.php" method="post" name="ad_insert_service_shop">-->
<!--<p>-->
<!--	Shop:-->
<!--		<select name = "shop">-->
<!--			<option value="0">Please Select</option>-->
<!--			--><?php
//			while($row = mysql_fetch_assoc($get))
//			{
//				?>
<!--				<option value = "--><?php //echo($row['name'])?><!--" >-->
<!--					--><?php //echo($row['name']) ?>
<!--				</option>-->
<!--				--><?php
//					}
//				?>
<!--				</select>-->
<!--</p>-->
<!--<p>-->
<!--	Category :-->
<!--		<select name = "catid_name">-->
<!--			<option value="0">Please Select</option>-->
<!--			--><?php
//			while($row = mysql_fetch_assoc($get_catid))
//			{
//				?>
<!--				<option value="--><?php //echo( $row['name'] ) ?><!--">-->
<!--					--><?php //echo( $row['name'] ) ?>
<!--				</option>-->
<!--						}-->
<!--				--><?php
//					}
//				?>
<!--				</select>-->
<!--</p>-->
<!--		<input type="submit" name="ad_insert_service_shop_submit"/>-->
<!--		<input type="reset" name ="ad_insert_service_shop_reset"/>-->
<!--	</form>-->

</body>
</html>