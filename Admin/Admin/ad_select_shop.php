<?php
if (!session_id())
{
	session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>商家查询</title>
</head>
<body>
<?php
	require_once 'db_func.php';
	$con = DBconnect();
	$_SESSION['shopid'] = null;
	$select_all_m_shop = "SELECT * FROM Shop ";
?>
<center>
	<form id="select_shop_form" action="ad_select_shop_action.php" method="post">
		<p>
			商家查询:
			<select id="select_shop" name="select_shop_s">
				<?php
				$shop_name = array();
				$rs        = mysql_query( $select_all_m_shop );
				$nr        = mysql_num_rows( $rs );
				echo "<option disabled selected> -- select an option -- </option>";
				for ( $i = 0; $i < $nr; $i ++ ) {
					$r = mysql_fetch_array( $rs );
					$shop_name[ $i ] = $r['name'];
					echo "<option value= " .$r["shopid"] .">".$r["name"]."</option>";
				}
				unset( $shop_name );
				?>
			</select>
			<input type="submit"/>
			<input type="reset"/>
		</p>
	</form>
</center>