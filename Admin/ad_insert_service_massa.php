<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>技师新增服务</title>
	<link href="./1210/css/style.css" rel="stylesheet" type="text/css" />
</head>


<?php
	require_once "db_func.php";
	$con = DBconnect();
	$get_catid1 = mysql_query("SELECT name FROM Category");
	$get_massagist = mysql_query("SELECT name FROM MassagistDetail");
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
	<form action="ad_insert_service_massa_action.php" method="post" name="ad_insert_service_massa">
		<div class="formtitle"><span>选择技师及服务</span></div>
		<ul class="forminfo">

			<li><label>技师姓名</label>
				<select name = "massa_name">
					<option value="0">Please Select</option>
					<?php
					while($row = mysql_fetch_assoc($get_massagist))
					{?>
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
					while($row = mysql_fetch_assoc($get_catid1)) {
						?>
						<option value="<?php echo( $row['name'] ) ?>">
							<?php echo( $row['name'] ) ?>
						</option>
						<?php
					}
					?>
				</select>

			</li>

			<li><label>&nbsp;</label><input type="submit"  name="ad_insert_service_massa_submit" value="确认保存"/></li>

</div>

<!---->
<!---->
<!--<form action="ad_insert_service_massa_action.php" method="post" name="ad_insert_service_massa">-->
<!---->
<!--	<p>INSERT SERVICE TO MASSAGIST</p>-->
<!---->
<!--	<p>Massagist:-->
<!--		<select name = "massa_name">-->
<!--			<option value="0">Please Select</option>-->
<!--			--><?php
//			while($row = mysql_fetch_assoc($get_massagist))
//			{?>
<!--				<option value = "--><?php //echo($row['name'])?><!--" >-->
<!--					--><?php //echo($row['name']) ?>
<!--				</option>-->
<!--				--><?php
//			}
//			?>
<!--		</select>-->
<!--	</p>-->
<!--	-->
<!--	<p>Category :-->
<!--		<select name = "catid_name_1">-->
<!--			<option value="0">Please Select</option>-->
<!--			--><?php
//			while($row = mysql_fetch_assoc($get_catid1)) {
//					?>
<!--				<option value="--><?php //echo( $row['name'] ) ?><!--">-->
<!--					--><?php //echo( $row['name'] ) ?>
<!--				</option>-->
<!--					--><?php
//				}
//			    ?>
<!--			</select>-->
<!--	</p>-->
<!---->
<!--	<input type="submit" name="ad_insert_service_massa_submit"/>-->
<!--	<input type="reset" name ="ad_insert_service_massa_reset"/>-->
<!--</form>-->

</body>
</html>