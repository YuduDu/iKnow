
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>插入技师</title>
</head>
<body>
<?php
require_once "db_func.php";
$con = DBconnect();
$get=mysql_query("SELECT name FROM Shop");
?>
<form action="ad_insert_massagist_action.php" method="post">

	Name:     <input type = "text" name = "name"><br>
	Phone:    <input type = "text" name = "phone"><br>
	Password: <input type = "text" name = "password"><br>
	Shop:     <select name = "shop">
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
	</select><br>

	<input type="submit">
</form>

</body>
</html>