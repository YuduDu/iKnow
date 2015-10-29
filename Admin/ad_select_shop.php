<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>商家查询</title>
</head>
<body>
<?php
	require_once "configs.php";
	require_once "ad_select.php";
	$con = DBconnect();
	$select_all_m_shop = "SELECT name FROM Shop ";
?>
<center>
<form id="ad_select" action="ad_select.php" method="post">
	<p>
		商家查询:
		<select name="select_massagist_shop">
			<?php
			$shop_name = array();
			$rs = mysql_query($select_all_m_shop);
			$nr = mysql_num_rows($rs);
			for ($i=0; $i<$nr; $i++){
				$r = mysql_fetch_array($rs);
				$shop_name[$i] = $r['name'];
				echo "<option disabled selected> -- select an option -- </option>";
				echo "<option".(($year==$r["name"])? ' selected="selected"' : '').">".$r["name"]."</option>";
			}
			unset($shop_name);
			?>
		</select>
		<input type="submit"/>
		<input type="reset"/>
	</p>
	</form>
</center>