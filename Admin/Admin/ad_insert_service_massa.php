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
$get_catid1 = mysql_query("SELECT name FROM Category");
$get_massagist = mysql_query("SELECT name FROM MassagistDetail");
?>
<body>
<table border="1" style="width:60%" align="center">
<form action="ad_insert_service_action.php" method="post" name="ad_insert_service_shop">
	<tr>
		INSERT SERVICE TO MASSAGIST
	</tr>
	<td>Massagist: </td>
	<td>
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
	</td>
	<tr>
		<td>Category :</td>
		<td>
			<select name = "catid_name_1">
				<option value="0">Please Select</option>
				<?php
				while($row = mysql_fetch_assoc($get_catid1))
				{
					?>
					<option value="<?php echo( $row['name'] ) ?>">
						<?php echo( $row['name'] ) ?>
					</option>
					}
					<?php
				}?>
			</select>
		</td>
	</tr>
	</tr>
</form>
	</table>
</body>
</html>