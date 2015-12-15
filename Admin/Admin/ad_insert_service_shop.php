<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>插入服务</title>
</head>
<?php
	require_once "db_func.php";
	$con = DBconnect();
	$get=mysql_query("SELECT name FROM Shop");
	$get_catid = mysql_query("SELECT name FROM Category");
?>
<body>
<p>INSERT SERVICE TO SHOP</p>
	<form action="ad_insert_service_shop_action.php" method="post" name="ad_insert_service_shop">
<p>
	Shop:
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
</p>
<p>
	Category :
		<select name = "catid_name">
			<option value="0">Please Select</option>
			<?php
			while($row = mysql_fetch_assoc($get_catid))
			{
				?>
				<option value="<?php echo( $row['name'] ) ?>">
					<?php echo( $row['name'] ) ?>
				</option>
						}
				<?php
					}
				?>
				</select>
</p>
		<input type="submit" name="ad_insert_service_shop_submit"/>
		<input type="reset" name ="ad_insert_service_shop_reset"/>
	</form>

</body>
</html>