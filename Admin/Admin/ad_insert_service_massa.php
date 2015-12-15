<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>插入服务</title>
</head>
<?php
require_once "db_func.php";
$con = DBconnect();
$get_catid1 = mysql_query("SELECT name FROM Category");
$get_massagist = mysql_query("SELECT name FROM MassagistDetail");
?>
<body>

<form action="ad_insert_service_massa_action.php" method="post" name="ad_insert_service_massa">

	<p>INSERT SERVICE TO MASSAGIST</p>

	<p>Massagist:
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
	</p>
	
	<p>Category :
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
	</p>

	<input type="submit" name="ad_insert_service_massa_submit"/>
	<input type="reset" name ="ad_insert_service_massa_reset"/>
</form>

</body>
</html>